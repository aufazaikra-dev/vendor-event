@extends('layouts.admin_master')
@section('content')
<div class="container-fluid py-4">
    <h2 class="fw-bold mb-4">Kelola Data Vendor</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Bisnis</th>
                            <th>Pemilik (Email)</th>
                            <th>Kelengkapan Profil</th>
                            <th>Status Verifikasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vendors as $v)
                        @php
                            // Cek kelengkapan: Punya alamat, WA, dan deskripsi
                            $isComplete = $v->address && $v->no_whatsapp && $v->tentang_kami;
                        @endphp
                        <tr>
                            <td class="fw-bold text-primary">{{ $v->nama_bisnis }}</td>
                            <td>{{ $v->user->name }}<br><small class="text-muted">{{ $v->user->email }}</small></td>
                            <td>
                                @if($isComplete)
                                    <span class="badge bg-info text-dark"><i class="fas fa-check"></i> Lengkap</span>
                                @else
                                    <span class="badge bg-danger"><i class="fas fa-times"></i> Belum Lengkap</span>
                                    <small class="d-block text-muted" style="font-size: 11px;">(Alamat/WA belum diisi)</small>
                                @endif
                            </td>
                            <td>
                                @if($v->is_verified)
                                    <span class="badge bg-success">Terverifikasi</span>
                                @else
                                    <span class="badge bg-warning text-dark">Menunggu Verifikasi</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('frontend.vendor.detail', $v->slug) }}" target="_blank" class="btn btn-sm btn-info mb-1 fw-bold text-white w-100">
                                    <i class="fas fa-eye"></i> Cek Detail
                                </a>

                                @if(!$v->is_verified)
                                    <form action="{{ route('admin.vendor.verify', $v->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-success fw-bold w-100"><i class="fas fa-check"></i> Verifikasi</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.vendor.unverify', $v->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin membatalkan verifikasi vendor ini?');">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-danger fw-bold w-100"><i class="fas fa-ban"></i> Batalkan</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
