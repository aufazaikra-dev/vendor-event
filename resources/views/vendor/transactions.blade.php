@extends('layouts.admin_master')
@section('title', 'Kelola Pesanan')
@section('content')

<div class="adm-page-header">
    <h1 class="adm-page-title">Kelola Pesanan & Ulasan</h1>
    <p class="adm-page-subtitle">Catat pesanan masuk dan pantau ulasan dari klien Anda.</p>
</div>

@if(session('success'))
    <div class="adm-alert-success mb-4">
        <svg style="width:18px;height:18px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ session('success') }}
    </div>
@endif

<!-- Form Input Pesanan Baru -->
<div class="adm-card mb-5">
    <div class="adm-card-header">
        <span class="adm-card-title" style="display:flex;align-items:center;gap:8px;">
            <svg style="width:16px;height:16px;color:#16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Input Pesanan Baru
        </span>
    </div>
    <div style="padding:24px;">
        <form action="{{ route('vendor.transactions.store') }}" method="POST">
            @csrf
            <div class="row align-items-end">
                <div class="col-md-5 mb-3 mb-md-0">
                    <label class="adm-field-label">Pilih Pelanggan (User)</label>
                    <select name="user_id" class="adm-field-input adm-field-select" required>
                        <option value="">-- Cari Nama Pelanggan --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5 mb-3 mb-md-0">
                    <label class="adm-field-label">Pilih Paket Jasa</label>
                    <select name="pricelist_id" class="adm-field-input adm-field-select" required>
                        <option value="">-- Pilih Paket --</option>
                        @foreach($pricelists as $paket)
                            <option value="{{ $paket->id }}">{{ $paket->nama_paket }} — Rp {{ number_format($paket->harga, 0, ',', '.') }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="adm-btn adm-btn-green" style="width:100%;justify-content:center;padding:10px;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Tabel Riwayat Transaksi -->
<div class="adm-card">
    <div class="adm-card-header">
        <span class="adm-card-title">Riwayat Transaksi Klien</span>
        <span class="adm-badge adm-badge-gold">{{ $transactions->count() }} pesanan</span>
    </div>
    <div style="overflow-x:auto;">
        <table class="adm-table">
            <thead>
                <tr>
                    <th>Kode Pesanan</th>
                    <th>Pelanggan</th>
                    <th>Paket</th>
                    <th>Status</th>
                    <th>Ulasan Klien</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $trx)
                <tr>
                    <td>
                        <span style="font-family:monospace;font-weight:600;color:#B8860B;font-size:14px;">{{ $trx->kode_pesanan }}</span>
                    </td>
                    <td style="font-weight:500;color:#1a1a2e;">{{ $trx->user->name ?? 'User Dihapus' }}</td>
                    <td style="color:#4a4a6a;font-size:14px;">{{ $trx->pricelist->nama_paket ?? 'Paket Dihapus' }}</td>
                    <td>
                        <form action="{{ route('vendor.transactions.update', $trx->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" class="adm-field-input adm-field-select"
                                    style="padding:6px 10px;font-size:12px;width:auto;"
                                    onchange="this.form.submit()">
                                <option value="sedang_dilaksanakan" {{ $trx->status == 'sedang_dilaksanakan' ? 'selected' : '' }}>Sedang Dilaksanakan</option>
                                <option value="selesai" {{ $trx->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        @if($trx->review)
                            <div style="padding:12px;background:#F8F6F0;border-radius:10px;border:1px solid rgba(184,134,11,0.1);">
                                <!-- Rating bintang -->
                                <div style="display:flex;align-items:center;gap:4px;margin-bottom:6px;">
                                    @for($i=1; $i<=5; $i++)
                                        <svg style="width:13px;height:13px;color:{{ $i <= $trx->review->rating ? '#ca8a04' : '#d1d5db' }};" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                    <span style="font-size:11px;color:#7a7a9a;margin-left:4px;">{{ $trx->review->rating }}/5</span>
                                </div>
                                <!-- Komentar -->
                                <div style="font-size:14px;color:#4a4a6a;font-style:italic;margin-bottom:8px;">
                                    "{{ $trx->review->komentar }}"
                                </div>
                                <!-- Balasan -->
                                @if(!$trx->review->balasan_vendor)
                                    <form action="{{ route('vendor.review.reply', $trx->review->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div style="display:flex;gap:6px;">
                                            <input type="text" name="balasan_vendor"
                                                   class="adm-field-input"
                                                   style="padding:8px 12px;font-size:13px;"
                                                   placeholder="Balas ulasan ini..." required>
                                            <button type="submit" class="adm-btn adm-btn-primary" style="white-space:nowrap;padding:7px 12px;">Balas</button>
                                        </div>
                                    </form>
                                @else
                                    <div style="margin-top:6px;padding-top:8px;border-top:1px solid rgba(184,134,11,0.1);">
                                        <span style="font-size:11px;font-weight:700;color:#B8860B;text-transform:uppercase;letter-spacing:0.5px;">Balasan Anda:</span>
                                        <div style="font-size:14px;color:#4a4a6a;margin-top:2px;">{{ $trx->review->balasan_vendor }}</div>
                                    </div>
                                @endif
                            </div>
                        @else
                            <span style="font-size:13px;color:#9a9ab0;font-style:italic;">Belum ada ulasan</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;padding:40px;color:#9a9ab0;">
                        <svg style="width:40px;height:40px;display:block;margin:0 auto 10px;opacity:0.3;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        Belum ada pesanan dicatat.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
    .adm-field-label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.6px;
        text-transform: uppercase;
        color: #B8860B;
        margin-bottom: 6px;
    }
    .adm-field-input {
        display: block;
        width: 100%;
        padding: 10px 14px;
        background: #F8F6F0;
        border: 1px solid rgba(184,134,11,0.2);
        border-radius: 10px;
        color: #1a1a2e;
        font-size: 15px;
        font-family: 'Inter', sans-serif;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .adm-field-input::placeholder { color: #9a9ab0; }
    .adm-field-input:focus {
        outline: none;
        border-color: #B8860B;
        box-shadow: 0 0 0 3px rgba(184,134,11,0.1);
        background: #ffffff;
    }
    .adm-field-select option { background: #fff; color: #1a1a2e; }
</style>
@endsection
