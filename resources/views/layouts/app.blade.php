<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Analisis Kecerdasan Jamak')</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    
    <style>
        /* Reset margin/padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
        }
        /* Sidebar styling */
        .sidebar {
            width: 250px;
            background: linear-gradient(135deg, #2ecc71 0%, #27ae60 50%, #1e8449 100%);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 40;
            transition: transform 0.3s ease-in-out;
            transform: translateX(-100%);
        }
        .sidebar.open {
            transform: translateX(0);
        }
        /* Main content */
        .main-content {
            min-height: 100vh;
            background-color: #f3f4f6;
        }
        /* Navbar fixed */
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 0.75rem 1rem;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 20;
        }
        /* Content area with padding top for navbar */
        .content-area {
            padding-top: 4rem;
            padding-left: 1rem;
            padding-right: 1rem;
            padding-bottom: 1rem;
        }
        /* Overlay for mobile */
        .overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 35;
            display: none;
        }
        .overlay.show {
            display: block;
        }
        /* Desktop styles */
        @media (min-width: 768px) {
            .sidebar {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 250px;
            }
            .navbar {
                left: 250px;
            }
            .content-area {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
        }
        /* Dropdown menu */
        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            margin-top: 0.5rem;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
            min-width: 180px;
            z-index: 50;
        }
        .dropdown-menu.show {
            display: block;
        }
        /* Responsive tables */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        /* Card padding adjustment for mobile */
        @media (max-width: 640px) {
            .card-padding {
                padding: 1rem;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    @auth
    <div>
        <!-- Tombol hamburger (mobile) -->
        <button id="menuToggle" class="fixed top-3 left-3 z-50 p-2 rounded-md bg-green-600 text-white md:hidden shadow-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Sidebar -->
        <div id="sidebar" class="sidebar">
            <div class="p-4 border-b border-green-600 text-center">
                <img src="{{ asset('images/logo_sekolah.png') }}" class="w-20 h-20 mx-auto mb-2 object-contain" alt="Logo">
                <h2 class="text-lg font-bold text-white">Analisis Kecerdasan</h2>
                <p class="text-xs text-green-200">Multiple Intelligences</p>
            </div>
            <nav class="mt-4">
                @if(auth()->user()->role == 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center py-3 px-4 hover:bg-green-800 transition {{ request()->routeIs('admin.dashboard') ? 'bg-green-800' : '' }}">
                        <span class="mr-3">📊</span> Dashboard
                    </a>
                    <a href="{{ route('admin.kelola-guru') }}" class="flex items-center py-3 px-4 hover:bg-green-800 transition {{ request()->routeIs('admin.kelola-guru') ? 'bg-green-800' : '' }}">
                        <span class="mr-3">👨‍🏫</span> Kelola Guru
                    </a>
                    <a href="{{ route('admin.laporan') }}" class="flex items-center py-3 px-4 hover:bg-green-800 transition {{ request()->routeIs('admin.laporan') ? 'bg-green-800' : '' }}">
                        <span class="mr-3">📄</span> Laporan
                    </a>
                @elseif(auth()->user()->role == 'guru')
                    <a href="{{ route('guru.dashboard') }}" class="flex items-center py-3 px-4 hover:bg-green-800 transition {{ request()->routeIs('guru.dashboard') ? 'bg-green-800' : '' }}">
                        <span class="mr-3">📊</span> Dashboard
                    </a>
                    <a href="{{ route('guru.kelola-siswa') }}" class="flex items-center py-3 px-4 hover:bg-green-800 transition {{ request()->routeIs('guru.kelola-siswa') ? 'bg-green-800' : '' }}">
                        <span class="mr-3">👨‍🎓</span> Kelola Siswa
                    </a>
                    <a href="{{ route('guru.laporan-siswa') }}" class="flex items-center py-3 px-4 hover:bg-green-800 transition {{ request()->routeIs('guru.laporan-siswa') ? 'bg-green-800' : '' }}">
                        <span class="mr-3">📊</span> Laporan Siswa
                    </a>
                @else
                    <a href="{{ route('siswa.dashboard') }}" class="flex items-center py-3 px-4 hover:bg-green-800 transition {{ request()->routeIs('siswa.dashboard') ? 'bg-green-800' : '' }}">
                        <span class="mr-3">🏠</span> Dashboard
                    </a>
                    <a href="{{ route('siswa.tes') }}" class="flex items-center py-3 px-4 hover:bg-green-800 transition {{ request()->routeIs('siswa.tes') ? 'bg-green-800' : '' }}">
                        <span class="mr-3">📝</span> Mulai Tes
                    </a>
                    <a href="{{ route('siswa.hasil') }}" class="flex items-center py-3 px-4 hover:bg-green-800 transition {{ request()->routeIs('siswa.hasil') ? 'bg-green-800' : '' }}">
                        <span class="mr-3">📊</span> Hasil Tes
                    </a>
                @endif
            </nav>
            <div class="absolute bottom-0 w-full border-t border-green-600 p-2">
                <!-- Tidak ada logout di sini -->
            </div>
        </div>

        <!-- Overlay -->
        <div id="overlay" class="overlay"></div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Navbar -->
            <div class="navbar">
                <div class="flex justify-between items-center">
                    <h1 class="text-base md:text-xl font-semibold text-gray-800 truncate">@yield('header')</h1>
                    <div class="relative">
                        <button onclick="toggleDropdown()" class="flex items-center space-x-2 focus:outline-none">
                            <div class="text-right hidden sm:block">
                                <p class="text-xs md:text-sm font-semibold truncate max-w-[150px]">{{ auth()->user()->nama_lengkap }}</p>
                                <p class="text-xs text-gray-500 capitalize">{{ auth()->user()->role }}</p>
                            </div>
                            <div class="w-8 h-8 md:w-10 md:h-10 bg-gradient-to-r from-green-500 to-green-700 rounded-full flex items-center justify-center text-white font-bold shadow-md">
                                {{ strtoupper(substr(auth()->user()->nama_lengkap, 0, 1)) }}
                            </div>
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="dropdownMenu" class="dropdown-menu">
                            <div class="py-2">
                                <div class="px-4 py-2 border-b">
                                    <p class="text-sm font-semibold">{{ auth()->user()->nama_lengkap }}</p>
                                    <p class="text-xs text-gray-500">{{ auth()->user()->username }}</p>
                                </div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 transition flex items-center space-x-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content-area">
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 rounded mb-4 text-sm">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 rounded mb-4 text-sm">{{ session('error') }}</div>
                @endif
                @if($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 rounded mb-4 text-sm">
                        <ul class="list-disc list-inside">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>

    <script>
        function toggleDropdown() {
            document.getElementById('dropdownMenu').classList.toggle('show');
        }
        window.onclick = function(e) {
            if (!e.target.closest('.relative')) {
                document.getElementById('dropdownMenu')?.classList.remove('show');
            }
        }
        // Mobile sidebar toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('show');
                document.body.classList.toggle('overflow-hidden');
            });
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('open');
                overlay.classList.remove('show');
                document.body.classList.remove('overflow-hidden');
            });
        }
        // Auto close sidebar on window resize above 768px
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('open');
                overlay.classList.remove('show');
                document.body.classList.remove('overflow-hidden');
            }
        });
    </script>
    @endauth

    @guest
        @yield('content')
    @endguest

    @stack('scripts')
</body>
</html>