<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Analisis Kecerdasan Jamak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="login-card p-8 transform transition-all hover:scale-105 duration-300">
        <div class="text-center mb-8">
            <!-- Logo Sekolah -->
            <div class="logo-container">
                <img src="{{ asset('images/logo_sekolah.png') }}" 
                     alt="Logo Sekolah" 
                     onerror="this.src='https://via.placeholder.com/112x112?text=SEKOLAH'">
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Analisis Kecerdasan Jamak</h2>
            <p class="text-gray-500 text-sm mt-2">Multiple Intelligences Test</p>
            <p class="text-xs text-gray-400 mt-1">SMP - K-Means Clustering</p>
        </div>

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-5">
                <label class="form-label">Username / NIK / NIP</label>
                <div class="input-group">
                    <span class="input-icon">👤</span>
                    <input type="text" name="username" value="{{ old('username') }}" required
                        class="input-field"
                        placeholder="Masukkan username, NIK, atau NIP">
                </div>
                @error('username')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-icon">🔒</span>
                    <input type="password" name="password" required
                        class="input-field"
                        placeholder="Masukkan password">
                </div>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn-login w-full text-white font-semibold py-3 px-4 rounded-xl transition duration-300 text-sm">
                Login
            </button>
        </form>

        <div class="demo-account">
            <p class="demo-title">AKUN DEMO</p>
            <p class="demo-text">
                Admin: admin / admin123<br>
                Guru: guru001 / guru123
            </p>
        </div>
        
        <div class="copyright">
            <p>© 2026 - Sistem Analisis Kecerdasan Jamak</p>
        </div>
    </div>
</body>
</html>
