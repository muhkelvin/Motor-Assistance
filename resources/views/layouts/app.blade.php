<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Honda Care - {{ $title ?? 'Customer Service' }}</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Custom Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'honda-red': '#E40521',
                        'electric-blue': '#00B0F0',
                        'sunny-yellow': '#FFD700',
                        'fresh-green': '#7FFF00',
                        'vibrant-orange': '#FFA500',
                    },
                    fontFamily: {
                        'heading': ['Poppins', 'sans-serif'],
                        'body': ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- AlpineJS for Interactive Components -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        .gradient-header {
            background: linear-gradient(90deg, #E40521 0%, #FFA500 100%);
        }
        .gradient-footer {
            background: linear-gradient(90deg, #00B0F0 0%, #7FFF00 100%);
        }
        .active-nav {
            @apply bg-white bg-opacity-20 rounded-lg px-3 py-1;
        }
    </style>
</head>
<body class="font-body text-gray-800 bg-gray-50 min-h-screen flex flex-col">
<!-- Header Section -->
<header class="gradient-header text-white shadow-lg sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <nav class="flex justify-between items-center py-4">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3">
                <div class="bg-yellow-400 rounded-full p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                </div>
                <span class="font-heading text-xl md:text-2xl">Honda Care</span>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex space-x-6">
                <a href="{{ route('home') }}" class="nav-link {{ request()->is('/') ? 'active-nav' : '' }}">Home</a>
                <a href="{{ route('catalog.index') }}" class="nav-link {{ request()->is('katalog*') ? 'active-nav' : '' }}">Katalog</a>
                <a href="{{ route('credit-simulation.index') }}" class="nav-link {{ request()->is('simulasi-kredit*') ? 'active-nav' : '' }}">Simulasi Kredit</a>
                <a href="{{ url('/tentang') }}" class="nav-link {{ request()->is('tentang') ? 'active-nav' : '' }}">About</a>
                <a href="{{ url('/kontak') }}" class="nav-link {{ request()->is('kontak') ? 'active-nav' : '' }}">Contact</a>
                <a href="{{ route('inquiry.create') }}" class="nav-link {{ request()->is('inquiry*') ? 'active-nav' : '' }}">Inquiry</a>

            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-button" class="md:hidden text-white focus:outline-none">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                </svg>
            </button>
        </nav>
    </div>

    <!-- Mobile Navigation -->
    <div id="mobile-menu" class="hidden md:hidden py-4 px-4 bg-honda-red">
        <div class="flex flex-col space-y-3">
            <a href="{{ route('home') }}" class="nav-link {{ request()->is('/') ? 'active-nav' : '' }}">Home</a>
            <a href="{{ route('catalog.index') }}" class="nav-link {{ request()->is('katalog*') ? 'active-nav' : '' }}">Katalog</a>
            <a href="{{ route('credit-simulation.index') }}" class="nav-link {{ request()->is('simulasi-kredit*') ? 'active-nav' : '' }}">Simulasi Kredit</a>
            <a href="{{ url('/tentang') }}" class="nav-link {{ request()->is('tentang') ? 'active-nav' : '' }}">About</a>
            <a href="{{ url('/kontak') }}" class="nav-link {{ request()->is('kontak') ? 'active-nav' : '' }}">Contact</a>
            <a href="{{ route('inquiry.create') }}" class="nav-link {{ request()->is('inquiry*') ? 'active-nav' : '' }}">Inquiry</a>
        </div>
    </div>
</header>

<!-- Main Content -->
<main class="flex-grow container mx-auto px-4 py-8">
    @yield('content')
</main>

<!-- Footer Section -->
<footer class="gradient-footer text-white py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="font-heading text-xl mb-4">Honda Care</h3>
                <p>Layanan pelanggan terbaik untuk produk Honda di Indonesia</p>
            </div>

            <div>
                <h4 class="font-semibold mb-4">Navigasi</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="hover:text-yellow-300">Home</a></li>
                    <li><a href="{{ route('catalog.index') }}" class="hover:text-yellow-300">Katalog</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-yellow-300">Tentang Kami</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold mb-4">Layanan</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('motors.compare') }}" class="hover:text-yellow-300">Bandingkan Motor</a></li>
                    <li><a href="{{ route('credit-simulation.index') }}" class="hover:text-yellow-300">Simulasi Kredit</a></li>
                    <li><a href="{{ route('inquiry.create') }}" class="hover:text-yellow-300">Ajukan Pertanyaan</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold mb-4">Kontak</h4>
                <p>📱 +62 21 1234 5678</p>
                <p>✉️ customercare@honda.id</p>
                <div class="flex space-x-4 mt-4">
                    <a href="#" class="bg-white p-2 rounded-full">
                        <svg class="h-5 w-5 text-electric-blue" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    </a>
                    <a href="#" class="bg-white p-2 rounded-full">
                        <svg class="h-5 w-5 text-electric-blue" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="border-t border-white border-opacity-30 mt-8 pt-6 text-center text-sm">
            <p>&copy; {{ date('Y') }} Honda Care. Hak Cipta Dilindungi</p>
            <div class="mt-2">
                <a href="{{ route('terms') }}" class="mx-2 hover:text-yellow-300">Syarat & Ketentuan</a>
                <a href="{{ route('privacy') }}" class="mx-2 hover:text-yellow-300">Kebijakan Privasi</a>
            </div>
        </div>
    </div>
</footer>

<!-- Mobile Menu Script -->
<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>

@stack('scripts')
<script>
    // Search Auto Complete
    const searchInput = document.querySelector('input[name="search"]');
    if (searchInput) {
        const searchUrl = "{{ route('motors.search') }}";
        let timeout = null;

        searchInput.addEventListener('input', function() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                const query = this.value.trim();
                if (query.length < 2) {
                    hideResults();
                    return;
                }

                fetch(`${searchUrl}?q=${query}`)
                    .then(response => response.json())
                    .then(data => showResults(data));
            }, 300);
        });

        function showResults(results) {
            hideResults();

            if (results.length === 0) return;

            const resultsContainer = document.createElement('div');
            resultsContainer.id = 'search-results';
            resultsContainer.className = 'absolute left-0 right-0 z-50 bg-white border border-gray-200 rounded-lg shadow-lg mt-1 max-h-80 overflow-y-auto';

            results.forEach(item => {
                const itemElement = document.createElement('a');
                itemElement.href = item.url;
                itemElement.className = 'flex items-center p-3 hover:bg-gray-50 border-b border-gray-100 last:border-0';

                itemElement.innerHTML = `
                    <div class="w-12 h-12 flex-shrink-0 bg-gray-200 rounded overflow-hidden mr-3">
                        ${item.image ? `<img src="${item.image}" alt="${item.name}" class="w-full h-full object-cover">` : ''}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="font-medium text-gray-800 truncate">${item.name}</div>
                        <div class="text-sm text-honda-red font-bold">${item.price}</div>
                    </div>
                `;

                resultsContainer.appendChild(itemElement);
            });

            searchInput.parentNode.appendChild(resultsContainer);
        }

        function hideResults() {
            const existing = document.getElementById('search-results');
            if (existing) existing.remove();
        }

        // Close results when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target)) {
                hideResults();
            }
        });
    }
</script>
</body>
</html>
