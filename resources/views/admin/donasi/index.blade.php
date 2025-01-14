@extends('admin.layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
      <div class="card w-100">
        <div class="card-body p-4">
          <h5 class="card-title fw-semibold mb-4">Tabel Donasi</h5>
          <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle">
              <thead class="text-dark fs-4">
                <tr>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">No</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Kampanye</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Nama Donatur</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Nominal Donasi</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Tanggal Donasi</h6>
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($donasi as $d)
                <tr>
                  <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">{{$loop->iteration}}</h6></td>
                  <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">{{$d->kampanye}}</h6></td>
                  <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">{{$d->nama_donatur}}</h6></td>
                  <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-0 fs-4">{{$d->nominal_donasi}}</h6>
                  </td>
                  <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-0 fs-4">{{$d->tanggal_donasi}}</h6>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
