<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Ops - Dashboard Kepala Toko</title>
    <!-- Tailwind CSS CDN (jika belum via Vite) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 text-slate-800 font-sans pb-20">

    <!-- Top Navigation Bar -->
    <header class="sticky top-0 z-30 bg-white border-b border-slate-100 px-4 py-3 flex items-center justify-between shadow-sm">
        <div class="flex items-center space-x-3">
            <button class="text-slate-600 hover:text-slate-900">
                <i class="fa-solid fa-bars text-lg"></i>
            </button>
            <h1 class="text-lg font-bold text-slate-800">Store Ops</h1>
        </div>
        <div class="relative">
            <button class="text-slate-600 hover:text-slate-900 p-1">
                <i class="fa-regular fa-bell text-lg"></i>
                <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>
        </div>
    </header>

    <main class="max-w-md mx-auto px-4 pt-5 space-y-4">
        
        <!-- Header Text Section -->
        <div>
            <h2 class="text-xl font-bold text-slate-900">Operational Overview</h2>
            <p class="text-xs text-slate-500 mt-0.5">Real-time performance metrics for today, Oct 24th.</p>
        </div>

        <!-- Card 1: Today Sales -->
        <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">TODAY'S SALES</span>
                    <div class="text-2xl font-extrabold text-slate-900 mt-0.5">
                        ${{ number_format($today_sales) }}
                    </div>
                </div>
                <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center">
                    <i class="fa-solid fa-chart-line text-sm"></i>
                </div>
            </div>

            <!-- Mini Bar Chart Visual -->
            <div class="flex items-end gap-1.5 h-10 mt-3 mb-2">
                <div class="bg-emerald-100 w-full h-1/3 rounded-sm"></div>
                <div class="bg-emerald-100 w-full h-1/2 rounded-sm"></div>
                <div class="bg-emerald-200 w-full h-2/5 rounded-sm"></div>
                <div class="bg-emerald-200 w-full h-1/3 rounded-sm"></div>
                <div class="bg-emerald-400 w-full h-3/4 rounded-sm"></div>
                <div class="bg-emerald-800 w-full h-full rounded-sm"></div>
            </div>

            <div class="text-[11px] text-emerald-600 font-medium flex items-center gap-1">
                <i class="fa-solid fa-arrow-up text-[10px]"></i>
                <span>+{{ $sales_growth }}% vs yesterday</span>
            </div>
        </div>

        <!-- Card 2: Active Orders -->
        <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm">
            <div class="flex justify-between items-start mb-2">
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">ACTIVE ORDERS</span>
                    <div class="text-2xl font-extrabold text-slate-900 mt-0.5">{{ $active_orders }}</div>
                </div>
                <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center">
                    <i class="fa-solid fa-box text-sm"></i>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden flex my-2">
                <div class="bg-emerald-800 h-full" style="width: 75%"></div>
                <div class="bg-emerald-300 h-full" style="width: 25%"></div>
            </div>

            <div class="space-y-1 text-xs pt-1">
                <div class="flex justify-between text-slate-600">
                    <span>Processing</span>
                    <span class="font-semibold text-slate-800">{{ $processing_orders }}</span>
                </div>
                <div class="flex justify-between text-slate-600">
                    <span>Ready for Pickup</span>
                    <span class="font-semibold text-slate-800">{{ $ready_pickup_orders }}</span>
                </div>
            </div>
        </div>

        <!-- Card 3: Low Stock Items -->
        <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm">
            <div class="flex justify-between items-start mb-3">
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">LOW STOCK ITEMS</span>
                    <div class="text-2xl font-extrabold text-red-600 mt-0.5">{{ $low_stock_count }}</div>
                </div>
                <div class="w-8 h-8 rounded-lg bg-red-100 text-red-500 flex items-center justify-center">
                    <i class="fa-solid fa-triangle-exclamation text-sm"></i>
                </div>
            </div>

            <div class="divide-y divide-slate-100 text-xs">
                @foreach($low_stock_items as $item)
                <div class="py-2 flex justify-between items-center">
                    <span class="text-slate-700 font-medium truncate max-w-[200px]">{{ $item['name'] }}</span>
                    <span class="px-1.5 py-0.5 text-[9px] font-bold rounded {{ $item['status'] == 'CRITICAL' ? 'bg-red-100 text-red-600' : 'bg-orange-100 text-orange-600' }}">
                        {{ $item['status'] }}
                    </span>
                </div>
                @endforeach
            </div>

            <a href="#" class="block text-right text-xs text-emerald-700 font-semibold mt-2 hover:underline">
                View all 5 items &rsaquo;
            </a>
        </div>

        <!-- Card 4: Sales Trend (Last 7 Days) -->
        <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xs font-bold text-slate-800">Sales Trend (Last 7 Days)</h3>
                <div class="flex bg-slate-100 p-0.5 rounded-lg text-[10px] font-medium">
                    <button class="px-2 py-1 bg-emerald-800 text-white rounded-md shadow-xs">Count Data</button>
                    <button class="px-2 py-1 text-slate-600 hover:text-slate-900">Earnings</button>
                </div>
            </div>

            <!-- Bar Chart Display -->
            <div class="flex items-end justify-between gap-2 h-28 pt-4 pb-1 px-1 border-b border-slate-100">
                @foreach($sales_trend as $day => $val)
                <div class="flex-1 flex flex-col items-center h-full justify-end">
                    <div class="w-full bg-emerald-600/70 hover:bg-emerald-700 rounded-t-md transition-all" style="height: {{ ($val / 800) * 100 }}%"></div>
                </div>
                @endforeach
            </div>
            <div class="flex justify-between text-[10px] text-slate-400 mt-2 px-1">
                @foreach(array_keys($sales_trend) as $day)
                    <span>{{ $day }}</span>
                @endforeach
            </div>
        </div>

        <!-- Card 5: Live Operations -->
        <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm relative">
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-xs font-bold text-slate-800">Live Operations</h3>
                <a href="#" class="text-[11px] text-emerald-700 font-semibold hover:underline">View All Logs</a>
            </div>

            <div class="space-y-3">
                @foreach($live_operations as $log)
                <div class="flex items-center justify-between text-xs py-1">
                    <div class="flex items-center space-x-2.5">
                        <div class="w-7 h-7 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-[10px] font-bold text-slate-600">
                            {{ substr($log['user'], 0, 1) }}
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800 leading-tight">{{ $log['user'] }}</p>
                            <p class="text-[10px] text-slate-500 truncate max-w-[150px]">{{ $log['action'] }}</p>
                        </div>
                    </div>
                    <span class="px-2 py-0.5 text-[10px] font-medium rounded-full {{ $log['status_color'] }}">
                        {{ $log['status'] }}
                    </span>
                </div>
                @endforeach
            </div>
        </div>

    </main>

    <!-- Floating Action Button (FAB) -->
    <button class="fixed bottom-16 right-5 w-12 h-12 bg-emerald-900 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-emerald-950 transition-all z-20">
        <i class="fa-solid fa-plus text-lg"></i>
    </button>

    <!-- Bottom Navigation Bar -->
    <nav class="fixed bottom-0 inset-x-0 bg-white border-t border-slate-100 py-2 px-6 flex justify-between items-center z-30 text-slate-400 text-[10px]">
        <a href="#" class="flex flex-col items-center text-emerald-800 font-bold">
            <i class="fa-solid fa-chart-simple text-base mb-0.5"></i>
            <span>Overview</span>
        </a>
        <a href="#" class="flex flex-col items-center hover:text-slate-700">
            <i class="fa-solid fa-box-archive text-base mb-0.5"></i>
            <span>Orders</span>
        </a>
        <a href="#" class="flex flex-col items-center hover:text-slate-700">
            <i class="fa-solid fa-warehouse text-base mb-0.5"></i>
            <span>Inventory</span>
        </a>
        <a href="#" class="flex flex-col items-center hover:text-slate-700">
            <i class="fa-solid fa-users text-base mb-0.5"></i>
            <span>Staff</span>
        </a>
    </nav>

</body>
</html>