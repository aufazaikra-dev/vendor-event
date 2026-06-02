<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title', 'Admin') &mdash; EventVendor</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <!-- Summernote -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css">

  <style>
    :root {
      --gold: #B8860B;
      --gold-light: #D4A017;
      --gold-dim: rgba(184,134,11,0.15);
      --sidebar-w: 255px;
      --light-bg: #F8F6F1;
      --white: #FFFFFF;
      --sidebar-bg: #FFFFFF;
      --text-dark: #1a1a2e;
      --text-mid: #4a4a6a;
      --text-soft: #7a7a9a;
      --border: rgba(184,134,11,0.18);
    }

    *, *::before, *::after { box-sizing: border-box; }

    body {
      font-family: 'Inter', sans-serif;
      background: #F3F0E8;
      color: var(--text-dark);
      margin: 0;
      min-height: 100vh;
    }

    /* ── SIDEBAR ─────────────────────────────── */
    .adm-sidebar {
      position: fixed;
      top: 0; left: 0;
      width: var(--sidebar-w);
      height: 100vh;
      background: #FFFFFF;
      border-right: 1px solid rgba(184,134,11,0.15);
      box-shadow: 2px 0 20px rgba(0,0,0,0.06);
      z-index: 200;
      display: flex;
      flex-direction: column;
      overflow-y: auto;
      transition: transform 0.3s cubic-bezier(0.4,0,0.2,1);
    }

    /* Mobile: sidebar hidden by default */
    @media (max-width: 768px) {
      .adm-sidebar {
        transform: translateX(-100%);
        box-shadow: none;
      }
      .adm-sidebar.sidebar-open {
        transform: translateX(0);
        box-shadow: 4px 0 30px rgba(0,0,0,0.15);
      }
    }

    /* Overlay */
    .adm-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.35);
      z-index: 150;
      backdrop-filter: blur(2px);
    }
    .adm-overlay.active { display: block; }

    /* Hamburger button */
    .adm-hamburger {
      display: none;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      border-radius: 10px;
      border: 1px solid rgba(184,134,11,0.2);
      background: rgba(184,134,11,0.06);
      cursor: pointer;
      color: var(--gold);
      transition: background 0.2s;
      flex-shrink: 0;
    }
    .adm-hamburger:hover { background: rgba(184,134,11,0.12); }
    .adm-hamburger svg { width: 20px; height: 20px; }
    @media (max-width: 768px) {
      .adm-hamburger { display: flex; }
    }

    .adm-brand {
      padding: 20px 20px 16px;
      border-bottom: 1px solid rgba(184,134,11,0.12);
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
    }
    .adm-brand-icon {
      width: 38px; height: 38px;
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }
    .adm-brand-text {
      font-family: 'Playfair Display', serif;
      font-size: 18px;
      font-weight: 700;
      color: var(--text-dark);
      letter-spacing: 0.3px;
    }
    .adm-brand-badge {
      font-size: 9px;
      font-weight: 700;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      color: var(--gold);
      margin-top: 1px;
    }

    .adm-nav-section {
      padding: 18px 16px 6px;
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 1.8px;
      text-transform: uppercase;
      color: var(--text-soft);
    }

    .adm-nav-item { display: block; list-style: none; }
    .adm-nav-link {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 11px 20px;
      color: var(--text-mid);
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      border-radius: 10px;
      margin: 2px 10px;
      transition: all 0.2s ease;
    }
    .adm-nav-link:hover {
      color: var(--gold);
      background: rgba(184,134,11,0.07);
      text-decoration: none;
    }
    .adm-nav-link.active {
      color: var(--gold);
      background: rgba(184,134,11,0.1);
      border: 1px solid rgba(184,134,11,0.2);
      font-weight: 600;
    }
    .adm-nav-link svg { width: 17px; height: 17px; flex-shrink: 0; }

    .adm-sidebar-footer {
      margin-top: auto;
      padding: 16px;
      border-top: 1px solid rgba(184,134,11,0.1);
    }

    /* ── TOPBAR ─────────────────────────────── */
    .adm-topbar {
      position: fixed;
      top: 0;
      left: var(--sidebar-w);
      right: 0;
      height: 64px;
      background: rgba(255,255,255,0.97);
      backdrop-filter: blur(16px);
      border-bottom: 1px solid rgba(184,134,11,0.12);
      box-shadow: 0 2px 12px rgba(0,0,0,0.05);
      z-index: 180;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 28px;
      gap: 12px;
    }
    @media (max-width: 768px) {
      .adm-topbar {
        left: 0;
        padding: 0 16px;
      }
    }
    .adm-topbar-title {
      font-size: 16px;
      font-weight: 600;
      color: var(--text-dark);
      flex: 1;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .adm-topbar-right { display: flex; align-items: center; gap: 12px; flex-shrink: 0; }
    @media (max-width: 480px) {
      .adm-topbar-title { font-size: 14px; }
      .adm-user-badge span.adm-user-name { display: none; }
      .adm-user-badge { padding: 6px 10px; }
    }
    .adm-user-badge {
      display: flex; align-items: center; gap: 8px;
      padding: 6px 14px;
      background: rgba(184,134,11,0.08);
      border: 1px solid rgba(184,134,11,0.2);
      border-radius: 50px;
      font-size: 13px;
      font-weight: 500;
      color: var(--gold);
      cursor: pointer;
      position: relative;
      user-select: none;
    }
    .adm-user-badge svg { width: 15px; height: 15px; }
    .adm-dropdown {
      display: none;
      position: absolute;
      top: calc(100% + 10px);
      right: 0;
      background: #ffffff;
      border: 1px solid rgba(184,134,11,0.15);
      border-radius: 12px;
      min-width: 180px;
      box-shadow: 0 16px 40px rgba(0,0,0,0.1);
      overflow: hidden;
      z-index: 300;
    }
    .adm-user-badge.open .adm-dropdown { display: block; }
    .adm-dropdown-item {
      display: block;
      padding: 10px 16px;
      font-size: 13px;
      color: var(--text-mid);
      text-decoration: none;
      transition: background 0.15s;
    }
    .adm-dropdown-item:hover { background: rgba(184,134,11,0.07); color: var(--gold); text-decoration: none; }
    .adm-dropdown-item.danger { color: #dc2626; }
    .adm-dropdown-item.danger:hover { background: rgba(220,38,38,0.07); }
    .adm-dropdown-divider { border: none; border-top: 1px solid rgba(184,134,11,0.1); margin: 0; }

    /* ── MAIN CONTENT ─────────────────────────── */
    .adm-main {
      margin-left: var(--sidebar-w);
      padding-top: 80px;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      transition: margin-left 0.3s cubic-bezier(0.4,0,0.2,1);
    }
    .adm-content { padding: 0 28px; flex: 1; }
    @media (max-width: 768px) {
      .adm-main {
        margin-left: 0;
        padding-top: 76px;
      }
      .adm-content { padding: 0 16px; }
    }

    /* ── PAGE HEADER ─────────────────────────── */
    .adm-page-header { margin-bottom: 24px; }
    .adm-page-title {
      font-family: 'Playfair Display', serif;
      font-size: 26px;
      font-weight: 700;
      color: var(--text-dark);
      margin: 0 0 4px;
    }
    .adm-page-subtitle { font-size: 15px; color: var(--text-soft); }
    @media (max-width: 768px) {
      .adm-page-title { font-size: 20px; }
      .adm-page-subtitle { font-size: 13px; }
      .adm-page-header { margin-bottom: 16px; }
    }

    /* ── STAT CARD ─────────────────────────── */
    .adm-stat-card {
      background: #ffffff;
      border: 1px solid rgba(184,134,11,0.15);
      border-radius: 16px;
      padding: 20px;
      display: flex;
      align-items: center;
      gap: 16px;
      transition: transform 0.2s, box-shadow 0.2s;
      box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    }
    .adm-stat-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 30px rgba(0,0,0,0.08);
    }
    .adm-stat-icon {
      width: 52px; height: 52px;
      border-radius: 14px;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }
    .adm-stat-icon svg { width: 26px; height: 26px; }
    .adm-stat-label { font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.8px; color: var(--text-soft); margin-bottom: 4px; }
    .adm-stat-value { font-size: 32px; font-weight: 800; color: var(--text-dark); line-height: 1; }
    .adm-stat-value span { font-size: 14px; font-weight: 500; color: var(--gold); margin-left: 4px; }

    /* ── TABLE CARD ─────────────────────────── */
    .adm-card {
      background: #ffffff;
      border: 1px solid rgba(184,134,11,0.12);
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    }
    .adm-card-header {
      padding: 18px 24px;
      border-bottom: 1px solid rgba(184,134,11,0.1);
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: #FDFAF4;
    }
    .adm-card-title { font-size: 15px; font-weight: 700; color: var(--text-dark); }

    /* TABLE */
    .adm-table { width: 100%; border-collapse: collapse; }
    .adm-table thead tr {
      background: #FDFAF4;
      border-bottom: 1px solid rgba(184,134,11,0.12);
    }
    .adm-table th {
      padding: 12px 16px;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 1px;
      text-transform: uppercase;
      color: var(--gold);
      white-space: nowrap;
    }
    .adm-table td {
      padding: 14px 16px;
      font-size: 14px;
      color: var(--text-mid);
      border-bottom: 1px solid rgba(184,134,11,0.07);
      vertical-align: middle;
    }
    .adm-table tbody tr:hover { background: #FDFAF4; }
    .adm-table tbody tr:last-child td { border-bottom: none; }

    /* BADGE */
    .adm-badge {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 4px 10px;
      border-radius: 50px;
      font-size: 13px;
      font-weight: 700;
      letter-spacing: 0.3px;
    }
    .adm-badge-gold   { background: rgba(184,134,11,0.1); color: #B8860B; border: 1px solid rgba(184,134,11,0.25); }
    .adm-badge-green  { background: rgba(22,163,74,0.1); color: #16a34a; border: 1px solid rgba(22,163,74,0.25); }
    .adm-badge-red    { background: rgba(220,38,38,0.1); color: #dc2626; border: 1px solid rgba(220,38,38,0.25); }
    .adm-badge-blue   { background: rgba(37,99,235,0.1); color: #2563eb; border: 1px solid rgba(37,99,235,0.25); }
    .adm-badge-orange { background: rgba(234,88,12,0.1); color: #ea580c; border: 1px solid rgba(234,88,12,0.25); }

    /* BUTTON */
    .adm-btn {
      display: inline-flex; align-items: center; gap: 6px;
      padding: 7px 14px;
      border-radius: 8px;
      font-size: 12px;
      font-weight: 600;
      border: none;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.2s;
      white-space: nowrap;
    }
    .adm-btn svg { width: 14px; height: 14px; }
    .adm-btn-primary { background: linear-gradient(135deg,#B8860B,#D4A017); color: #fff; }
    .adm-btn-primary:hover { box-shadow: 0 4px 16px rgba(184,134,11,0.35); color: #fff; text-decoration: none; transform: translateY(-1px); }
    .adm-btn-green { background: rgba(22,163,74,0.1); color: #16a34a; border: 1px solid rgba(22,163,74,0.3); }
    .adm-btn-green:hover { background: rgba(22,163,74,0.18); text-decoration: none; color: #16a34a; }
    .adm-btn-outline-red { background: transparent; color: #dc2626; border: 1px solid rgba(220,38,38,0.35); }
    .adm-btn-outline-red:hover { background: rgba(220,38,38,0.08); text-decoration: none; color: #dc2626; }
    .adm-btn-blue { background: rgba(37,99,235,0.1); color: #2563eb; border: 1px solid rgba(37,99,235,0.3); }
    .adm-btn-blue:hover { background: rgba(37,99,235,0.18); text-decoration: none; color: #2563eb; }

    /* ALERT SUCCESS */
    .adm-alert-success {
      display: flex; align-items: center; gap: 10px;
      padding: 14px 18px;
      background: rgba(22,163,74,0.08);
      border: 1px solid rgba(22,163,74,0.25);
      border-radius: 12px;
      color: #16a34a;
      font-size: 14px;
      margin-bottom: 20px;
    }

    /* FOOTER */
    .adm-footer {
      text-align: center;
      padding: 20px;
      font-size: 12px;
      color: var(--text-soft);
      border-top: 1px solid rgba(184,134,11,0.08);
    }

    /* Override Bootstrap table */
    .table { color: inherit; }
    .table-hover tbody tr:hover { background: #FDFAF4; color: inherit; }
  </style>
</head>

<body>

  <!-- SIDEBAR -->
  <div class="adm-sidebar">
    <!-- Brand -->
    <a href="{{ route('home') }}" class="adm-brand" target="_blank">
      <div class="adm-brand-icon" style="background: transparent;">
        <x-application-logo style="width: 38px; height: 38px;" />
      </div>
      <div>
        <div class="adm-brand-text">EventVendor</div>
      </div>
    </a>

    <!-- Nav -->
    <nav style="padding: 8px 0; flex: 1;">
      @if(auth()->user()->role === 'admin')
        <div class="adm-nav-section">Menu Admin</div>

        <li class="adm-nav-item">
          <a href="{{ route('admin.dashboard') }}" class="adm-nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Dashboard
          </a>
        </li>
        <li class="adm-nav-item">
          <a href="{{ route('admin.vendors') }}" class="adm-nav-link {{ Request::routeIs('admin.vendors') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            Kelola Vendor
          </a>
        </li>
        <li class="adm-nav-item">
          <a href="{{ route('admin.users') }}" class="adm-nav-link {{ Request::routeIs('admin.users') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            Data Pelanggan
          </a>
        </li>
      @endif

      @if(Auth::user()->role == 'vendor')
        <div class="adm-nav-section">Menu Vendor</div>
        <li class="adm-nav-item">
          <a href="/vendor/dashboard" class="adm-nav-link {{ Request::is('vendor/dashboard') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            Dashboard
          </a>
        </li>
        <li class="adm-nav-item">
          <a href="{{ route('vendor.profile') }}" class="adm-nav-link {{ Request::is('vendor/profil') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            Profil Bisnis
          </a>
        </li>
        <li class="adm-nav-item">
          <a href="{{ route('paket.index') }}" class="adm-nav-link {{ Request::is('vendor/paket*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            Paket Harga
          </a>
        </li>
        <li class="adm-nav-item">
          <a href="{{ route('portofolio.index') }}" class="adm-nav-link {{ Request::is('vendor/portofolio*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Portofolio
          </a>
        </li>
        <li class="adm-nav-item">
          <a href="{{ route('vendor.transactions') }}" class="adm-nav-link {{ request()->routeIs('vendor.transactions') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            Kelola Pesanan
          </a>
        </li>
      @endif

      <div class="adm-nav-section">Lainnya</div>
      <li class="adm-nav-item">
        <a href="{{ route('home') }}" target="_blank" class="adm-nav-link">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
          Lihat Website
        </a>
      </li>
    </nav>

    <!-- Sidebar Footer -->
    <div class="adm-sidebar-footer">
      <div style="font-size:12px; color:var(--text-soft); text-align:center;">
        © {{ date('Y') }} EventVendor
      </div>
    </div>
  </div>

  <!-- OVERLAY (mobile) -->
  <div class="adm-overlay" id="sidebarOverlay"></div>

  <!-- TOPBAR -->
  <div class="adm-topbar">
    <!-- Hamburger (mobile only) -->
    <button class="adm-hamburger" id="sidebarToggle" aria-label="Buka menu">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
    </button>

    <div class="adm-topbar-title">@yield('title', 'Dashboard')</div>
    <div class="adm-topbar-right">
      <div class="adm-user-badge" id="userBadge">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        <span class="adm-user-name">{{ Auth::user()->name }}</span>
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:12px;height:12px;opacity:0.6;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>

        <div class="adm-dropdown">
          <a href="{{ route('profile.edit') }}" class="adm-dropdown-item">
            <svg style="width:13px;height:13px;margin-right:6px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            Profil Saya
          </a>
          <div class="adm-dropdown-divider"></div>
          <form method="POST" action="{{ route('logout') }}" style="margin:0;">
            @csrf
            <a href="#" class="adm-dropdown-item danger"
               onclick="event.preventDefault(); this.closest('form').submit();">
              <svg style="width:13px;height:13px;margin-right:6px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
              Logout
            </a>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- MAIN CONTENT -->
  <div class="adm-main">
    <div class="adm-content" style="padding-top: 24px; padding-bottom: 24px;">
      @yield('content')
    </div>
    <div class="adm-footer" style="margin-top: auto;">
      &copy; {{ date('Y') }} EventVendor
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>

  <script>
    // ── Dropdown user ──
    const userBadge = document.getElementById('userBadge');
    if (userBadge) {
      userBadge.addEventListener('click', function(e) {
        e.stopPropagation();
        this.classList.toggle('open');
      });
      document.addEventListener('click', function() {
        userBadge.classList.remove('open');
      });
      const dropdown = userBadge.querySelector('.adm-dropdown');
      if (dropdown) {
        dropdown.addEventListener('click', function(e) { e.stopPropagation(); });
      }
    }

    // ── Mobile sidebar toggle ──
    const sidebar    = document.querySelector('.adm-sidebar');
    const overlay    = document.getElementById('sidebarOverlay');
    const toggleBtn  = document.getElementById('sidebarToggle');

    function openSidebar() {
      sidebar.classList.add('sidebar-open');
      overlay.classList.add('active');
      document.body.style.overflow = 'hidden';
    }
    function closeSidebar() {
      sidebar.classList.remove('sidebar-open');
      overlay.classList.remove('active');
      document.body.style.overflow = '';
    }

    if (toggleBtn) {
      toggleBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        sidebar.classList.contains('sidebar-open') ? closeSidebar() : openSidebar();
      });
    }
    if (overlay) {
      overlay.addEventListener('click', closeSidebar);
    }
    // Close sidebar when a nav link is clicked on mobile
    document.querySelectorAll('.adm-nav-link').forEach(function(link) {
      link.addEventListener('click', function() {
        if (window.innerWidth <= 768) closeSidebar();
      });
    });
  </script>

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
