@extends('layouts.admin_master')
@section('title', 'Paket Harga')
@section('content')

<div class="adm-page-header" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
    <div>
        <h1 class="adm-page-title">Paket Harga</h1>
        <p class="adm-page-subtitle">Kelola daftar paket jasa yang Anda tawarkan kepada klien.</p>
    </div>
    <a href="{{ route('paket.create') }}" class="adm-btn adm-btn-primary">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Paket Baru
    </a>
</div>

<div class="adm-card">
    <div class="adm-card-header">
        <span class="adm-card-title">Daftar Paket Anda</span>
        <span class="adm-badge adm-badge-gold">{{ $paket->count() }} paket</span>
    </div>
    <div style="overflow-x:auto;">
        <table class="adm-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Paket</th>
                    <th>Harga</th>
                    <th>Fitur / Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($paket as $item)
                <tr>
                    <td style="color:#9a9ab0;font-size:14px;">{{ $loop->iteration }}</td>
                    <td style="font-weight:600;color:#1a1a2e;">{{ $item->nama_paket }}</td>
                    <td>
                        <span style="font-weight:700;color:#B8860B;">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                    </td>
                    <td style="color:#4a4a6a;font-size:14px;max-width:260px;">{{ Str::limit($item->fitur_paket, 60) }}</td>
                    <td>
                        <form action="{{ route('paket.destroy', $item->id) }}" method="POST"
                              onsubmit="return confirm('Yakin hapus paket ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="adm-btn adm-btn-outline-red">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;padding:40px;color:#9a9ab0;">
                        <svg style="width:40px;height:40px;display:block;margin:0 auto 10px;opacity:0.3;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        Belum ada paket harga. <a href="{{ route('paket.create') }}" style="color:#B8860B;">Tambah sekarang</a>.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
