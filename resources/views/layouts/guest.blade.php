<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'EventVendor') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }

        /* Background terang mewah */
        .auth-bg {
            min-height: 100vh;
            background: linear-gradient(135deg, #F8F6F0 0%, #FDFAF4 50%, #F3F0E8 100%);
            position: relative;
            overflow: hidden;
        }

        /* Orbs emas lembut */
        .auth-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(ellipse 80% 50% at 20% 20%, rgba(184,134,11,0.08) 0%, transparent 60%),
                radial-gradient(ellipse 60% 40% at 80% 80%, rgba(184,134,11,0.06) 0%, transparent 55%);
            pointer-events: none;
        }

        /* Grid pattern halus */
        .auth-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: linear-gradient(rgba(184,134,11,0.03) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(184,134,11,0.03) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
        }

        /* Card putih bersih */
        .auth-card {
            background: #ffffff;
            border: 1px solid rgba(184,134,11,0.15);
            border-radius: 24px;
            box-shadow:
                0 20px 60px rgba(0,0,0,0.07),
                0 0 0 1px rgba(184,134,11,0.05) inset;
        }

        /* Input bersih */
        .auth-input {
            background: #F8F6F0 !important;
            border: 1px solid rgba(184,134,11,0.2) !important;
            border-radius: 10px !important;
            color: #1a1a2e !important;
            padding: 12px 16px !important;
            width: 100%;
            transition: border-color 0.2s, box-shadow 0.2s;
            font-size: 15px;
        }
        .auth-input::placeholder { color: #9a9ab0; }
        .auth-input:focus {
            outline: none !important;
            border-color: #B8860B !important;
            box-shadow: 0 0 0 3px rgba(184,134,11,0.12) !important;
            background: #ffffff !important;
        }

        /* Label */
        .auth-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #4a4a6a;
            margin-bottom: 6px;
            letter-spacing: 0.3px;
        }

        /* Button utama emas */
        .auth-btn-primary {
            width: 100%;
            padding: 13px 24px;
            background: linear-gradient(135deg, #B8860B, #D4A017);
            color: #ffffff;
            font-weight: 700;
            font-size: 15px;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(184,134,11,0.25);
            letter-spacing: 0.3px;
        }
        .auth-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(184,134,11,0.35);
            background: linear-gradient(135deg, #C9960E, #E5B01A);
        }

        /* Button secondary */
        .auth-btn-secondary {
            color: #B8860B;
            font-size: 15px;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s;
        }
        .auth-btn-secondary:hover { color: #8B6508; text-decoration: underline; }

        /* Divider */
        .auth-divider {
            border: none;
            border-top: 1px solid rgba(184,134,11,0.12);
            margin: 24px 0;
        }

        /* Floating orbs */
        @keyframes float1 {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-30px) scale(1.05); }
        }
        @keyframes float2 {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(20px) scale(0.95); }
        }
        .orb1 {
            position: absolute; width: 400px; height: 400px; border-radius: 50%;
            background: radial-gradient(circle, rgba(184,134,11,0.08) 0%, transparent 70%);
            top: -100px; right: -100px; animation: float1 8s ease-in-out infinite;
            pointer-events: none;
        }
        .orb2 {
            position: absolute; width: 300px; height: 300px; border-radius: 50%;
            background: radial-gradient(circle, rgba(184,134,11,0.06) 0%, transparent 70%);
            bottom: -80px; left: -80px; animation: float2 10s ease-in-out infinite;
            pointer-events: none;
        }

        /* Error message */
        .auth-error { color: #dc2626; font-size: 12px; margin-top: 4px; }

        /* Checkbox */
        .auth-checkbox {
            width: 16px; height: 16px;
            accent-color: #B8860B;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Select dropdown */
        .auth-select {
            background: #F8F6F0 !important;
            border: 1px solid rgba(184,134,11,0.2) !important;
            border-radius: 10px !important;
            color: #1a1a2e !important;
            padding: 12px 16px !important;
            width: 100%;
            transition: border-color 0.2s;
            font-size: 15px;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23B8860B' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-position: right 14px center !important;
            background-size: 16px !important;
        }
        .auth-select option { background: #fff; color: #1a1a2e; }
        .auth-select:focus {
            outline: none;
            border-color: #B8860B !important;
            box-shadow: 0 0 0 3px rgba(184,134,11,0.12) !important;
        }
    </style>
</head>
<body>
    <div class="auth-bg flex items-center justify-center min-h-screen px-4 py-12 relative">
        <!-- Floating Orbs -->
        <div class="orb1"></div>
        <div class="orb2"></div>

        <div class="relative z-10 w-full max-w-md">
            <!-- Logo -->
            <div class="text-center mb-8">
                <a href="/" class="inline-flex items-center gap-2 group">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform" style="background: #ffffff; border: 1px solid rgba(184,134,11,0.2);">
                        <x-application-logo class="w-8 h-8" />
                    </div>
                    <span class="text-2xl font-bold" style="font-family: 'Playfair Display', serif; color: #1a1a2e;">EventVendor</span>
                </a>
                <p class="text-sm mt-2" style="color: #B8860B;">Platform Vendor Acara Terpercaya Banda Aceh</p>
            </div>

            <!-- Card -->
            <div class="auth-card px-8 py-10">
                {{ $slot }}
            </div>

            <!-- Back to home -->
            <div class="text-center mt-6">
                <a href="/" class="auth-btn-secondary text-xs">
                    ← Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{!! session('success') !!}',
                    confirmButtonColor: '#B8860B'
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{!! session('error') !!}',
                    confirmButtonColor: '#dc2626'
                });
            @endif
            
            @if(session('status'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{!! session('status') !!}',
                    confirmButtonColor: '#B8860B'
                });
            @endif
        });
    </script>
</body>
</html>
