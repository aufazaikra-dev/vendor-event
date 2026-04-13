@extends('layouts.admin_master')
@section('content')
<div class="container-fluid py-4">
    <h2 class="fw-bold mb-4">Dashboard Admin</h2>
    <div class="row">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm border-0 bg-primary text-white h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="fw-bold mb-1">Total Pelanggan (User)</h6>
                        <h2 class="mb-0">{{ $total_users }}</h2>
                    </div>
                    <i class="fas fa-users fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm border-0 bg-success text-white h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="fw-bold mb-1">Total Vendor Terdaftar</h6>
                        <h2 class="mb-0">{{ $total_vendors }}</h2>
                    </div>
                    <i class="fas fa-store fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm border-0 bg-warning text-dark h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="fw-bold mb-1">Kategori Jasa</h6>
                        <h2 class="mb-0">{{ $total_categories }}</h2>
                    </div>
                    <i class="fas fa-tags fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
