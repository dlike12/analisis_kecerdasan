<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    
    @stack('styles')
</head>
<body class="bg-gray-100">
    @auth
    <div class="flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-logo-container">
                <img src="{{ asset('images/logo_sekolah.png') }}" 
                     alt="Logo Sekolah" 
                     class="sidebar-logo"
                     onerror="this.src='https://via.placeholder.io/100x100?text=LOGO'">
                <h2 class="sidebar-title">Analisis Kecerdasan</h2>
                <p class="sidebar-subtitle">Multiple Intelligences</p>
            </div>
            
            <nav class="sidebar-nav">
                @if(auth()->user()->role == 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <span>📊</span> Dashboard
                    </a>
                    <a href="{{ route('admin.kelola-guru') }}" class="{{ request()->routeIs('admin.kelola-guru') ? 'active' : '' }}">
                        <span>👨‍🏫</span> Kelola Guru
                    </a>
                    <a href="{{ route('admin.laporan') }}" class="{{ request()->routeIs('admin.laporan') ? 'active' : '' }}">
                        <span>📄</span> Laporan
                    </a>
                @elseif(auth()->user()->role == 'guru')
                    <a href="{{ route('guru.dashboard') }}" class="{{ request()->routeIs('guru.dashboard') ? 'active' : '' }}">
                        <span>📊</span> Dashboard
                    </a>
                    <a href="{{ route('guru.kelola-siswa') }}" class="{{ request()->routeIs('guru.kelola-siswa') ? 'active' : '' }}">
                        <span>👨‍🎓</span> Kelola Siswa
                    </a>
                    <a href="{{ route('guru.laporan-siswa') }}" class="{{ request()->routeIs('guru.laporan-siswa') ? 'active' : '' }}">
                        <span>📊</span> Laporan Siswa
                    </a>
                @else
                    <a href="{{ route('siswa.dashboard') }}" class="{{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
                        <span>🏠</span> Dashboard
                    </a>
                    <a href="{{ route('siswa.tes') }}" class="{{ request()->routeIs('siswa.tes') ? 'active' : '' }}">
                        <span>📝</span> Mulai Tes
                    </a>
                    <a href="{{ route('siswa.hasil') }}" class="{{ request()->routeIs('siswa.hasil') ? 'active' : '' }}">
                        <span>📊</span> Hasil Tes
                    </a>
                @endif
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Navbar -->
            <div class="navbar">
                <div class="flex justify-between items-center">
                    <h1 class="text-xl font-semibold text-gray-800">@yield('header')</h1>
                    <div class="relative">
                        <button onclick="toggleDropdown()" class="flex items-center space-x-3 focus:outline-none">
                            <div class="text-right">
                                <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->nama_lengkap }}</p>
                                <p class="text-xs text-gray-500 capitalize">{{ auth()->user()->role }}</p>
                            </div>
                            <div class="profile-avatar" style="background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);">
                                {{ strtoupper(substr(auth()->user()->nama_lengkap, 0, 1)) }}
                            </div>
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div id="dropdownMenu" class="dropdown-menu">
                            <div class="py-2">
                                <div class="px-4 py-2 border-b">
                                    <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->nama_lengkap }}</p>
                                    <p class="text-xs text-gray-500">{{ auth()->user()->username }}</p>
                                    <p class="text-xs text-gray-500 capitalize">{{ auth()->user()->role }}</p>
                                </div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="logout-btn w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 transition flex items-center space-x-2">
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
            <div class="content-area fade-in">
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded mb-4">
                        <div class="flex items-center">
                            <span class="mr-2">✅</span>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded mb-4">
                        <div class="flex items-center">
                            <span class="mr-2">❌</span>
                            {{ session('error') }}
                        </div>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </div>
    </div>
    
    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdownMenu');
            dropdown.classList.toggle('show');
        }
        
        // Tutup dropdown saat klik di luar
        window.onclick = function(event) {
            if (!event.target.matches('button') && !event.target.closest('button')) {
                const dropdowns = document.getElementsByClassName('dropdown-menu');
                for (let i = 0; i < dropdowns.length; i++) {
                    if (dropdowns[i].classList.contains('show')) {
                        dropdowns[i].classList.remove('show');
                    }
                }
            }
        }
    </script>
    @endauth
    
    @guest
        @yield('content')
    @endguest
    
    @stack('scripts')
</body>
</html>
