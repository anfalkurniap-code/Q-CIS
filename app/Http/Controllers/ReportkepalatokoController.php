<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Product;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReportkepalatokoController extends Controller
{
    /**
     * Menampilkan Halaman Laporan & Konfirmasi Barang (Masuk & Keluar)
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $activeTab = $request->input('tab', 'masuk');

        // Fallback jika hanya input 'date' yang diisi
        if (! $startDate && ! $endDate && $request->filled('date')) {
            $startDate = $request->input('date');
            $endDate = $request->input('date');
        }

        $queryMasuk = BarangMasuk::query();
        if ($search) {
            $queryMasuk->where('nama_barang', 'like', "%{$search}%");
        }
        if ($startDate) {
            $queryMasuk->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $queryMasuk->whereDate('created_at', '<=', $endDate);
        }
        $allBarangMasuk = $queryMasuk->latest()->get();

        $queryKeluar = Transaction::with('details')->latest();
        if ($search) {
            $queryKeluar->where(function ($q) use ($search) {
                $q->where('invoice_number', 'like', "%{$search}%")
                    ->orWhereHas('details', function ($dq) use ($search) {
                        $dq->where('product_name', 'like', "%{$search}%");
                    });
            });
        }
        if ($startDate) {
            $queryKeluar->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $queryKeluar->whereDate('created_at', '<=', $endDate);
        }
        $allBarangKeluar = $queryKeluar->get();

        $barangMasuk = $activeTab === 'masuk' ? $allBarangMasuk : collect();
        $barangKeluar = $activeTab === 'keluar' ? $allBarangKeluar : collect();

        $summary = $this->calculateSummary($startDate, $endDate);

        return view('Reportkepalatoko', compact(
            'barangMasuk',
            'barangKeluar',
            'allBarangMasuk',
            'allBarangKeluar',
            'activeTab',
            'summary',
            'startDate',
            'endDate'
        ));
    }

    /**
     * Export Laporan ke PDF
     */
    public function exportPdf(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if (! $startDate && ! $endDate && $request->filled('date')) {
            $startDate = $request->input('date');
            $endDate = $request->input('date');
        }

        $queryMasuk = BarangMasuk::query();
        if ($startDate) {
            $queryMasuk->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $queryMasuk->whereDate('created_at', '<=', $endDate);
        }
        $barangMasuk = $queryMasuk->latest()->get();

        $queryKeluar = Transaction::with('details')->latest();
        if ($startDate) {
            $queryKeluar->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $queryKeluar->whereDate('created_at', '<=', $endDate);
        }
        $barangKeluar = $queryKeluar->get();

        $summary = $this->calculateSummary($startDate, $endDate);

        $pdf = Pdf::loadView('pdf.report', compact('barangMasuk', 'barangKeluar', 'summary', 'startDate', 'endDate'));

        $filename = 'Laporan-Q-CIS-SMK-MART';
        if ($startDate || $endDate) {
            $filename .= '-('.($startDate ?? 'awal').'-sd-'.($endDate ?? 'akhir').')';
        }

        return $pdf->download($filename.'.pdf');
    }

    /**
     * Hitung Ringkasan Keuangan dan Unit
     */
    private function calculateSummary(?string $startDate, ?string $endDate): array
    {
        // Barang Masuk (Gudang)
        $queryMasuk = BarangMasuk::query();
        if ($startDate) {
            $queryMasuk->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $queryMasuk->whereDate('created_at', '<=', $endDate);
        }
        $masukCollection = $queryMasuk->get();

        $totalBarangMasuk = (int) $masukCollection->sum('jumlah');
        $totalUangKeluar = (float) $masukCollection->sum(function ($item) {
            $cost = $item->purchase_price > 0 ? $item->purchase_price : ($item->harga ?? 0);

            return $cost * ($item->jumlah ?? 0);
        });

        // Barang Keluar (Kasir)
        $queryKeluar = Transaction::with('details');
        if ($startDate) {
            $queryKeluar->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $queryKeluar->whereDate('created_at', '<=', $endDate);
        }
        $keluarCollection = $queryKeluar->get();

        $totalBarangKeluar = (int) $keluarCollection->sum(function ($trx) {
            return $trx->details->sum('quantity');
        });
        $totalUangMasuk = (float) $keluarCollection->sum('total_price');

        $labaRugiNetto = $totalUangMasuk - $totalUangKeluar;

        return [
            'total_barang_masuk' => $totalBarangMasuk,
            'total_barang_keluar' => $totalBarangKeluar,
            'total_uang_masuk' => $totalUangMasuk,
            'total_uang_keluar' => $totalUangKeluar,
            'laba_rugi_netto' => $labaRugiNetto,
        ];
    }

    /**
     * Aksi untuk Menyetujui Barang (Approve)
     * Setelah disetujui, barang masuk ke tabel products (gudang & kasir).
     */
    public function approve($id)
    {
        $riwayat = BarangMasuk::findOrFail($id);

        // Cegah approval ganda
        if ($riwayat->status === 'approved') {
            return redirect()->back()->with('error', 'Barang ini sudah disetujui sebelumnya.');
        }

        // 1. Ubah status di tabel barang_masuks menjadi approved
        $riwayat->update(['status' => 'approved']);

        // 2. Periksa apakah produk dengan nama yang sama sudah ada di tabel products
        $product = Product::where('name', $riwayat->nama_barang)->first();

        if ($product) {
            // Jika produk sudah ada, tambahkan stoknya saja
            $product->increment('stock', $riwayat->jumlah);
            $product->update(['status' => 'approved']);
        } else {
            // Jika produk belum ada, buat produk baru dengan semua data dari barang_masuks
            Product::create([
                'barcode' => $riwayat->barcode,
                'name' => $riwayat->nama_barang,
                'slug' => Str::slug($riwayat->nama_barang).'-'.time(),
                'category_id' => $riwayat->category_id,
                'supplier_id' => $riwayat->supplier_id,
                'stock' => $riwayat->jumlah,
                'price' => $riwayat->harga ?? 0,
                'purchase_price' => $riwayat->purchase_price ?? 0,
                'expired_date' => $riwayat->expired_date,
                'image' => $riwayat->image,
                'receipt_image' => $riwayat->receipt_image,
                'status' => 'approved',
            ]);
        }

        return redirect()->back()->with('success', 'Barang berhasil disetujui! Stok gudang dan kasir telah diperbarui.');
    }

    /**
     * Aksi untuk Menolak Barang (Reject)
     */
    public function reject($id)
    {
        $riwayat = BarangMasuk::findOrFail($id);
        $riwayat->update(['status' => 'rejected']);

        return redirect()->back()->with('error', 'Pengajuan barang ditolak.');
    }
}
