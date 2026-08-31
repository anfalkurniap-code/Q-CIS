<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardKepalaTokoController extends Controller
{
    public function index()
    {
        $today_sales = 4250;
        $sales_growth = 12.5;
        $active_orders = 12;
        $processing_orders = 9;
        $ready_pickup_orders = 3;
        $low_stock_count = 5;

        $low_stock_items = [
            ['name' => 'Kopi Arabika 250g', 'status' => 'CRITICAL'],
            ['name' => 'Susu UHT 1L', 'status' => 'WARNING'],
        ];

        $sales_trend = [
            'Mon' => 400, 'Tue' => 550, 'Wed' => 450, 
            'Thu' => 600, 'Fri' => 750, 'Sat' => 800, 'Sun' => 700
        ];

        $live_operations = [
            ['user' => 'Kasir 1', 'action' => 'Transaksi Baru #1024', 'status' => 'Selesai', 'status_color' => 'bg-emerald-100 text-emerald-700'],
            ['user' => 'Gudang', 'action' => 'Restok Susu UHT', 'status' => 'Pending', 'status_color' => 'bg-amber-100 text-amber-700'],
        ];

        return view('dashboardkepalatoko', compact(
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
        return view('stok-kritis'); // sesuaikan dengan nama view stock kamu
    }

    public function orders()
    {
        return view('transaksi'); // sesuaikan dengan nama view orders kamu
    }

   public function staff()
{
    // Mengarahkan route staff langsung ke route profile kepala toko
    return redirect()->route('profile.index');
}
}