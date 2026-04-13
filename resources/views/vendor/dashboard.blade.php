@extends('layouts.admin_master')

@section('title', 'Dashboard Vendor')

@section('content')
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1 shadow-sm">
        <div class="card-icon bg-primary text-white p-3 rounded-circle float-left mr-3 text-center" style="width:60px; height:60px">
          <i class="far fa-user" style="font-size:24px; line-height:30px"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Paket Harga</h4>
          </div>
          <div class="card-body font-weight-bold">
            {{ $total_paket }} Paket
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1 shadow-sm">
        <div class="card-icon bg-warning text-white p-3 rounded-circle float-left mr-3 text-center" style="width:60px; height:60px">
            <i class="far fa-star" style="font-size:24px; line-height:30px"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Rating Saya</h4>
          </div>
          <div class="card-body font-weight-bold">
            {{ number_format($rating, 1) }} / 5.0
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1 shadow-sm">
          <div class="card-icon bg-success text-white p-3 rounded-circle float-left mr-3 text-center" style="width:60px; height:60px">
              <i class="fas fa-check" style="font-size:24px; line-height:30px"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Status Akun</h4>
            </div>
            <div class="card-body font-weight-bold">
                @if($vendor->is_verified)
                    <span class="badge badge-success">Terverifikasi</span>
                @else
                    <span class="badge badge-warning">Menunggu Verifikasi Admin</span>
                @endif
            </div>
          </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header border-bottom p-3">
                <h4>Selamat Datang, {{ Auth::user()->name }}!</h4>
            </div>
            <div class="card-body p-4">
                <p>Ini adalah area CMS Vendor Anda. Di sini Anda bisa:</p>
                <ul>
                    <li>Mengupdate Profil Bisnis (Alamat, No WA, Deskripsi).</li>
                    <li>Menambah Paket Harga agar muncul di pencarian.</li>
                    <li>Upload Foto Portofolio agar dilirik klien.</li>
                </ul>
                <a href="{{ route('vendor.profile') }}" class="btn btn-primary">Lengkapi Profil Bisnis Sekarang</a>
            </div>
        </div>
    </div>
</div>
@endsection
