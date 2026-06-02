@extends('layouts.admin_master')
@section('title', 'Dashboard Vendor')
@section('content')

<div class="adm-page-header">
    <h1 class="adm-page-title">Dashboard Vendor</h1>
    <p class="adm-page-subtitle">Selamat datang, <strong style="color:#B8860B;">{{ Auth::user()->name }}</strong>! Kelola bisnis Anda dari sini.</p>
</div>

<!-- Status Verifikasi Banner -->
@if(!$vendor->is_verified)
<div style="display:flex;align-items:center;gap:12px;padding:14px 18px;background:rgba(234,88,12,0.08);border:1px solid rgba(234,88,12,0.2);border-radius:12px;margin-bottom:24px;">
    <svg style="width:20px;height:20px;color:#ea580c;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
    </svg>
    <span style="color:#ea580c;font-size:16px;font-weight:500;">Akun Anda sedang menunggu verifikasi admin. Lengkapi profil bisnis Anda terlebih dahulu.</span>
</div>
@endif

<!-- Stat Cards -->
<div class="row" style="gap:0;">
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="adm-stat-card">
            <div class="adm-stat-icon" style="background:rgba(184,134,11,0.1);border:1px solid rgba(184,134,11,0.2);">
                <svg style="color:#B8860B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <div>
                <div class="adm-stat-label">Total Paket Harga</div>
                <div class="adm-stat-value">{{ $total_paket }}</div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="adm-stat-card">
            <div class="adm-stat-icon" style="background:rgba(234,179,8,0.1);border:1px solid rgba(234,179,8,0.2);">
                <svg style="color:#ca8a04;" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
            </div>
            <div>
                <div class="adm-stat-label">Rating Saya</div>
                <div class="adm-stat-value">{{ number_format($rating, 1) }}<span>/ 5.0</span></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="adm-stat-card">
            <div class="adm-stat-icon" style="background:{{ $vendor->is_verified ? 'rgba(22,163,74,0.1)' : 'rgba(234,88,12,0.1)' }};border:1px solid {{ $vendor->is_verified ? 'rgba(22,163,74,0.2)' : 'rgba(234,88,12,0.2)' }};">
                <svg style="color:{{ $vendor->is_verified ? '#16a34a' : '#ea580c' }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    @if($vendor->is_verified)
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    @else
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    @endif
                </svg>
            </div>
            <div>
                <div class="adm-stat-label">Status Akun</div>
                <div style="margin-top:4px;">
                    @if($vendor->is_verified)
                        <span class="adm-badge adm-badge-green">Terverifikasi</span>
                    @else
                        <span class="adm-badge adm-badge-orange">Menunggu Verifikasi</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Info Card -->
<div class="adm-card">
    <div class="adm-card-header">
        <span class="adm-card-title">Panduan Penggunaan CMS</span>
    </div>
    <div style="padding:24px;">
        <div class="row">
            <div class="col-md-4 mb-3 mb-md-0">
                <div style="display:flex;gap:14px;align-items:flex-start;">
                    <div style="width:40px;height:40px;border-radius:10px;background:rgba(184,134,11,0.1);border:1px solid rgba(184,134,11,0.2);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg style="width:18px;height:18px;color:#B8860B;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16"/></svg>
                    </div>
                    <div>
                        <div style="font-weight:600;color:#1a1a2e;font-size:16px;margin-bottom:4px;">Profil Bisnis</div>
                        <div style="font-size:14px;color:#7a7a9a;line-height:1.6;">Update alamat, nomor WA, dan deskripsi bisnis Anda.</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <div style="display:flex;gap:14px;align-items:flex-start;">
                    <div style="width:40px;height:40px;border-radius:10px;background:rgba(37,99,235,0.08);border:1px solid rgba(37,99,235,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg style="width:18px;height:18px;color:#2563eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                    <div>
                        <div style="font-weight:600;color:#1a1a2e;font-size:16px;margin-bottom:4px;">Paket Harga</div>
                        <div style="font-size:14px;color:#7a7a9a;line-height:1.6;">Tambah paket harga agar muncul di hasil pencarian.</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div style="display:flex;gap:14px;align-items:flex-start;">
                    <div style="width:40px;height:40px;border-radius:10px;background:rgba(22,163,74,0.08);border:1px solid rgba(22,163,74,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg style="width:18px;height:18px;color:#16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <div style="font-weight:600;color:#1a1a2e;font-size:16px;margin-bottom:4px;">Portofolio</div>
                        <div style="font-size:14px;color:#7a7a9a;line-height:1.6;">Upload foto acara agar dilirik calon klien baru.</div>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top:20px;padding-top:20px;border-top:1px solid rgba(184,134,11,0.1);">
            <a href="{{ route('vendor.profile') }}" class="adm-btn adm-btn-primary">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Lengkapi Profil Bisnis Sekarang
            </a>
        </div>
    </div>
</div>

@endsection
