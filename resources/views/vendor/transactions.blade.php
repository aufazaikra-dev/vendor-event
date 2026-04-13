@extends('layouts.admin_master')

@section('content')
<div class="container-fluid py-4">
    <h2 class="fw-bold mb-4">Kelola Pesanan & Ulasan Klien</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0 mb-5">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-plus"></i> Input Pesanan Baru</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('vendor.transactions.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label class="form-label fw-bold">Pilih Pelanggan (User)</label>
                        <select name="user_id" class="form-control" required>
                            <option value="">-- Cari Nama Pelanggan --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label class="form-label fw-bold">Pilih Paket Jasa</label>
                        <select name="pricelist_id" class="form-control" required>
                            <option value="">-- Pilih Paket --</option>
                            @foreach($pricelists as $paket)
                                <option value="{{ $paket->id }}">{{ $paket->nama_paket }} - Rp {{ number_format($paket->harga, 0, ',', '.') }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 mb-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-success w-100"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Riwayat Transaksi Pelanggan</h5>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Kode Pesanan</th>
                            <th>Pelanggan</th>
                            <th>Paket</th>
                            <th>Status & Aksi</th>
                            <th>Ulasan Klien</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $trx)
                        <tr>
                            <td class="fw-bold text-primary">{{ $trx->kode_pesanan }}</td>
                            <td>{{ $trx->user->name ?? 'User Dihapus' }}</td>
                            <td>{{ $trx->pricelist->nama_paket ?? 'Paket Dihapus' }}</td>
                            <td>
                                <form action="{{ route('vendor.transactions.update', $trx->id) }}" method="POST" class="d-flex">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-control form-control-sm me-2" onchange="this.form.submit()">
                                        <option value="sedang_dilaksanakan" {{ $trx->status == 'sedang_dilaksanakan' ? 'selected' : '' }}>Sedang Dilaksanakan</option>
                                        <option value="selesai" {{ $trx->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                @if($trx->review)
                                    <div class="bg-light p-2 rounded small">
                                        <span class="text-warning"><i class="fas fa-star"></i> {{ $trx->review->rating }}/5</span><br>
                                        <i>"{{ $trx->review->komentar }}"</i>

                                        @if(!$trx->review->balasan_vendor)
                                            <form action="{{ route('vendor.review.reply', $trx->review->id) }}" method="POST" class="mt-2">
                                                @csrf
                                                @method('PUT')
                                                <div class="input-group input-group-sm">
                                                    <input type="text" name="balasan_vendor" class="form-control" placeholder="Balas ulasan..." required>
                                                    <button type="submit" class="btn btn-primary btn-sm">Balas</button>
                                                </div>
                                            </form>
                                        @else
                                            <hr class="my-1">
                                            <strong class="text-primary">Balasan Anda:</strong><br>
                                            {{ $trx->review->balasan_vendor }}
                                        @endif
                                    </div>
                                @else
                                    <span class="text-muted small">Belum ada ulasan</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada pesanan dicatat.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
