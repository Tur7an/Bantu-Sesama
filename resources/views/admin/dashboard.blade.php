@extends('admin.layouts.app')
@section('content')

<h1>Selamat Datang di Dashboard Admin</h1>

<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
      <div class="card w-100">
        <div class="card-body p-4">
          <div class="mb-4">
            <h5 class="card-title fw-semibold">Riwayat Donasi Terbaru</h5>
          </div>
          <ul class="timeline-widget mb-0 position-relative mb-n5">
            @foreach ($donasi as $d)
            <li class="timeline-item d-flex position-relative overflow-hidden">
              <div class="timeline-time text-dark flex-shrink-0 text-end">{{$d->waktu_donasi}}</div>
              <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                <span class="timeline-badge-border d-block flex-shrink-0"></span>
              </div>
              <div class="timeline-desc fs-3 text-dark mt-n1"><b>{{$d->nama_donatur}}</b>, Berdonasi Pada Kampanye <b>{{$d->nama_kampanye}}</b>, Rp{{ number_format($d->nominal_donasi, 0, ',', '.') }}</div>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>

@endsection
