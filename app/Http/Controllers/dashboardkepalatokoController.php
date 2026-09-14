<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardKepalaTokoController extends Controller
{
    public function index(Request $request)
    {
        Carbon::setLocale('id');

        $filterType = $request->input('filter_type', 'today'); // 'today', '7days', '30days', 'all', 'custom'
        $startDateInput = $request->input('start_date');
        $endDateInput = $request->input('end_date');

        $now = Carbon::now();
        $startDate = null;
        $endDate = null;

        if ($filterType === 'all') {
            $filterLabel = 'Semua Waktu (Total Keseluruhan)';
        } elseif ($filterType === '7days') {
            $startDate = Carbon::today()->subDays(6)->startOfDay();
            $endDate = Carbon::today()->endOfDay();
            $filterLabel = $startDate->translatedFormat('d M Y').' - '.$endDate->translatedFormat('d M Y');
        } elseif ($filterType === '30days') {
            $startDate = Carbon::today()->subDays(29)->startOfDay();
            $endDate = Carbon::today()->endOfDay();
            $filterLabel = $startDate->translatedFormat('d M Y').' - '.$endDate->translatedFormat('d M Y');
        } elseif ($filterType === 'custom' && $startDateInput && $endDateInput) {
            $startDate = Carbon::parse($startDateInput)->startOfDay();
            $endDate = Carbon::parse($endDateInput)->endOfDay();
            $filterLabel = $startDate->translatedFormat('d M Y').' - '.$endDate->translatedFormat('d M Y');
        } else {
            $filterType = 'today';
            $startDate = Carbon::today()->startOfDay();
            $endDate = Carbon::today()->endOfDay();
            $filterLabel = 'Hari Ini ('.$now->translatedFormat('d M Y').')';
        }

        // 1. UANG MASUK (Total nilai transaksi dari tabel transactions)
        $trxQuery = DB::table('transactions');
        if ($startDate && $endDate) {
            $trxQuery->whereBetween('created_at', [$startDate, $endDate]);
        }
        $uang_masuk = (float) ($trxQuery->sum('total_price') ?? 0);

        // 2. UANG KELUAR (Pengadaan stok barang)
        $prodQuery = DB::table('products')->where('status', 'approved');
        if ($startDate && $endDate) {
            $prodQuery->whereBetween('created_at', [$startDate, $endDate]);
        }
        $uang_keluar = (float) ($prodQuery->selectRaw('SUM(purchase_price * stock) as total_keluar')->value('total_keluar') ?? 0);

        // Fallback jika tidak ada record barang pada rentang tanggal, periksa barang_masuks
        if ($uang_keluar == 0 && $filterType !== 'all') {
            $bmQuery = DB::table('barang_masuks')->where('status', 'approved');
            if ($startDate && $endDate) {
                $bmQuery->whereBetween('created_at', [$startDate, $endDate]);
            }
            $uang_keluar = (float) ($bmQuery->selectRaw('SUM(purchase_price * jumlah) as total_keluar')->value('total_keluar') ?? 0);
        }

        // 3. LABA / RUGI (Uang Masuk - Uang Keluar)
        $laba_rugi = $uang_masuk - $uang_keluar;

        // 4. BARANG STOK KRITIS (stok <= 5)
        $lowStockItems = DB::table('products')
            ->where('status', 'approved')
            ->where('stock', '<=', 5)
            ->get();
        $low_stock_count = $lowStockItems->count();

        // 5. GRAFIK PENJUALAN (Jumlah Barang Terjual - Pcs/Unit)
        $chartLabels = [];
        $chartValues = [];

        if ($filterType === 'today') {
            // Tampilkan per interval jam (08:00 - 20:00)
            for ($hour = 8; $hour <= 20; $hour += 2) {
                $hStart = Carbon::today()->setHour($hour)->setMinute(0)->setSecond(0);
                $hEnd = (clone $hStart)->addHours(2)->subSecond();

                $pcs = DB::table('transaction_details')
                    ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
                    ->whereBetween('transactions.created_at', [$hStart, $hEnd])
                    ->sum('transaction_details.quantity') ?? 0;

                $chartLabels[] = sprintf('%02d:00', $hour);
                $chartValues[] = (int) $pcs;
            }
        } elseif ($filterType === 'all') {
            // Tampilkan berdasarkan tanggal transaksi yang ada
            $dates = DB::table('transactions')
                ->selectRaw('DATE(created_at) as date_val')
                ->groupBy('date_val')
                ->orderBy('date_val', 'asc')
                ->pluck('date_val');

            if ($dates->isEmpty()) {
                for ($i = 6; $i >= 0; $i--) {
                    $d = Carbon::today()->subDays($i);
                    $chartLabels[] = $d->translatedFormat('d M');
                    $chartValues[] = 0;
                }
            } else {
                foreach ($dates as $dStr) {
                    $d = Carbon::parse($dStr);
                    $pcs = DB::table('transaction_details')
                        ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
                        ->whereDate('transactions.created_at', $dStr)
                        ->sum('transaction_details.quantity') ?? 0;

                    $chartLabels[] = $d->translatedFormat('d M');
                    $chartValues[] = (int) $pcs;
                }
            }
        } else {
            // Rentang tanggal (7days, 30days, atau custom)
            $pStart = clone $startDate;
            $pEnd = clone $endDate;
            $daysDiff = $pStart->diffInDays($pEnd);

            if ($daysDiff <= 31) {
                for ($dt = clone $pStart; $dt->lte($pEnd); $dt->addDay()) {
                    $dStr = $dt->format('Y-m-d');
                    $pcs = DB::table('transaction_details')
                        ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
                        ->whereDate('transactions.created_at', $dStr)
                        ->sum('transaction_details.quantity') ?? 0;

                    $chartLabels[] = $dt->translatedFormat('d M');
                    $chartValues[] = (int) $pcs;
                }
            } else {
                $dates = DB::table('transactions')
                    ->selectRaw('DATE(created_at) as date_val')
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->groupBy('date_val')
                    ->orderBy('date_val', 'asc')
                    ->pluck('date_val');

                foreach ($dates as $dStr) {
                    $d = Carbon::parse($dStr);
                    $pcs = DB::table('transaction_details')
                        ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
                        ->whereDate('transactions.created_at', $dStr)
                        ->sum('transaction_details.quantity') ?? 0;

                    $chartLabels[] = $d->translatedFormat('d M');
                    $chartValues[] = (int) $pcs;
                }
            }
        }

        return view('dashboardkepalatoko', [
            'filter_type' => $filterType,
            'start_date' => $startDateInput ?? ($startDate ? $startDate->format('Y-m-d') : ''),
            'end_date' => $endDateInput ?? ($endDate ? $endDate->format('Y-m-d') : ''),
            'filter_label' => $filterLabel,
            'uang_masuk' => $uang_masuk,
            'uang_keluar' => $uang_keluar,
            'laba_rugi' => $laba_rugi,
            'low_stock_count' => $low_stock_count,
            'low_stock_items' => $lowStockItems,
            'chart_labels' => $chartLabels,
            'chart_values' => $chartValues,
        ]);
    }

    public function stock(Request $request)
    {
        $search = $request->input('search');

        $query = Product::with('category')->where('status', 'approved');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('barcode', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($cat) use ($search) {
                        $cat->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $products = $query->latest()->get();
        $totalItems = Product::where('status', 'approved')->count();
        $lowStockCount = Product::where('status', 'approved')->where('stock', '<=', 5)->count();

        if ($request->wantsJson() || $request->ajax() || $request->has('json')) {
            return response()->json([
                'total_items' => $totalItems,
                'low_stock_count' => $lowStockCount,
                'products' => $products->map(function ($p) {
                    return [
                        'id' => $p->id,
                        'barcode' => $p->barcode ?? ('SKU-'.str_pad($p->id, 4, '0', STR_PAD_LEFT)),
                        'name' => $p->name ?? $p->product_name ?? 'Tanpa Nama',
                        'category' => $p->category->name ?? 'Umum',
                        'stock' => (int) $p->stock,
                        'price' => (float) $p->price,
                        'purchase_price' => (float) $p->purchase_price,
                        'is_low' => $p->stock <= 5,
                        'img_url' => $p->img,
                    ];
                }),
            ]);
        }

        return view('stokbarang-kepalatoko', compact('products', 'totalItems', 'lowStockCount', 'search'));
    }

    public function orders()
    {
        return view('transaksi');
    }

    public function staff()
    {
        return redirect()->route('profile.kepalatoko.index');
    }
}
