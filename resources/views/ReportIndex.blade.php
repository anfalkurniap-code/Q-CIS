<?php
/**
 * Helper function untuk format angka ke Rupiah
 */
function formatRupiah($angka) {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

/**
 * Helper function untuk format persentase
 */
function formatPersen($angka) {
    return number_format($angka, 1, ',', '.') . '%';
}

// Data Simulasi berdasarkan Periode yang Dipilih
$periode_tersedia = [
    '2023-10' => 'Oktober 2023',
    '2023-11' => 'November 2023',
    '2023-12' => 'Desember 2023',
];

// Ambil periode dari query string / GET, default Oktober 2023
$selected_periode = isset($_GET['periode']) && array_key_exists($_GET['periode'], $periode_tersedia) 
    ? $_GET['periode'] 
    : '2023-10';

// Mock Data Laporan Keuangan berdasarkan Periode
$data_laporan = [
    '2023-10' => [
        'cabang' => 'Cabang Utama #402',
        'gross_growth' => 12.5,
        'expense_growth' => '+4.2%',
        'prev_month_comparison' => '+10,2% vs bln sebelumnya',
        'revenue_details' => [
            'product_sales' => 145000000, // Penjualan Produk
            'service_income' => 38500000,  // Pendapatan Layanan
        ],
        'operating_expenses' => [
            'hpp_cogs' => [
                'label' => 'Harga Pokok Penjualan (HPP)',
                'desc' => 'Biaya bahan baku dan produksi langsung',
                'amount' => 72000000
            ],
            'gaji_karyawan' => [
                'label' => 'Gaji & Tunjangan Karyawan',
                'desc' => 'Gaji staf operasional, bonus, & BPJS',
                'amount' => 32000000
            ],
            'sewa_operasional' => [
                'label' => 'Sewa Tempat & Fasilitas',
                'desc' => 'Sewa gedung bulanan & listrik/air',
                'amount' => 12500000
            ],
            'pemasaran' => [
                'label' => 'Biaya Pemasaran & Iklan',
                'desc' => 'Iklan digital & promosi outlet',
                'amount' => 6500000
            ],
            'utilitas_lainnya' => [
                'label' => 'Biaya Operasional Lainnya',
                'desc' => 'Perlengkapan toko & pemeliharaan',
                'amount' => 4500000
            ]
        ],
        'quarterly_trend' => [
            ['quarter' => 'Q1', 'percentage' => 45, 'amount' => 'Rp 120JT'],
            ['quarter' => 'Q2', 'percentage' => 65, 'amount' => 'Rp 155JT'],
            ['quarter' => 'Q3', 'percentage' => 80, 'amount' => 'Rp 172JT'],
            ['quarter' => 'Q4', 'percentage' => 95, 'amount' => 'Rp 183.5JT'],
        ]
    ],
    '2023-11' => [
        'cabang' => 'Cabang Utama #402',
        'gross_growth' => 8.3,
        'expense_growth' => '+2.1%',
        'prev_month_comparison' => '+5,4% vs bln sebelumnya',
        'revenue_details' => [
            'product_sales' => 158000000,
            'service_income' => 42000000,
        ],
        'operating_expenses' => [
            'hpp_cogs' => [
                'label' => 'Harga Pokok Penjualan (HPP)',
                'desc' => 'Biaya bahan baku dan produksi langsung',
                'amount' => 78000000
            ],
            'gaji_karyawan' => [
                'label' => 'Gaji & Tunjangan Karyawan',
                'desc' => 'Gaji staf operasional, bonus, & BPJS',
                'amount' => 33000000
            ],
            'sewa_operasional' => [
                'label' => 'Sewa Tempat & Fasilitas',
                'desc' => 'Sewa gedung bulanan & listrik/air',
                'amount' => 12500000
            ],
            'pemasaran' => [
                'label' => 'Biaya Pemasaran & Iklan',
                'desc' => 'Iklan digital & promosi outlet',
                'amount' => 8000000
            ],
            'utilitas_lainnya' => [
                'label' => 'Biaya Operasional Lainnya',
                'desc' => 'Perlengkapan toko & pemeliharaan',
                'amount' => 5000000
            ]
        ],
        'quarterly_trend' => [
            ['quarter' => 'Q1', 'percentage' => 45, 'amount' => 'Rp 120JT'],
            ['quarter' => 'Q2', 'percentage' => 65, 'amount' => 'Rp 155JT'],
            ['quarter' => 'Q3', 'percentage' => 80, 'amount' => 'Rp 172JT'],
            ['quarter' => 'Q4', 'percentage' => 98, 'amount' => 'Rp 200JT'],
        ]
    ],
    '2023-12' => [
        'cabang' => 'Cabang Utama #402',
        'gross_growth' => 18.2,
        'expense_growth' => '+7.8%',
        'prev_month_comparison' => '+14,8% vs bln sebelumnya',
        'revenue_details' => [
            'product_sales' => 195000000,
            'service_income' => 55000000,
        ],
        'operating_expenses' => [
            'hpp_cogs' => [
                'label' => 'Harga Pokok Penjualan (HPP)',
                'desc' => 'Biaya bahan baku dan produksi langsung',
                'amount' => 95000000
            ],
            'gaji_karyawan' => [
                'label' => 'Gaji & Tunjangan Karyawan',
                'desc' => 'Gaji staf operasional, bonus akhir tahun, & BPJS',
                'amount' => 42000000
            ],
            'sewa_operasional' => [
                'label' => 'Sewa Tempat & Fasilitas',
                'desc' => 'Sewa gedung bulanan & listrik/air',
                'amount' => 13500000
            ],
            'pemasaran' => [
                'label' => 'Biaya Pemasaran & Iklan',
                'desc' => 'Kampanye promo diskon akhir tahun',
                'amount' => 12000000
            ],
            'utilitas_lainnya' => [
                'label' => 'Biaya Operasional Lainnya',
                'desc' => 'Perlengkapan toko & pemeliharaan',
                'amount' => 6500000
            ]
        ],
        'quarterly_trend' => [
            ['quarter' => 'Q1', 'percentage' => 45, 'amount' => 'Rp 120JT'],
            ['quarter' => 'Q2', 'percentage' => 65, 'amount' => 'Rp 155JT'],
            ['quarter' => 'Q3', 'percentage' => 80, 'amount' => 'Rp 172JT'],
            ['quarter' => 'Q4', 'percentage' => 100, 'amount' => 'Rp 250JT'],
        ]
    ]
];

// Ambil data aktif
$aktif = $data_laporan[$selected_periode];

// PERHITUNGAN DINAMIS PHP
// 1. Total Pendapatan Kotor (Gross Revenue)
$gross_revenue = array_sum($aktif['revenue_details']);

// 2. Total Beban Operasional (Total Expenses)
$total_expenses = 0;
foreach ($aktif['operating_expenses'] as $item) {
    $total_expenses += $item['amount'];
}

// 3. Laba Bersih (Net Profit = Gross Revenue - Total Expenses)
$net_profit = $gross_revenue - $total_expenses;

// 4. Rasio Margin Laba Bersih (%)
$profit_margin = $gross_revenue > 0 ? ($net_profit / $gross_revenue) * 100 : 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Laba Rugi - Ops Toko (PHP)</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 flex justify-center py-6 px-4 min-h-screen">

    <!-- Container Utama -->
    <div class="w-full max-w-md bg-white rounded-3xl shadow-sm border border-slate-100 p-4 space-y-4">
        
        <!-- Header Nav -->
        <div class="flex justify-between items-center pb-2 border-b border-slate-100">
            <div class="flex items-center space-x-2 text-slate-700 font-bold text-lg">
                <i class="fa-solid fa-store text-emerald-800"></i>
                <span>Ops Toko PHP</span>
            </div>
            <button onclick="window.print()" title="Cetak Laporan" class="p-2 hover:bg-slate-100 rounded-full text-slate-500 transition-colors">
                <i class="fa-solid fa-print text-lg"></i>
            </button>
        </div>

        <!-- Judul & Subjudul -->
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Laporan Laba Rugi</h1>
            <p class="text-xs text-slate-400 mt-0.5">
                Periode Fiskal: <span class="font-semibold text-slate-600"><?= $periode_tersedia[$selected_periode] ?></span> • <?= $aktif['cabang'] ?>
            </p>
        </div>

        <!-- Filter Periode & Ekspor -->
        <form method="GET" action="" class="grid grid-cols-2 gap-2">
            <div class="relative">
                <select name="periode" onchange="this.form.submit()" class="w-full appearance-none bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3 text-xs font-semibold text-slate-700 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-emerald-600 cursor-pointer">
                    <?php foreach ($periode_tersedia as $key => $label): ?>
                        <option value="<?= $key ?>" <?= $key === $selected_periode ? 'selected' : '' ?>>
                            <?= $label ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-500">
                    <i class="fa-solid fa-chevron-down text-xs"></i>
                </div>
            </div>

            <button type="button" onclick="alert('Laporan <?= $periode_tersedia[$selected_periode] ?> berhasil diunduh dalam format PDF!')" class="flex items-center justify-center space-x-2 bg-[#064e3b] text-white rounded-xl py-2.5 text-xs font-semibold hover:bg-emerald-900 transition-colors shadow-sm">
                <i class="fa-solid fa-file-arrow-down"></i>
                <span>Ekspor PDF</span>
            </button>
        </form>

        <!-- Kartu 1: Pendapatan Kotor -->
        <div class="bg-white border border-slate-100 rounded-2xl p-4 shadow-sm relative">
            <div class="flex justify-between items-start">
                <div class="p-2 bg-slate-100 rounded-lg text-slate-600">
                    <i class="fa-solid fa-arrow-trend-up"></i>
                </div>
                <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-2 py-0.5 rounded-full">
                    +<?= formatPersen($aktif['gross_growth']) ?>
                </span>
            </div>
            <p class="text-xs font-medium text-slate-400 uppercase mt-3 tracking-wider">Pendapatan Kotor</p>
            <h2 class="text-2xl font-black text-slate-900 mt-1"><?= formatRupiah($gross_revenue) ?></h2>
        </div>

        <!-- Kartu 2: Total Beban Operasional -->
        <div class="bg-white border border-slate-100 rounded-2xl p-4 shadow-sm relative">
            <div class="flex justify-between items-start">
                <div class="p-2 bg-rose-50 rounded-lg text-rose-500">
                    <i class="fa-solid fa-receipt"></i>
                </div>
                <span class="bg-rose-100 text-rose-600 text-xs font-bold px-2 py-0.5 rounded-full">
                    <?= $aktif['expense_growth'] ?>
                </span>
            </div>
            <p class="text-xs font-medium text-slate-400 uppercase mt-3 tracking-wider">Total Beban Operasional</p>
            <h2 class="text-2xl font-black text-slate-900 mt-1"><?= formatRupiah($total_expenses) ?></h2>
        </div>

        <!-- Kartu 3: Spanduk Laba Bersih -->
        <div class="bg-[#064e3b] text-white rounded-2xl p-4 relative overflow-hidden shadow-sm">
            <p class="text-xs uppercase tracking-wider text-emerald-200 font-semibold">Laba Bersih Akhir</p>
            <h2 class="text-3xl font-black mt-1"><?= formatRupiah($net_profit) ?></h2>
            
            <div class="mt-3 flex items-center justify-between text-xs text-emerald-200 border-t border-emerald-800/80 pt-2">
                <span>Rasio Margin Laba</span>
                <span class="font-bold text-white"><?= formatPersen($profit_margin) ?></span>
            </div>
            <div class="w-full bg-emerald-900 rounded-full h-1.5 mt-1">
                <div class="bg-emerald-400 h-1.5 rounded-full transition-all duration-500" style="width: <?= min(100, max(0, $profit_margin)) ?>%"></div>
            </div>
        </div>

        <!-- Bagian: Tabel Rincian Keuangan -->
        <div class="border border-slate-100 rounded-2xl overflow-hidden shadow-sm">
            <div class="bg-indigo-50/50 p-3 flex justify-between items-center text-xs text-slate-500 font-medium">
                <span>Rincian Akun Laba Rugi</span>
                <span class="font-semibold text-slate-600">Semua angka dalam Rupiah (Rp)</span>
            </div>

            <div class="p-4 space-y-4 text-xs">
                <!-- Sub-bagian 1: Pendapatan -->
                <div>
                    <h3 class="font-bold text-emerald-600 uppercase tracking-wider mb-2">1. Pendapatan Usaha</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between font-semibold text-slate-700">
                            <span>Penjualan Produk</span>
                            <span class="font-bold text-slate-900"><?= formatRupiah($aktif['revenue_details']['product_sales']) ?></span>
                        </div>
                        <div class="flex justify-between font-semibold text-slate-700">
                            <span>Pendapatan Layanan / Jasa</span>
                            <span class="font-bold text-slate-900"><?= formatRupiah($aktif['revenue_details']['service_income']) ?></span>
                        </div>
                    </div>
                </div>

                <!-- Total Pendapatan Kotor Highlight -->
                <div class="bg-emerald-100/70 p-3 rounded-xl flex justify-between items-center">
                    <span class="font-bold text-emerald-900">Total Pendapatan Kotor</span>
                    <span class="font-black text-emerald-900 text-sm"><?= formatRupiah($gross_revenue) ?></span>
                </div>

                <!-- Sub-bagian 2: Beban Operasional -->
                <div class="pt-2">
                    <h3 class="font-bold text-slate-400 uppercase tracking-wider mb-3">2. Beban Operasional</h3>
                    <div class="space-y-3">
                        <?php foreach ($aktif['operating_expenses'] as $item): ?>
                        <div class="flex justify-between items-start border-b border-slate-50 pb-2 last:border-0 last:pb-0">
                            <div>
                                <p class="font-bold text-slate-800"><?= htmlspecialchars($item['label']) ?></p>
                                <p class="text-[10px] text-slate-400"><?= htmlspecialchars($item['desc']) ?></p>
                            </div>
                            <span class="font-bold text-slate-900"><?= formatRupiah($item['amount']) ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Total Beban Highlight -->
                <div class="bg-indigo-50 p-3 rounded-xl flex justify-between items-center">
                    <span class="font-bold text-indigo-900">Total Beban Operasional</span>
                    <span class="font-black text-indigo-900 text-sm">(<?= formatRupiah($total_expenses) ?>)</span>
                </div>

                <!-- Total Laba Bersih Highlight -->
                <div class="bg-[#064e3b] text-white p-3.5 rounded-xl flex justify-between items-center mt-2 shadow-sm">
                    <div>
                        <p class="font-bold text-[11px] text-emerald-200 uppercase">Total Laba Bersih</p>
                        <p class="text-[10px] text-emerald-300">Setelah pemotongan seluruh beban</p>
                    </div>
                    <div class="text-right">
                        <p class="font-black text-sm"><?= formatRupiah($net_profit) ?></p>
                        <p class="text-[10px] text-emerald-300"><?= $aktif['prev_month_comparison'] ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Tren Triwulan -->
        <div class="border border-slate-100 rounded-2xl p-4 space-y-3">
            <h3 class="text-xs font-bold text-slate-500 flex items-center space-x-1">
                <i class="fa-solid fa-chart-line text-emerald-700"></i>
                <span>Tren Pendapatan Triwulan</span>
            </h3>
            <div class="space-y-2">
                <?php foreach ($aktif['quarterly_trend'] as $trend): ?>
                <div class="flex items-center space-x-3 text-xs">
                    <span class="w-8 font-bold text-slate-500"><?= $trend['quarter'] ?></span>
                    <div class="flex-1 bg-slate-100 rounded-lg h-6 overflow-hidden relative flex items-center">
                        <div class="bg-[#064e3b] h-full rounded-lg transition-all duration-500" style="width: <?= $trend['percentage'] ?>%"></div>
                        <span class="absolute right-2 font-bold text-[10px] text-slate-700"><?= $trend['amount'] ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Diagram Alokasi Beban -->
        <div class="border border-slate-100 rounded-2xl p-4 space-y-3">
            <h3 class="text-xs font-bold text-slate-500 flex items-center space-x-1">
                <i class="fa-solid fa-chart-pie text-emerald-700"></i>
                <span>Persentase Alokasi Beban</span>
            </h3>
            <div class="flex items-center justify-around pt-2">
                <!-- Diagram Donat Pure CSS -->
                <div class="w-20 h-20 rounded-full border-8 border-[#064e3b] border-t-emerald-400 border-r-slate-200 shadow-inner"></div>
                <div class="space-y-1.5 text-[11px]">
                    <div class="flex items-center space-x-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#064e3b]"></span>
                        <span class="text-slate-600 font-medium">HPP / COGS (55%)</span>
                    </div>
                    <div class="flex items-center space-x-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                        <span class="text-slate-600 font-medium">Gaji & Tunjangan (25%)</span>
                    </div>
                    <div class="flex items-center space-x-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-slate-200"></span>
                        <span class="text-slate-600 font-medium">Sewa & Lainnya (20%)</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center pt-2">
            <p class="text-[10px] text-slate-400">Dibuat secara otomatis dengan PHP • Laporan Resmi Toko</p>
        </div>

    </div>

</body>
</html>