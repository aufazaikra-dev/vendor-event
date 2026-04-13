<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title') &mdash; Vendor System</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css">

  <style>
    /* Simulasi CSS Stisla Sederhana biar rapi */
    body { background-color: #f4f6f9; font-family: 'Nunito', sans-serif; }
    .main-sidebar { position: fixed; top: 0; width: 250px; height: 100%; background-color: #fff; z-index: 880; box-shadow: 0 4px 8px rgba(0,0,0,0.03); }
    .main-content { padding-left: 280px; padding-right: 30px; padding-top: 80px; width: 100%; position: relative; }
    .navbar-bg { content: ' '; position: absolute; top: 0; left: 0; width: 100%; height: 115px; background-color: #6777ef; z-index: -1; }
    .navbar { left: 250px; right: 0; position: absolute; z-index: 890; background-color: transparent; }
    .sidebar-menu li a { display: block; height: 50px; line-height: 50px; padding: 0 20px; color: #868e96; text-decoration: none; }
    .sidebar-menu li.active a { color: #6777ef; font-weight: 600; background-color: #fcfcfd; }
    .sidebar-brand { height: 60px; line-height: 60px; text-align: center; font-size: 20px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; }
    .sidebar-brand a { text-decoration: none; color: #000; }
  </style>
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>

      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            {{-- <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars text-white"></i></a></li> --}}
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user text-white">
              <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Menu</div>
              <a href="{{ route('profile.edit') }}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <div class="dropdown-divider"></div>

              <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="#" class="dropdown-item has-icon text-danger"
                       onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
              </form>
            </div>
          </li>
        </ul>
      </nav>

      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="#">EventVendor</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">HomePage</li>
            <li>
                <a class="nav-link text-primary font-weight-bold" href="{{ route('home') }}" target="_blank">
                    <i class="fas fa-globe"></i> <span>Lihat</span>
                </a>
            </li>

            <li class="menu-header">Menu Utama</li>

                @if(auth()->user()->role === 'admin')
                    {{-- <li class="menu-header">Menu Admin</li> --}}
                    <li>
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-fire"></i> <span>Dashboard Admin</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('admin.vendors') }}">
                            <i class="fas fa-store"></i> <span>Kelola Vendor</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('admin.users') }}">
                            <i class="fas fa-users"></i> <span>Data Pelanggan</span>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->role == 'vendor')
                {{-- <li class="menu-header px-3 mt-3 text-muted small">MENU VENDOR</li> --}}
                <li class="{{ Request::is('vendor/dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="/vendor/dashboard"><i class="fas fa-rocket"></i> <span>Dashboard</span></a>
                </li>
                <li class="{{ Request::is('vendor/profil') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('vendor.profile') }}">
                        <i class="fas fa-store"></i> <span>Profil Bisnis</span>
                    </a>
                </li>
                <li class="{{ Request::is('vendor/paket*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('paket.index') }}">
                        <i class="fas fa-box"></i> <span>Paket Harga</span>
                    </a>
                </li>
                <li class="{{ Request::is('vendor/portofolio*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('portofolio.index') }}">
                        <i class="fas fa-images"></i> <span>Portofolio</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('vendor.transactions') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('vendor.transactions') }}">
                        <i class="fas fa-shopping-cart"></i> <span>Kelola Pesanan</span>
                    </a>
                </li>
                @endif

          </ul>
        </aside>
      </div>

      <div class="main-content">
        <section class="section">
          <div class="section-header mb-4">
            <h1>@yield('title')</h1>
          </div>

          <div class="section-body">
             @yield('content')
          </div>
        </section>
      </div>

      <footer class="main-footer text-center mt-5 pb-3 text-muted">
        <div class="footer-left">
          Copyright &copy; 2026 <div class="bullet"></div> EventVendor.
        </div>
      </footer>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="sidebar"]').on('click', function(e) {
                e.preventDefault();
                var body = $('body');
                var w = $(window);

                if (w.outerWidth() <= 1024) {
                    // Logika Layar HP/Tablet
                    if (body.hasClass('sidebar-gone')) {
                        body.removeClass('sidebar-gone');
                        body.addClass('sidebar-show');
                    } else {
                        body.addClass('sidebar-gone');
                        body.removeClass('sidebar-show');
                    }
                } else {
                    // Logika Layar Laptop/PC
                    if (body.hasClass('sidebar-mini')) {
                        body.removeClass('sidebar-mini');
                    } else {
                        body.addClass('sidebar-mini');
                    }
                }
            });
        });
    </script>
</body>
</html>
