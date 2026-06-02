<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Sebagai Vendor - EventVendor</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }

        .auth-bg {
            min-height: 100vh;
            background: linear-gradient(135deg, #F8F6F0 0%, #FDFAF4 50%, #F3F0E8 100%);
            position: relative;
            overflow: hidden;
        }
        .auth-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(ellipse 80% 50% at 20% 20%, rgba(184,134,11,0.08) 0%, transparent 60%),
                radial-gradient(ellipse 60% 40% at 80% 80%, rgba(184,134,11,0.06) 0%, transparent 55%);
            pointer-events: none;
        }
        .auth-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: linear-gradient(rgba(184,134,11,0.03) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(184,134,11,0.03) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
        }
        .auth-card {
            background: #ffffff;
            border: 1px solid rgba(184,134,11,0.15);
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.07), 0 0 0 1px rgba(184,134,11,0.05) inset;
        }
        .auth-input {
            background: #F8F6F0 !important;
            border: 1px solid rgba(184,134,11,0.2) !important;
            border-radius: 10px !important;
            color: #1a1a2e !important;
            padding: 12px 16px !important;
            width: 100%;
            transition: border-color 0.2s, box-shadow 0.2s;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
        }
        .auth-input::placeholder { color: #9a9ab0; }
        .auth-input:focus {
            outline: none !important;
            border-color: #B8860B !important;
            box-shadow: 0 0 0 3px rgba(184,134,11,0.12) !important;
            background: #ffffff !important;
        }
        .auth-label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #B8860B;
            margin-bottom: 6px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .auth-select {
            background: #F8F6F0 !important;
            border: 1px solid rgba(184,134,11,0.2) !important;
            border-radius: 10px !important;
            color: #1a1a2e !important;
            padding: 12px 16px !important;
            width: 100%;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
            appearance: none;
        }
        .auth-select option { background: #fff; color: #1a1a2e; }
        .auth-select:focus {
            outline: none;
            border-color: #B8860B !important;
            box-shadow: 0 0 0 3px rgba(184,134,11,0.12) !important;
        }
        .auth-select:disabled { opacity: 0.6; cursor: not-allowed; }
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
            font-family: 'Inter', sans-serif;
        }
        .auth-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(184,134,11,0.35);
        }
        .auth-divider {
            border: none;
            border-top: 1px solid rgba(184,134,11,0.12);
            margin: 24px 0;
        }
        .auth-error { color: #dc2626; font-size: 12px; margin-top: 4px; }
        .section-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #B8860B;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
        }
        .section-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(184,134,11,0.15);
        }
        @keyframes float1 {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-30px) scale(1.05); }
        }
        @keyframes float2 {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(20px) scale(0.95); }
        }
        .orb1 {
            position: fixed; width: 400px; height: 400px; border-radius: 50%;
            background: radial-gradient(circle, rgba(184,134,11,0.07) 0%, transparent 70%);
            top: -100px; right: -100px; animation: float1 8s ease-in-out infinite;
            pointer-events: none;
        }
        .orb2 {
            position: fixed; width: 300px; height: 300px; border-radius: 50%;
            background: radial-gradient(circle, rgba(184,134,11,0.05) 0%, transparent 70%);
            bottom: -80px; left: -80px; animation: float2 10s ease-in-out infinite;
            pointer-events: none;
        }
    </style>
</head>
<body>
<div class="auth-bg px-4 py-12">
    <div class="orb1"></div>
    <div class="orb2"></div>

    <div class="relative z-10 w-full max-w-lg mx-auto">

        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-2 group">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform" style="background: #ffffff; border: 1px solid rgba(184,134,11,0.2);">
                    <x-application-logo class="w-8 h-8" />
                </div>
                <span class="text-2xl font-bold" style="font-family: 'Playfair Display', serif; color: #1a1a2e;">EventVendor</span>
            </a>
        </div>

        <!-- Card -->
        <div class="auth-card px-8 py-10">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold mb-1" style="font-family: 'Playfair Display', serif; color: #1a1a2e;">Gabung Jadi Vendor</h1>
                <p class="text-sm" style="color: #7a7a9a;">Raih lebih banyak klien untuk bisnis Anda</p>
            </div>

            @if($errors->any())
                <div class="mb-5 p-4 rounded-xl text-sm" style="color:#dc2626; background:rgba(220,38,38,0.07); border:1px solid rgba(220,38,38,0.2);">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('vendor.register') }}" class="space-y-4">
                @csrf

                <!-- Info Akun -->
                <p class="section-label">Info Akun Login</p>

                <div>
                    <label class="auth-label">Nama Pemilik</label>
                    <input type="text" name="name" class="auth-input" placeholder="Nama lengkap Anda" value="{{ old('name') }}" required>
                </div>

                <div>
                    <label class="auth-label">Email Aktif</label>
                    <input type="email" name="email" class="auth-input" placeholder="nama@email.com" value="{{ old('email') }}" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="auth-label">Password</label>
                        <input type="password" name="password" class="auth-input" placeholder="Min. 8 karakter" required minlength="8">
                    </div>
                    <div>
                        <label class="auth-label">Ulangi Password</label>
                        <input type="password" name="password_confirmation" class="auth-input" placeholder="Ulangi" required>
                    </div>
                </div>

                <hr class="auth-divider">

                <!-- Info Bisnis -->
                <p class="section-label">Info Bisnis</p>

                <div>
                    <label class="auth-label">Nama Bisnis / Toko</label>
                    <input type="text" name="nama_bisnis" class="auth-input" placeholder="Nama usaha atau brand Anda" value="{{ old('nama_bisnis') }}" required>
                </div>

                <div>
                    <label class="auth-label">Kategori Jasa Utama</label>
                    <select name="category_id" class="auth-select" required>
                        <option value="">-- Pilih Kategori Jasa --</option>
                        @foreach(\App\Models\Category::all() as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="auth-label">Kota Operasional</label>
                    <select name="city_id" class="auth-select" disabled required>
                        <option value="1" selected>Banda Aceh</option>
                    </select>
                    <input type="hidden" name="city_id" value="1">
                    <p class="text-sm mt-1" style="color: #B8860B; opacity:0.7;">* Saat ini layanan hanya tersedia di Banda Aceh</p>
                </div>

                <div class="pt-2">
                    <button type="submit" class="auth-btn-primary">
                        Daftar Sebagai Vendor Sekarang
                    </button>
                </div>
            </form>

            <hr class="auth-divider">

            <div class="text-center">
                <p class="text-s" style="color: #4a4a6a;">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" style="color: #B8860B; font-weight: 600;">Masuk di sini</a>
                </p>
            </div>
        </div>

        <div class="text-center mt-6">
            <a href="/" class="text-s" style="color: #B8860B;">← Kembali ke Beranda</a>
        </div>

    </div>
</div>
</body>
</html>
