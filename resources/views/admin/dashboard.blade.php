@extends('layouts.admin_master')
@section('title', 'Dashboard Admin')
@section('content')

<div class="adm-page-header">
    <h1 class="adm-page-title">Dashboard Admin</h1>
    <p class="adm-page-subtitle">Selamat datang kembali, {{ Auth::user()->name }}. Berikut ringkasan sistem.</p>
</div>

<!-- Stat Cards -->
<div class="row" style="gap: 0;">
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="adm-stat-card">
            <div class="adm-stat-icon" style="background: rgba(37,99,235,0.1); border: 1px solid rgba(37,99,235,0.2);">
                <svg style="color:#2563eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <div class="adm-stat-label">Total Pelanggan</div>
                <div class="adm-stat-value">{{ $total_users }}</div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="adm-stat-card">
            <div class="adm-stat-icon" style="background: rgba(22,163,74,0.1); border: 1px solid rgba(22,163,74,0.2);">
                <svg style="color:#16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <div>
                <div class="adm-stat-label">Total Vendor</div>
                <div class="adm-stat-value">{{ $total_vendors }}</div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="adm-stat-card">
            <div class="adm-stat-icon" style="background: rgba(184,134,11,0.1); border: 1px solid rgba(184,134,11,0.2);">
                <svg style="color:#B8860B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </div>
            <div>
                <div class="adm-stat-label">Kategori Jasa</div>
                <div class="adm-stat-value">{{ $total_categories }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Info Card -->
<div class="adm-card mt-2">
    <div class="adm-card-header">
        <span class="adm-card-title">Akses Cepat</span>
    </div>
    <div style="padding: 20px 24px; display: flex; gap: 12px; flex-wrap: wrap;">
        <a href="{{ route('admin.vendors') }}" class="adm-btn adm-btn-primary">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16"/></svg>
            Kelola Vendor
        </a>
        <a href="{{ route('admin.users') }}" class="adm-btn adm-btn-blue">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            Data Pelanggan
        </a>
        <a href="{{ route('home') }}" target="_blank" class="adm-btn adm-btn-green">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9"/></svg>
            Lihat Website
        </a>
    </div>
</div>

@endsection
