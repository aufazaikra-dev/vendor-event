@extends('layouts.admin_master')
@section('content')
<div class="container-fluid py-4">
    <h2 class="fw-bold mb-4">Data Pelanggan & Riwayat Pemakaian Jasa</h2>
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Pelanggan</th>
                            <th>Email</th>
                            <th>Total Pemakaian Jasa</th>
                            <th>Detail Vendor yang Pernah Dipakai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td class="fw-bold">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-center h5 fw-bold text-primary">{{ $user->transactions->count() }}</td>
                            <td>
                                @if($user->transactions->count() > 0)
                                    <ul class="mb-0" style="padding-left: 15px;">
                                        @foreach($user->transactions as $trx)
                                            <li>
                                                <strong class="text-dark">{{ $trx->vendor->nama_bisnis ?? 'Vendor Dihapus' }}</strong>
                                                <small class="text-muted">({{ $trx->pricelist->nama_paket ?? 'Paket' }}) -
                                                    <span class="{{ $trx->status == 'selesai' ? 'text-success' : 'text-warning' }}">
                                                        {{ strtoupper(str_replace('_', ' ', $trx->status)) }}
                                                    </span>
                                                </small>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-muted small">Belum pernah menggunakan jasa vendor.</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada pelanggan terdaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
