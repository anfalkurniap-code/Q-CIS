<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class reportindexController extends Controller
{
    public function index()
    {
        // Data Pendapatan
        $revenue_details = [
            'product_sales'  => 42500.00,
            'service_income' => 12300.00,
        ];
        $gross_revenue = array_sum($revenue_details);
        $gross_growth  = 12.5; // Persentase pertumbuhan kotor

        // Data Beban Operasional
        $operating_expenses = [
            'rent_and_utilities' => [
                'desc'   => 'Sewa toko & listrik/air',
                'amount' => 4500.00,
            ],
            'salaries_and_wages' => [
                'desc'   => 'Gaji karyawan toko',
                'amount' => 12500.00,
            ],
            'marketing_and_ads'  => [
                'desc'   => 'Iklan & promosi lokal',
                'amount' => 2100.00,
            ],
            'supplies_and_maintenance' => [
                'desc'   => 'Pemeliharaan alat & operasional',
                'amount' => 1400.00,
            ],
        ];

        // Total Beban Operasional
        $total_expenses = array_sum(array_column($operating_expenses, 'amount'));
        $expense_growth = '+2.4%';

        // Keuntungan Bersih
        $net_profit = $gross_revenue - $total_expenses;

        // Margin Keuntungan (%)
        $profit_margin_percent = $gross_revenue > 0 ? ($net_profit / $gross_revenue) * 100 : 0;
        $profit_margin         = number_format($profit_margin_percent, 1) . '%';

        // Grafik Trend Kuartal
        $quarterly_trend = [
            ['quarter' => 'Q1', 'percentage' => 45, 'amount' => '$32,000'],
            ['quarter' => 'Q2', 'percentage' => 65, 'amount' => '$45,000'],
            ['quarter' => 'Q3', 'percentage' => 80, 'amount' => '$51,800'],
            ['quarter' => 'Q4', 'percentage' => 95, 'amount' => '$54,800'],
        ];

        return view('ReportIndex', compact(
            'gross_growth',
            'gross_revenue',
            'expense_growth',
            'total_expenses',
            'net_profit',
            'profit_margin',
            'revenue_details',
            'operating_expenses',
            'quarterly_trend'
        ));
    }
}