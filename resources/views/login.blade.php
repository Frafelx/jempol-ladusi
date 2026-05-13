<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — JEMPOL LADUSI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            background: #0c1a2e;
            overflow: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* PANEL KIRI */
        .left-panel {
            flex: 1.2;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            padding: 80px;
            overflow: hidden;
            background-image: url('{{ asset('img/bg-rutan.jpeg') }}');
            background-size: cover;
            background-position: center;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg,
                    rgba(12, 26, 46, 0.95) 0%,
                    rgba(18, 35, 64, 0.92) 50%,
                    rgba(10, 22, 40, 0.98) 100%);
        }

        .left-panel::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 32px 32px;
        }

        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.12;
            animation: floatBlob 10s ease-in-out infinite;
        }

        .blob-1 { width: 400px; height: 400px; background: #6366f1; top: -100px; right: -50px; animation-delay: 0s; }
        .blob-2 { width: 300px; height: 300px; background: #d4af37; bottom: 50px; left: -50px; animation-delay: 3s; }
        .blob-3 { width: 250px; height: 250px; background: #38bdf8; bottom: -80px; right: 150px; animation-delay: 5s; }

        @keyframes floatBlob {
            0%, 100% { transform: translateY(0px) scale(1); }
            50% { transform: translateY(-30px) scale(1.05); }
        }

        /* PANEL KANAN */
        .right-panel {
            width: 440px;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px 48px;
            position: relative;
            z-index: 10;
            box-shadow: -20px 0 50px rgba(0,0,0,0.2);
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-label {
            display: block;
            font-size: 11.5px;
            font-weight: 700;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 8px;
            margin-left: 4px;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            transition: color 0.3s;
            pointer-events: none;
        }

        .input-field {
            width: 100%;
            padding: 13px 40px 13px 44px;
            background: #f9fafb;
            border: 1.5px solid #f3f4f6;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 500;
            color: #111827;
            outline: none;
            transition: all 0.25s ease;
        }

        .input-field::placeholder {
            color: #9ca3af;
            font-weight: 400;
        }

        .input-group:focus-within .input-icon {
            color: #6366f1;
        }

        .input-field:focus {
            background: #ffffff;
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.12);
        }

        .input-field.is-error {
            border-color: #ef4444;
            background: #fef2f2;
        }

        .input-field.is-error:focus {
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.12);
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            margin-top: 10px;
            background: linear-gradient(135deg, #122340 0%, #1e3a6e 100%);
            color: #ffffff;
            font-size: 14.5px;
            font-weight: 700;
            border-radius: 14px;
            border: none;
            cursor: pointer;
            letter-spacing: 0.03em;
            transition: all 0.2s ease;
            box-shadow: 0 8px 20px rgba(18, 35, 64, 0.25);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(18, 35, 64, 0.35);
        }

        .btn-login:active {
            transform: translateY(1px);
        }

        /* ANIMASI */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideRight {
            from { opacity: 0; transform: translateX(-40px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .anim-panel { animation: slideRight 0.8s cubic-bezier(0.16, 1, 0.3, 1) both; }
        .anim-card { animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.1s both; }
        .anim-f1 { animation: fadeUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) 0.2s both; }
        .anim-f2 { animation: fadeUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) 0.3s both; }
        .anim-f3 { animation: fadeUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) 0.4s both; }
        .anim-f4 { animation: fadeUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) 0.5s both; }

        .accent-bar {
            width: 48px;
            height: 4px;
            background: linear-gradient(90deg, #d4af37, #f0cc5a);
            border-radius: 4px;
            margin-top: 16px;
        }

        .stat-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            padding: 10px 18px;
            color: rgba(255, 255, 255, 0.9);
            font-size: 12.5px;
            font-weight: 600;
            backdrop-filter: blur(12px);
            transition: background 0.3s;
        }
        
        .stat-chip:hover {
            background: rgba(255, 255, 255, 0.12);
        }

        .stat-chip .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #4ade80;
            box-shadow: 0 0 8px rgba(74, 222, 128, 0.6);
        }

        @media (max-width: 800px) {
            .left-panel { display: none; }
            .right-panel { width: 100%; padding: 40px 30px; }
        }
    </style>
</head>

<body>

    {{-- ═══════════ KIRI ═══════════ --}}
    <div class="left-panel anim-panel will-change-transform">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>

        <div class="relative z-10 max-w-xl">
            
            <div class="flex items-center gap-5 mb-12">
                <!-- Ukuran kotak diubah menjadi w-20 h-20, padding dihapus, dan menggunakan object-cover -->
                <div class="w-20 h-20 rounded-xl flex items-center justify-center bg-white/10 border border-white/20 backdrop-blur-md overflow-hidden shadow-lg">
                    <img src="{{ asset('img/jempol-ladusi.png') }}" alt="Logo Jempol" class="w-full h-full object-cover">
                </div>
                <div>
                    <p class="text-white font-black text-[28px] tracking-wide leading-none">JEMPOL LADUSI</p>
                    <p class="text-white/60 text-[15px] font-semibold mt-1 tracking-wider">RUTAN KELAS IIB REMBANG</p>
                </div>
            </div>

            <h1 class="text-white font-black leading-tight mb-6" style="font-size: clamp(32px, 4vw, 48px); letter-spacing: -0.02em;">
                <span style="background: linear-gradient(90deg, #d4af37, #f0cc5a); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                    Jemput Bola Layanan Pengaduan, Survei Kepuasan & Informasi
                </span>
            </h1>
            
            <p class="text-white/60 text-[15px] leading-relaxed mb-12 max-w-lg font-medium">
                Inovasi pelayanan proaktif untuk mendukung transparansi pengaduan dan mendorong partisipasi Masyarakat dalam survei kepuasan, sebagai bahan evaluasi peningkatan kualitas pelayanan institusi.
            </p>

            <div class="flex flex-wrap gap-4">
                <div class="stat-chip">
                    <div class="dot"></div>
                    Sistem Aktif
                </div>
                <div class="stat-chip">
                    <svg class="w-4 h-4 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    Akses Terlindungi
                </div>
                <div class="stat-chip">
                    <svg class="w-4 h-4 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h10" />
                    </svg>
                    4 Sumber Data Terpadu
                </div>
            </div>
        </div>

        <p class="absolute bottom-10 left-20 text-white/30 text-[12px] font-semibold z-10 tracking-wider uppercase">
            &copy; {{ date('Y') }} RUTAN KELAS IIB REMBANG
        </p>
    </div>

    {{-- ═══════════ KANAN ═══════════ --}}
    <div class="right-panel">
        <div class="w-full max-w-[340px] anim-card">

            <div class="mb-10 text-center flex flex-col items-center">
                <!-- Logo Rutan tetap dipertahankan -->
                <div class="p-3 bg-white rounded-2xl shadow-sm border border-gray-100 mb-5">
                    <img src="{{ asset('img/Logo.png') }}" alt="Logo Rutan" class="w-[72px] h-[72px] object-contain">
                </div>
                <h2 class="text-[26px] font-black text-gray-900 tracking-tight leading-none">Masuk ke Sistem</h2>
                <div class="accent-bar"></div>
            </div>

            {{-- Error Alert --}}
            @if ($errors->any())
                <div class="anim-f1 flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 text-[13px] font-semibold rounded-xl px-4 py-3.5 mb-6 shadow-sm">
                    <svg class="w-4 h-4 shrink-0 mt-0.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                {{-- Username --}}
                <div class="anim-f1 input-group">
                    <label class="input-label">Username</label>
                    <div class="relative">
                        <div class="input-icon">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input type="text" name="email" value="{{ old('email') }}"
                            placeholder="Ketik username Anda"
                            class="input-field {{ $errors->has('email') ? 'is-error' : '' }}" autocomplete="username" autofocus>
                    </div>
                </div>

                {{-- Password --}}
                <div class="anim-f2 input-group">
                    <label class="input-label">Password</label>
                    <div class="relative">
                        <div class="input-icon">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password" name="password" id="passwordInput" placeholder="Ketik kata sandi"
                            class="input-field {{ $errors->has('password') ? 'is-error' : '' }}" autocomplete="current-password">
                        
                        <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-indigo-600 transition-colors p-1">
                            <svg id="eyeIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Remember --}}
                <div class="anim-f3 flex items-center gap-3 mb-6 mt-2 ml-1">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded border-gray-300 cursor-pointer accent-indigo-600 transition-all">
                    <label for="remember" class="text-[13px] text-gray-500 font-semibold cursor-pointer select-none">
                        Ingat sesi saya
                    </label>
                </div>

                {{-- Submit --}}
                <div class="anim-f4">
                    <button type="submit" class="btn-login">
                        Masuk ke Dashboard
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('passwordInput');
            const icon = document.getElementById('eyeIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`;
            } else {
                input.type = 'password';
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
            }
        }
    </script>

</body>
</html>