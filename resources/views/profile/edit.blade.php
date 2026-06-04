<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profil Saya — {{ config('app.name', 'EventVendor') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }

        .profile-bg {
            min-height: 100vh;
            background: linear-gradient(135deg, #F8F6F0 0%, #FDFAF4 50%, #F3F0E8 100%);
            position: relative;
        }
        .profile-bg::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                radial-gradient(ellipse 80% 50% at 20% 20%, rgba(184,134,11,0.07) 0%, transparent 60%),
                radial-gradient(ellipse 60% 40% at 80% 80%, rgba(184,134,11,0.05) 0%, transparent 55%);
            pointer-events: none;
            z-index: 0;
        }

        /* Topbar */
        .profile-topbar {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(184,134,11,0.15);
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        }

        /* Card */
        .profile-card {
            background: #ffffff;
            border: 1px solid rgba(184,134,11,0.15);
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05), 0 1px 0 rgba(184,134,11,0.08) inset;
        }

        /* Section title */
        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: #1a1a2e;
            font-family: 'Playfair Display', serif;
        }
        .section-desc { font-size: 13px; color: #7a7a9a; margin-top: 4px; }

        /* Input */
        .p-input {
            background: #F8F6F0 !important;
            border: 1px solid rgba(184,134,11,0.2) !important;
            border-radius: 10px !important;
            color: #1a1a2e !important;
            padding: 11px 15px !important;
            width: 100%;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .p-input::placeholder { color: #9a9ab0; }
        .p-input:focus {
            outline: none !important;
            border-color: #B8860B !important;
            box-shadow: 0 0 0 3px rgba(184,134,11,0.1) !important;
            background: #ffffff !important;
        }

        /* Label */
        .p-label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: #B8860B;
            margin-bottom: 6px;
            letter-spacing: 0.6px;
            text-transform: uppercase;
        }

        /* Button primary */
        .p-btn {
            padding: 10px 28px;
            background: linear-gradient(135deg, #B8860B, #D4A017);
            color: #ffffff;
            font-weight: 700;
            font-size: 14px;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 16px rgba(184,134,11,0.25);
        }
        .p-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(184,134,11,0.35); }

        /* Button danger */
        .p-btn-danger {
            padding: 10px 24px;
            background: transparent;
            border: 1px solid rgba(220,38,38,0.35);
            color: #dc2626;
            font-weight: 600;
            font-size: 14px;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .p-btn-danger:hover { background: rgba(220,38,38,0.08); border-color: #dc2626; }

        /* Divider */
        .p-divider { border: none; border-top: 1px solid rgba(184,134,11,0.12); margin: 28px 0; }

        /* Error */
        .p-error { color: #dc2626; font-size: 12px; margin-top: 4px; }

        /* Modal overlay */
        .modal-overlay {
            position: fixed; inset: 0; z-index: 200;
            background: rgba(0,0,0,0.4);
            backdrop-filter: blur(4px);
            display: flex; align-items: center; justify-content: center;
            padding: 16px;
        }
        .modal-box {
            background: #ffffff;
            border: 1px solid rgba(184,134,11,0.2);
            border-radius: 20px;
            padding: 32px;
            width: 100%; max-width: 440px;
            box-shadow: 0 32px 64px rgba(0,0,0,0.15);
        }
        .p-btn-secondary {
            padding: 10px 24px;
            background: transparent;
            border: 1px solid rgba(184,134,11,0.25);
            color: #B8860B;
            font-weight: 600;
            font-size: 14px;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .p-btn-secondary:hover { background: rgba(184,134,11,0.08); }
    </style>
</head>
<body>
<div class="profile-bg">

    <!-- Topbar -->
    <div class="profile-topbar px-4 py-3">
        <div class="max-w-3xl mx-auto flex items-center justify-between">
            <a href="/" class="inline-flex items-center gap-2 group">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center shadow group-hover:scale-105 transition-transform" style="background: #fff; border: 1px solid rgba(184,134,11,0.2);">
                    <x-application-logo class="w-6 h-6" />
                </div>
                <span class="text-lg font-bold" style="font-family:'Playfair Display',serif; color:#1a1a2e;">EventVendor</span>
            </a>
            <div class="flex items-center gap-3">
                <span class="text-sm" style="color:#4a4a6a;">{{ Auth::user()->name }}</span>
                <a href="/" class="text-xs px-4 py-2 rounded-full border transition-colors"
                   style="border-color:rgba(184,134,11,0.25);color:#B8860B;"
                   onmouseover="this.style.background='rgba(184,134,11,0.08)'"
                   onmouseout="this.style.background='transparent'">
                    ← Beranda
                </a>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="relative z-10 max-w-3xl mx-auto px-4 py-10 space-y-6">

        <!-- Page Title -->
        <div class="mb-2">
            <h1 class="text-3xl font-bold" style="font-family:'Playfair Display',serif; color:#1a1a2e;">Profil Saya</h1>
            <p class="text-sm mt-1" style="color:#7a7a9a;">Kelola informasi akun dan keamanan Anda.</p>
        </div>

        <!-- Card 1: Informasi Profil -->
        <div class="profile-card p-8">
            @include('profile.partials.update-profile-information-form')
        </div>

        <!-- Card 2: Ubah Password -->
        <div class="profile-card p-8">
            @include('profile.partials.update-password-form')
        </div>

        <!-- Card 3: Hapus Akun -->
        <div class="profile-card p-8" style="border-color: rgba(220,38,38,0.2);">
            @include('profile.partials.delete-user-form')
        </div>

    </div>
</div>

<!-- SweetAlert Script -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Success notification for password update
        @if (session('status') === 'password-updated')
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Password Anda telah berhasil diubah.',
                confirmButtonColor: '#B8860B'
            });
        @endif

        // Success notification for profile info update
        @if (session('status') === 'profile-updated')
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Informasi profil Anda telah diperbarui.',
                confirmButtonColor: '#B8860B'
            });
        @endif

        // Error notification if validation fails in any form
        @if ($errors->any() || $errors->updatePassword->any() || $errors->userDeletion->any())
            Swal.fire({
                icon: 'error',
                title: 'Gagal Menyimpan',
                html: '<ul style="text-align: left; list-style-type: disc; margin-left: 20px;">' +
                      @foreach ($errors->all() as $error)
                          '<li>{{ $error }}</li>' +
                      @endforeach
                      @foreach ($errors->updatePassword->all() as $error)
                          '<li>{{ $error }}</li>' +
                      @endforeach
                      @foreach ($errors->userDeletion->all() as $error)
                          '<li>{{ $error }}</li>' +
                      @endforeach
                      '</ul>',
                confirmButtonColor: '#B8860B'
            });
        @endif
    });
</script>
</body>
</html>
