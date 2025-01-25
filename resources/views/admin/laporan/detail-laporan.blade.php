@extends('admin.layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
      <div class="card w-100">
        <div class="card-body p-4">
          <h5 class="card-title fw-semibold mb-4">Tabel Laporan</h5>
          <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle">
              <thead class="text-dark fs-4">
                <tr>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Nama Kampanye</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Dana Terkumpul</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Batas Tanggal Kampanye</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Target Dana Donasi</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Status Kampanye</h6>
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kampanye as $k)
                <tr>
                  <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">{{$k->nama}}</h6></td>
                  <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">{{$k->dana_terkumpul}}</h6></td>
                  <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">{{$k->batas_tanggal}}</h6></td>
                  <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">{{$k->batas_nominal}}</h6></td>
                  <td class="border-bottom-0">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-success rounded-3 fw-semibold">{{$k->status}}</span>
                      </div>
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
