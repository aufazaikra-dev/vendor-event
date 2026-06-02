@extends('layouts.admin_master')
@section('title', 'Data Pelanggan')
@section('content')

<div class="adm-page-header">
    <h1 class="adm-page-title">Data Pelanggan</h1>
    <p class="adm-page-subtitle">Riwayat penggunaan jasa vendor oleh seluruh pelanggan terdaftar.</p>
</div>

<div class="adm-card">
    <div class="adm-card-header">
        <span class="adm-card-title">Daftar Pelanggan</span>
        <span class="adm-badge adm-badge-blue">{{ $users->count() }} pelanggan</span>
    </div>
    <div style="overflow-x: auto;">
        <table class="adm-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Email</th>
                    <th style="text-align:center;">Total Transaksi</th>
                    <th>Detail Vendor yang Pernah Dipakai</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $i => $user)
                <tr>
                    <td style="color:#9a9ab0; font-size:13px;">{{ $i + 1 }}</td>
                    <td>
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div style="width:34px; height:34px; border-radius:50%; background:rgba(184,134,11,0.1); border:1px solid rgba(184,134,11,0.2); display:flex; align-items:center; justify-content:center; font-size:13px; font-weight:700; color:#B8860B; flex-shrink:0;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <span style="font-weight:600; color:#1a1a2e;">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td style="color:#4a4a6a; font-size:14px;">{{ $user->email }}</td>
                    <td style="text-align:center;">
                        <span class="adm-badge {{ $user->transactions->count() > 0 ? 'adm-badge-gold' : 'adm-badge-red' }}" style="font-size:13px; padding: 6px 14px;">
                            {{ $user->transactions->count() }}
                        </span>
                    </td>
                    <td>
                        @if($user->transactions->count() > 0)
                            <div style="display:flex; flex-direction:column; gap:6px;">
                                @foreach($user->transactions as $trx)
                                    <div style="display:flex; align-items:center; gap:8px; padding:8px 10px; background:#F8F6F0; border-radius:8px; border:1px solid rgba(184,134,11,0.1);">
                                        <div style="flex:1; min-width:0;">
                                            <div style="font-weight:600; color:#1a1a2e; font-size:14px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                                {{ $trx->vendor->nama_bisnis ?? 'Vendor Dihapus' }}
                                            </div>
                                            <div style="font-size:12px; color:#9a9ab0;">
                                                {{ $trx->pricelist->nama_paket ?? 'Paket' }}
                                            </div>
                                        </div>
                                        <span class="adm-badge {{ $trx->status == 'selesai' ? 'adm-badge-green' : 'adm-badge-orange' }}" style="font-size:10px;">
                                            {{ strtoupper(str_replace('_', ' ', $trx->status)) }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <span style="font-size:14px; color:#9a9ab0; font-style:italic;">Belum pernah menggunakan jasa vendor.</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center; padding:40px; color:#9a9ab0;">
                        <svg style="width:40px;height:40px;margin-bottom:10px;display:block;margin-inline:auto;opacity:0.3;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Belum ada pelanggan terdaftar.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
