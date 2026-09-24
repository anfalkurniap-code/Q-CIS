<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi - Q-CIS SMK MART</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #333333;
            line-height: 1.4;
            margin: 0;
            padding: 15px;
        }

        /* Kop Surat */
        .header {
            border-bottom: 2px solid #064e3b;
            padding-bottom: 10px;
            margin-bottom: 15px;
            text-align: center;
        }
        .header h1 {
            color: #064e3b;
            font-size: 20px;
            font-weight: bold;
            margin: 0 0 4px 0;
            text-transform: uppercase;
        }
        .header p {
            margin: 2px 0;
            color: #555555;
            font-size: 10px;
        }

        .meta-info {
            margin-bottom: 15px;
            display: table;
            width: 100%;
        }
        .meta-info div {
            display: table-cell;
        }
        .meta-info .right {
            text-align: right;
        }

        /* Summary Cards Table */
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .summary-table th, .summary-table td {
            border: 1px solid #e2e8f0;
            padding: 8px 10px;
            text-align: left;
        }
        .summary-table th {
            background-color: #f1f5f9;
            color: #1e293b;
            font-weight: bold;
            font-size: 10px;
            text-transform: uppercase;
        }
        .summary-card-value {
            font-size: 13px;
            font-weight: bold;
        }
        .text-green { color: #047857; }
        .text-red { color: #b91c1c; }
        .text-blue { color: #1d4ed8; }

        /* Section Headings */
        .section-title {
            font-size: 13px;
            font-weight: bold;
            color: #064e3b;
            border-bottom: 1.5px solid #cbd5e1;
            padding-bottom: 4px;
            margin-top: 15px;
            margin-bottom: 8px;
        }

        /* Data Tables */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .data-table th, .data-table td {
            border: 1px solid #e2e8f0;
            padding: 6px 8px;
            text-align: left;
            font-size: 10px;
        }
        .data-table th {
            background-color: #064e3b;
            color: #ffffff;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 9px;
        }
        .data-table tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }

        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .badge-pending { background-color: #fef3c7; color: #b45309; }
        .badge-approved { background-color: #d1fae5; color: #047857; }
        .badge-rejected { background-color: #ffe4e6; color: #be123c; }

        .footer {
            margin-top: 25px;
            text-align: right;
            font-size: 10px;
        }
    </style>
</head>
<body>

    <!-- Header / Kop Surat -->
    <div class="header">
        <h1>Q-CIS SMK MART</h1>
        <p>Laporan Rekapitulasi Transaksi & Financial Summary</p>
        <p>SMK Negerikepala Toko • Email: info@smkmart.sch.id</p>
    </div>

    <!-- Meta Info -->
    <div class="meta-info">
        <div>
            <strong>Periode Laporan:</strong> 
            @if(!empty($startDate) || !empty($endDate))
                {{ !empty($startDate) ? \Carbon\Carbon::parse($startDate)->format('d M Y') : 'Awal' }}
                s/d 
                {{ !empty($endDate) ? \Carbon\Carbon::parse($endDate)->format('d M Y') : 'Hari Ini' }}
            @else
                Semua Periode
            @endif
        </div>
        <div class="right">
            <strong>Dicetak Tanggal:</strong> {{ \Carbon\Carbon::now()->format('d M Y H:i') }}
        </div>
    </div>

    <!-- Ringkasan Laporan Ringkas -->
    <table class="summary-table">
        <thead>
            <tr>
                <th>Total Barang Masuk</th>
                <th>Total Barang Keluar</th>
                <th>Total Uang Masuk</th>
                <th>Total Uang Keluar (Modal)</th>
                <th>Laba / Rugi Netto</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><span class="summary-card-value text-blue">{{ number_format($summary['total_barang_masuk'] ?? 0) }} Unit</span></td>
                <td><span class="summary-card-value text-blue">{{ number_format($summary['total_barang_keluar'] ?? 0) }} Unit</span></td>
                <td><span class="summary-card-value text-green">Rp{{ number_format($summary['total_uang_masuk'] ?? 0, 0, ',', '.') }}</span></td>
                <td><span class="summary-card-value text-red">Rp{{ number_format($summary['total_uang_keluar'] ?? 0, 0, ',', '.') }}</span></td>
                <td>
                    <span class="summary-card-value {{ ($summary['laba_rugi_netto'] ?? 0) >= 0 ? 'text-green' : 'text-red' }}">
                        Rp{{ number_format($summary['laba_rugi_netto'] ?? 0, 0, ',', '.') }}
                    </span>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Table 1: Rincian Barang Masuk (Gudang) -->
    <div class="section-title">I. Detail Rincian Barang Masuk (Gudang)</div>
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Tanggal</th>
                <th style="width: 30%;">Nama Barang</th>
                <th style="width: 10%;" class="text-right">Jumlah</th>
                <th style="width: 15%;" class="text-right">Harga Beli</th>
                <th style="width: 15%;" class="text-right">Harga Jual</th>
                <th style="width: 10%;" class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($barangMasuk ?? [] as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td class="text-right">{{ number_format($item->jumlah ?? 0) }}</td>
                    <td class="text-right">Rp{{ number_format($item->purchase_price ?? $item->harga ?? 0, 0, ',', '.') }}</td>
                    <td class="text-right">Rp{{ number_format($item->harga ?? 0, 0, ',', '.') }}</td>
                    <td class="text-center">
                        @if(($item->status ?? 'pending') == 'pending')
                            <span class="badge badge-pending">Menunggu</span>
                        @elseif($item->status == 'approved')
                            <span class="badge badge-approved">Disetujui</span>
                        @else
                            <span class="badge badge-rejected">Ditolak</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data barang masuk pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Table 2: Rincian Barang Keluar (Penjualan Kasir) -->
    <div class="section-title">II. Detail Rincian Barang Keluar (Penjualan Kasir)</div>
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Invoice</th>
                <th style="width: 15%;">Tanggal</th>
                <th style="width: 35%;">Detail Produk</th>
                <th style="width: 15%;" class="text-center">Metode Bayar</th>
                <th style="width: 15%;" class="text-right">Total Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($barangKeluar ?? [] as $index => $trx)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td><strong>{{ $trx->invoice_number }}</strong></td>
                    <td>{{ \Carbon\Carbon::parse($trx->created_at)->format('d/m/Y H:i') }}</td>
                    <td>
                        @foreach($trx->details as $detail)
                            <div>• {{ $detail->product_name }} ({{ number_format($detail->quantity) }}x @ Rp{{ number_format($detail->price, 0, ',', '.') }})</div>
                        @endforeach
                    </td>
                    <td class="text-center">{{ $trx->payment_method ?? 'CASH' }}</td>
                    <td class="text-right"><strong>Rp{{ number_format($trx->total_price, 0, ',', '.') }}</strong></td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data barang keluar pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Mengetahui,</p>
        <br><br><br>
        <p><strong>Kepala Toko Q-CIS SMK MART</strong></p>
    </div>

</body>
</html>
