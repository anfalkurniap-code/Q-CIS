<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction; // Ubah ke SalesTransaction jika menggunakan tabel sales_transactions
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardKepalaTokoController extends Controller
{
    public function index()
    {
        // 1. UANG MASUK (Transaksi Kasir Hari Ini)
        // Menjumlahkan total transaksi kasir yang dibuat hari ini
        $uang_masuk = Transaction::whereDate('created_at', Carbon::today())
            ->sum('total'); 

        // 2. UANG KELUAR (Pengeluaran Gudang/Pembelian Stok Hari Ini)
        // Menhitung total modal (stok * harga beli) dari produk yang disetujui hari ini
        $uang_keluar = Product::where('status', 'approved')
            ->whereDate('created_at', Carbon::today())
            ->get()
            ->sum(function ($product) {
                return $product->stock * $product->purchase_price;
            });

        // 3. LABA / RUGI (Kalkulasi)
        $laba_rugi = $uang_masuk - $uang_keluar;

        // Data pendukung lainnya
        $today_sales = $uang_masuk;
        $sales_growth = 12.5;
        $active_orders = 12;
        $processing_orders = 9;
        $ready_pickup_orders = 3;

        // Barang Stok Kritis (stok <= 5)
        $stok_kritis_query = Product::where('status', 'approved')->where('stock', '<=', 5);
        $low_stock_count = $stok_kritis_query->count();
        $low_stock_items = $stok_kritis_query->get(['name', 'stock']);

        $sales_trend = [
            'Mon' => 400, 'Tue' => 550, 'Wed' => 450, 
            'Thu' => 600, 'Fri' => 750, 'Sat' => 800, 'Sun' => 700
        ];

        $live_operations = [
            ['user' => 'Kasir 1', 'action' => 'Transaksi Baru', 'status' => 'Selesai', 'status_color' => 'bg-emerald-100 text-emerald-700'],
            ['user' => 'Gudang', 'action' => 'Restok Barang', 'status' => 'Pending', 'status_color' => 'bg-amber-100 text-amber-700'],
        ];

        return view('dashboardkepalatoko', compact(
            'uang_masuk',
            'uang_keluar',
            'laba_rugi',
            'today_sales', 
            'sales_growth', 
            'active_orders', 
            'processing_orders', 
            'ready_pickup_orders', 
            'low_stock_count', 
            'low_stock_items', 
            'sales_trend', 
            'live_operations'
        ));
    }

    public function stock()
    {
        return view('stok-kritis');
    }

    public function orders()
    {
        return view('transaksi');
    }

    public function staff()
    {
        return redirect()->route('profilkepalatoko');
    }
}