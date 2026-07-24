<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Dummy data sesuai UI di gambar
        $data = [
            'today_sales' => 4250,
            'sales_growth' => 12.5,
            'active_orders' => 12,
            'processing_orders' => 9,
            'ready_pickup_orders' => 3,
            'low_stock_count' => 5,
            'low_stock_items' => [
                ['name' => 'Organic Whole Milk 1gal', 'status' => 'CRITICAL'],
                ['name' => 'Eco-Friendly Paper Towels', 'status' => 'WARNING'],
            ],
            'sales_trend' => [
                'Mon' => 300, 'Tue' => 400, 'Wed' => 350, 
                'Thu' => 600, 'Fri' => 500, 'Sat' => 800, 'Sun' => 450
            ],
            'live_operations' => [
                [
                    'user' => 'Marcus Lee',
                    'action' => 'Stock Update: Beverages',
                    'status' => 'Completed',
                    'status_color' => 'bg-emerald-100 text-emerald-700'
                ],
                [
                    'user' => 'Sarah Jenkins',
                    'action' => 'Refund processed #99123',
                    'status' => 'Pending',
                    'status_color' => 'bg-amber-100 text-amber-700'
                ],
                [
                    'user' => 'Daniel Kim',
                    'action' => 'User Login - Point of Sale 3',
                    'status' => 'Active',
                    'status_color' => 'bg-blue-100 text-blue-700'
                ],
            ]
        ];

        return view('dashboard.index', $data);
    }
}