@extends('layouts.admin_master')
@section('title', 'Kelola Vendor')
@section('content')

<div class="adm-page-header">
    <h1 class="adm-page-title">Kelola Vendor</h1>
    <p class="adm-page-subtitle">Verifikasi dan pantau status semua vendor terdaftar.</p>
</div>

@if(session('success'))
    <div class="adm-alert-success">
        <svg style="width:18px;height:18px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ session('success') }}
    </div>
@endif

<div class="adm-card">
    <div class="adm-card-header">
        <span class="adm-card-title">Daftar Vendor</span>
        <span class="adm-badge adm-badge-gold">{{ count($vendors) }} vendor</span>
    </div>
    <div style="overflow-x: auto;">
        <table class="adm-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Bisnis</th>
                    <th>Pemilik</th>
                    <th>Kelengkapan Profil</th>
                    <th>Status Verifikasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vendors as $i => $v)
                @php
                    $isComplete = $v->address && $v->no_whatsapp && $v->tentang_kami;
                @endphp
                <tr>
                    <td style="color: #9a9ab0; font-size:13px;">{{ $i + 1 }}</td>
                    <td>
                        <span style="color:#1a1a2e; font-weight:600;">{{ $v->nama_bisnis }}</span>
                    </td>
                    <td>
                        <div style="font-weight:500; color:#1a1a2e;">{{ $v->user->name }}</div>
                        <div style="font-size:14px; color:#9a9ab0;">{{ $v->user->email }}</div>
                    </td>
                    <td>
                        @if($isComplete)
                            <span class="adm-badge adm-badge-blue">
                                <svg style="width:11px;height:11px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                Lengkap
                            </span>
                        @else
                            <span class="adm-badge adm-badge-red">
                                <svg style="width:11px;height:11px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
                                Belum Lengkap
                            </span>
                            <div style="font-size:13px; color:#9a9ab0; margin-top:3px;">Alamat/WA belum diisi</div>
                        @endif
                    </td>
                    <td>
                        @if($v->is_verified)
                            <span class="adm-badge adm-badge-green">
                                <svg style="width:11px;height:11px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                Terverifikasi
                            </span>
                        @else
                            <span class="adm-badge adm-badge-orange">
                                <svg style="width:11px;height:11px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Menunggu
                            </span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex; flex-direction:column; gap:6px;">
                            <a href="{{ route('frontend.vendor.detail', $v->slug) }}" target="_blank" class="adm-btn adm-btn-blue">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                Cek Detail
                            </a>

                            @if(!$v->is_verified)
                                <form action="{{ route('admin.vendor.verify', $v->id) }}" method="POST" style="margin:0;">
                                    @csrf
                                    <button type="submit" class="adm-btn adm-btn-green" style="width:100%;">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Verifikasi
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.vendor.unverify', $v->id) }}" method="POST" style="margin:0;"
                                      onsubmit="return confirm('Yakin ingin membatalkan verifikasi vendor ini?');">
                                    @csrf
                                    <button type="submit" class="adm-btn adm-btn-outline-red" style="width:100%;">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                        Batalkan
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
