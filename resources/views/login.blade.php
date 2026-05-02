<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — JEMPOL LADUSI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            background: #0c1a2e;
            overflow: hidden;
        }

        .left-panel {
            flex: 1;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            padding: 60px;
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
                    rgba(12, 26, 46, 0.93) 0%,
                    rgba(18, 35, 64, 0.90) 50%,
                    rgba(10, 22, 40, 0.95) 100%);
        }

        .left-panel::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.06) 1px, transparent 1px);
            background-size: 32px 32px;
        }

        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.15;
            animation: floatBlob 8s ease-in-out infinite;
        }

        .blob-1 {
            width: 320px;
            height: 320px;
            background: #6366f1;
            top: -80px;
            right: -60px;
            animation-delay: 0s;
        }

        .blob-2 {
            width: 200px;
            height: 200px;
            background: #d4af37;
            bottom: 60px;
            left: 40px;
            animation-delay: 3s;
        }

        .blob-3 {
            width: 160px;
            height: 160px;
            background: #38bdf8;
            bottom: -40px;
            right: 100px;
            animation-delay: 5s;
        }

        @keyframes floatBlob {

            0%,
            100% {
                transform: translateY(0px) scale(1);
            }

            50% {
                transform: translateY(-20px) scale(1.05);
            }
        }

        .right-panel {
            width: 460px;
            background: #f5f6fa;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 48px 44px;
            position: relative;
            z-index: 10;
        }

        .right-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(160deg, rgba(99, 102, 241, 0.04) 0%, transparent 40%);
            pointer-events: none;
        }

        .input-field {
            width: 100%;
            padding: 11px 44px 11px 40px;
            background: #fff;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            font-size: 13.5px;
            font-weight: 500;
            color: #111827;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .input-field:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.10);
        }

        .input-field.is-error {
            border-color: #ef4444;
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.08);
        }

        .btn-login {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #122340 0%, #1e3a6e 100%);
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            letter-spacing: 0.02em;
            transition: transform 0.15s, box-shadow 0.2s, opacity 0.2s;
            box-shadow: 0 4px 20px rgba(18, 35, 64, 0.35);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(18, 35, 64, 0.45);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideRight {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .anim-panel {
            animation: slideRight 0.7s cubic-bezier(.22, 1, .36, 1) both;
        }

        .anim-card {
            animation: fadeUp 0.5s cubic-bezier(.22, 1, .36, 1) 0.1s both;
        }

        .anim-f1 {
            animation: fadeUp 0.45s cubic-bezier(.22, 1, .36, 1) 0.20s both;
        }

        .anim-f2 {
            animation: fadeUp 0.45s cubic-bezier(.22, 1, .36, 1) 0.28s both;
        }

        .anim-f3 {
            animation: fadeUp 0.45s cubic-bezier(.22, 1, .36, 1) 0.34s both;
        }

        .anim-f4 {
            animation: fadeUp 0.45s cubic-bezier(.22, 1, .36, 1) 0.40s both;
        }

        .accent-bar {
            width: 40px;
            height: 4px;
            background: linear-gradient(90deg, #d4af37, #f0cc5a);
            border-radius: 99px;
            margin-top: 12px;
        }

        .stat-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 99px;
            padding: 8px 16px;
            color: rgba(255, 255, 255, 0.75);
            font-size: 12px;
            font-weight: 600;
            backdrop-filter: blur(8px);
        }

        .stat-chip .dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #4ade80;
            box-shadow: 0 0 6px #4ade80;
        }

        @media (max-width: 768px) {
            .left-panel {
                display: none;
            }

            .right-panel {
                width: 100%;
                padding: 40px 28px;
            }
        }
    </style>
</head>

<body>

    {{-- ═══════════ KIRI ═══════════ --}}
    <div class="left-panel anim-panel will-change-transform">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>

        <div class="relative z-10 max-w-lg">
            <div class="flex items-center gap-3 mb-10 ">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center"
                    style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.15);">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path></svg>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div>
                    <p class="text-white font-black text-[25px] tracking-wide leading-none">JEMPOL LADUSI</p>
                    <p class="text-white/40 text-[15px] font-medium mt-0.5">Rutan Kelas IIB Rembang</p>
                </div>
            </div>

            <h1 class="text-white font-black leading-tight mb-4"
                style="font-size: clamp(28px, 3.5vw, 44px); letter-spacing: -0.02em;">
                Sistem Layanan<br>
                <span
                    style="background: linear-gradient(90deg, #d4af37, #f0cc5a); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                    Terintegrasi
                </span>
            </h1>
            <p class="text-white/50 text-[14px] leading-relaxed mb-10 max-w-sm">
                Platform informasi pelayanan, pengaduan, dan survei kepuasan warga binaan pemasyarakatan.
            </p>

            <div class="flex flex-wrap gap-3">
                <div class="stat-chip">
                    <div class="dot"></div>
                    Sistem Aktif
                </div>
                <div class="stat-chip">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    Akses Terlindungi
                </div>
                <div class="stat-chip">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 10h16M4 14h10" />
                    </svg>
                    4 Sumber Data
                </div>
            </div>
        </div>

        <p class="absolute bottom-8 left-14 text-white/25 text-[11px] font-medium z-10">
            &copy; {{ date('Y') }} Rutan Kelas IIB Rembang
        </p>
    </div>

    {{-- ═══════════ KANAN ═══════════ --}}
    <div class="right-panel">
        <div class="w-full max-w-sm anim-card">

            <div class="mb-8 text-center flex flex-col items-center">
                <img src="{{ asset('img/Logo.png') }}" alt="Logo"
                    class="w-20 h-20 object-contain mb-4 drop-shadow-md">
                <h2 class="text-[25px] font-black text-gray-900 tracking-tight">Masuk ke Sistem</h2>
                <div class="accent-bar"></div>
                <p class="text-[15px] text-gray-400 mt-3 font-medium">Masukkan kredensial akun Anda untuk melanjutkan.
                </p>
            </div>

            {{-- Error --}}
            @if ($errors->any())
                <div
                    class="anim-f1 flex items-center gap-2.5 bg-red-50 border border-red-200 text-red-600 text-[12.5px] font-semibold rounded-xl px-4 py-3 mb-5">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="flex flex-col gap-4">
                @csrf

                {{-- Username --}}
                <div class="anim-f1">
                    <label
                        class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Username</label>
                    <div class="relative">
                        <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input type="text" name="email" value="{{ old('email') }}"
                            placeholder="Masukkan username..."
                            class="input-field {{ $errors->has('email') ? 'is-error' : '' }}" autocomplete="username"
                            autofocus>
                    </div>
                </div>

                {{-- Password --}}
                <div class="anim-f2">
                    <label
                        class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password" name="password" id="passwordInput" placeholder="Masukkan password..."
                            class="input-field {{ $errors->has('password') ? 'is-error' : '' }}"
                            autocomplete="current-password">
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-300 hover:text-gray-600 transition-colors">
                            <svg id="eyeIcon" class="w-4 h-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Remember --}}
                <div class="anim-f3 flex items-center gap-2.5">
                    <input type="checkbox" name="remember" id="remember"
                        class="w-4 h-4 rounded border-gray-300 cursor-pointer accent-indigo-600">
                    <label for="remember" class="text-[12.5px] text-gray-500 font-medium cursor-pointer select-none">
                        Ingat saya
                    </label>
                </div>

                {{-- Submit --}}
                <div class="anim-f4 mt-1">
                    <button type="submit" class="btn-login">Masuk</button>
                </div>

            </form>

            <p class="text-center text-[11px] text-gray-400 mt-8 font-medium">
                &copy; {{ date('Y') }} Rutan Kelas IIB Rembang
            </p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('passwordInput');
            const icon = document.getElementById('eyeIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML =
                    `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`;
            } else {
                input.type = 'password';
                icon.innerHTML =
                    `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
            }
        }
    </script>

</body>

</html>
