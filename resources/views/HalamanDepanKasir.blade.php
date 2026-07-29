<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Q-CIS E-Commerce</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-100 flex justify-center">

  <div class="w-full max-w-md bg-[#F8F9FD] min-h-screen shadow-lg flex flex-col justify-between relative pb-20">
    
    <header class="bg-white px-4 py-3 border-b border-gray-100 sticky top-0 z-50">
      <div class="flex items-center justify-between">
        <div class="text-[#107C41] font-bold text-xl tracking-wide">Q-CIS</div>
        <div class="flex items-center gap-4 text-gray-700">
          
          <button id="btn-toggle-search" onclick="toggleSearch()" class="p-1 hover:text-[#107C41] transition">
            <i data-lucide="search" class="w-6 h-6 stroke-[2.5]"></i>
          </button>
          
          <a href="{{ url('/HalamanKeranjang') }}" class="relative p-1 hover:text-[#107C41] transition">
            <i data-lucide="shopping-cart" class="w-6 h-6 stroke-[2.5]"></i>
            <span id="badge-cart-header" class="absolute -top-1.5 -right-1.5 bg-[#D32F2F] text-white text-[10px] font-bold rounded-full w-4 h-4 flex items-center justify-center">0</span>
          </a>
          
          <button class="p-1 hover:text-[#107C41] transition">
            <i data-lucide="bell" class="w-6 h-6 stroke-[2.5]"></i>
          </button>
        </div>
      </div>

      <div id="search-bar-container" class="hidden mt-3 relative transition-all duration-300">
        <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 w-4 h-4"></i>
        <input 
          type="text" 
          id="input-search-header"
          placeholder="Cari produk..." 
          class="w-full bg-gray-100 text-gray-800 text-xs pl-9 pr-8 py-2 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#107C41]"
          onkeyup="handleHeaderSearch(event)"
        >
        <button onclick="toggleSearch()" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
          <i data-lucide="x" class="w-4 h-4"></i>
        </button>
      </div>
    </header>

    <main class="flex-1 px-4 py-4 space-y-6">
      
      <section class="space-y-3">
        <h2 class="text-[#2D3748] font-semibold text-base">Special Offers</h2>
        
        <div class="relative rounded-2xl overflow-hidden h-36 bg-gradient-to-r from-amber-700 to-amber-900 shadow-sm flex items-end">
          <div class="absolute inset-0 bg-black/30 z-0"></div>
          <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent p-4 flex flex-col justify-end z-10">
            <span class="bg-[#006A33] text-white text-[9px] font-bold px-2 py-0.5 rounded w-max mb-1.5 uppercase tracking-wider">Limited Time</span>
            <h3 class="text-white font-bold text-base leading-tight">Diskon 20% Sandwich</h3>
            <p class="text-gray-300 text-[11px] mt-0.5">Freshly made every morning in our canteen.</p>
          </div>
        </div>

        <div class="relative rounded-2xl overflow-hidden h-36 bg-gradient-to-r from-slate-600 to-slate-800 shadow-sm flex items-end">
          <div class="absolute inset-0 bg-black/30 z-0"></div>
          <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent p-4 flex flex-col justify-end z-10">
            <span class="bg-[#4A5568] text-white text-[9px] font-bold px-2 py-0.5 rounded w-max mb-1.5 uppercase tracking-wider">Bundle Deal</span>
            <h3 class="text-white font-bold text-base leading-tight">Beli 2 Gratis 1 Buku Tulis</h3>
            <p class="text-gray-300 text-[11px] mt-0.5">Stock up for your final exams now!</p>
          </div>
        </div>

        <div class="relative rounded-2xl overflow-hidden h-36 bg-gradient-to-r from-cyan-800 to-blue-900 shadow-sm flex items-end">
          <div class="absolute inset-0 bg-black/30 z-0"></div>
          <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent p-4 flex flex-col justify-end z-10">
            <span class="bg-[#D32F2F] text-white text-[9px] font-bold px-2 py-0.5 rounded w-max mb-1.5 uppercase tracking-wider">Flash Sale</span>
            <h3 class="text-white font-bold text-base leading-tight">Hemat 50% Minuman Dingin</h3>
            <p class="text-gray-300 text-[11px] mt-0.5">Available only during school break time.</p>
          </div>
        </div>
      </section>

      <section class="space-y-3">
        <div class="flex justify-between items-center">
          <h2 class="text-[#2D3748] font-semibold text-base">Featured Products</h2>
          <a href="{{ url('/HalamanShop') }}" class="text-[#107C41] text-xs font-semibold hover:underline">See All</a>
        </div>
        
        <div class="grid grid-cols-2 gap-3" id="featured-products-grid">
          
          <div class="product-item bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 flex flex-col justify-between relative">
            <span class="absolute top-2 right-2 bg-[#006A33] text-white text-[9px] font-medium px-2 py-0.5 rounded-full z-10">Bestseller</span>
            <div class="bg-[#EAEAEA] h-36 flex items-center justify-center p-2">
              <svg class="w-12 h-24" viewBox="0 0 50 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="15" y="10" width="20" height="8" rx="2" fill="#2563EB"/>
                <path d="M10 30C10 23.3726 15.3726 18 22 18H28C34.6274 18 40 23.3726 40 30V90C40 92.2091 38.2091 94 36 94H14C11.7909 94 10 92.2091 10 90V30Z" fill="#93C5FD" fill-opacity="0.6" stroke="#2563EB" stroke-width="2"/>
                <rect x="10" y="45" width="30" height="15" fill="#3B82F6"/>
              </svg>
            </div>
            <div class="p-3">
              <span class="text-[10px] font-bold uppercase tracking-wider text-blue-600 block mb-0.5">Minuman</span>
              <h4 class="product-title text-gray-800 text-sm font-semibold truncate">Air Mineral 600ml</h4>
            </div>
          </div>

          <div class="product-item bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 flex flex-col justify-between">
            <div class="bg-[#EAEAEA] h-36 flex items-center justify-center p-2">
              <svg class="w-16 h-16" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="5" y="15" width="50" height="40" rx="4" fill="#FDE68A" stroke="#D97706" stroke-width="2"/>
                <path d="M5 25L30 5L55 25" stroke="#D97706" stroke-width="2" fill="#FEF3C7"/>
              </svg>
            </div>
            <div class="p-3">
              <span class="text-[10px] font-bold uppercase tracking-wider text-amber-600 block mb-0.5">Makanan</span>
              <h4 class="product-title text-gray-800 text-sm font-semibold truncate">Roti Coklat Lumer</h4>
            </div>
          </div>

          <div class="product-item bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 flex flex-col justify-between">
            <div class="bg-[#EAEAEA] h-36 flex items-center justify-center p-2">
              <svg class="w-14 h-16" viewBox="0 0 50 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="5" y="5" width="40" height="50" rx="3" fill="#F3F4F6" stroke="#4A5568" stroke-width="2"/>
                <rect x="5" y="5" width="10" height="50" fill="#4A5568"/>
                <line x1="20" y1="15" x2="38" y2="15" stroke="#9CA3AF" stroke-width="2"/>
                <line x1="20" y1="25" x2="38" y2="25" stroke="#9CA3AF" stroke-width="2"/>
              </svg>
            </div>
            <div class="p-3">
              <span class="text-[10px] font-bold uppercase tracking-wider text-slate-600 block mb-0.5">Alat Tulis</span>
              <h4 class="product-title text-gray-800 text-sm font-semibold truncate">Buku Tulis Sidu</h4>
            </div>
          </div>

          <div class="product-item bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 flex flex-col justify-between">
            <div class="bg-[#EAEAEA] h-36 flex items-center justify-center p-2">
              <svg class="w-6 h-20" viewBox="0 0 20 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="6" y="20" width="8" height="50" rx="1" fill="#1E293B"/>
                <path d="M6 20L10 5L14 20H6Z" fill="#94A3B8"/>
                <rect x="6" y="30" width="8" height="10" fill="#2563EB"/>
              </svg>
            </div>
            <div class="p-3">
              <span class="text-[10px] font-bold uppercase tracking-wider text-slate-600 block mb-0.5">Alat Tulis</span>
              <h4 class="product-title text-gray-800 text-sm font-semibold truncate">Pulpen Pilot 0.5</h4>
            </div>
          </div>

        </div>
      </section>
    </main>

    <nav class="absolute bottom-0 left-0 right-0 bg-white border-t border-gray-200 px-4 py-2 flex justify-around items-center z-50">
      <a href="{{ url('/HalamanDepanKasir') }}" class="flex flex-col items-center justify-center bg-[#84FF95] text-[#006A33] px-5 py-1.5 rounded-xl font-bold text-xs gap-0.5">
        <i data-lucide="home" class="w-5 h-5 stroke-[2.5]"></i>
        <span>Home</span>
      </a>
      <a href="{{ url('/HalamanShop') }}" class="flex flex-col items-center justify-center text-gray-500 hover:text-gray-800 text-[11px] font-medium gap-1">
        <i data-lucide="shopping-bag" class="w-5 h-5"></i>
        <span>Shop</span>
      </a>
      <a href="#" class="flex flex-col items-center justify-center text-gray-500 hover:text-gray-800 text-[11px] font-medium gap-1">
        <i data-lucide="receipt" class="w-5 h-5"></i>
        <span>Trans</span>
      </a>
      <a href="{{ url('/HalamanProfile') }}" class="flex flex-col items-center justify-center text-gray-500 hover:text-gray-800 text-[11px] font-medium gap-1">
        <i data-lucide="user" class="w-5 h-5"></i>
        <span>Profile</span>
      </a>
    </nav>

  </div>

  <script>
    lucide.createIcons();

    function updateCartBadge() {
      const cart = JSON.parse(localStorage.getItem('cartItems')) || [];
      const totalItems = cart.reduce((sum, item) => sum + (item.qty || 1), 0);
      
      const badge = document.getElementById('badge-cart-header');
      if (badge) {
        badge.innerText = totalItems;
      }
    }

    function toggleSearch() {
      const searchContainer = document.getElementById('search-bar-container');
      const searchInput = document.getElementById('input-search-header');
      
      searchContainer.classList.toggle('hidden');
      
      if (!searchContainer.classList.contains('hidden')) {
        searchInput.focus();
      } else {
        searchInput.value = '';
        resetSearchFilter();
      }
    }

    function resetSearchFilter() {
      const productItems = document.querySelectorAll('.product-item');
      productItems.forEach(item => {
        item.style.display = ''; // Kembali ke CSS bawaan class (flex)
      });
    }

    function handleHeaderSearch(event) {
      const keyword = event.target.value.toLowerCase();
      const productItems = document.querySelectorAll('.product-item');

      productItems.forEach(item => {
        const title = item.querySelector('.product-title').innerText.toLowerCase();
        if (title.includes(keyword)) {
          item.style.display = ''; 
        } else {
          item.style.display = 'none'; 
        }
      });
    }

    document.addEventListener('DOMContentLoaded', updateCartBadge);
    window.addEventListener('pageshow', updateCartBadge);
    window.addEventListener('focus', updateCartBadge);
  </script>
</body>
</html>