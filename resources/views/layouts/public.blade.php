<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- DITAMBAHKAN - Konfigurasi title yang lebih SEO-friendly -->
    <title>{{ config('app.name', 'Direktori Vendor Acara Banda Aceh') }}</title>

    <!-- DITAMBAHKAN - Import Google Fonts premium sesuai konfigurasi Tailwind -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts - Memanggil Vite untuk Tailwind CSS dan Alpine.js -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<!-- DITAMBAHKAN - Class font-sans (Inter) dan warna teks charcoal dari tailwind.config.js -->
<body class="font-sans text-charcoal antialiased bg-champagne-light">

    <!-- DITAMBAHKAN - Placeholder untuk Navbar Publik di masa depan -->
    {{-- @include('layouts.public_navigation') --}}

    <!-- Main Content Area -->
    <main class="min-h-screen">
        {{ $slot }}
    </main>

    <!-- DITAMBAHKAN - Placeholder untuk Footer -->
    {{-- @include('layouts.public_footer') --}}

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
