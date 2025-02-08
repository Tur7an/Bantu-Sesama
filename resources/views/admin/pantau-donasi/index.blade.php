@extends('admin.layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
      <div class="card w-100">
        <div class="card-body p-4">
          <h5 class="card-title fw-semibold mb-4">Tabel Pantau Donasi</h5>
          <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle">
              <thead class="text-dark fs-4">
                <tr>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">No</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Nama Kampanye</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Dana Terkumpul</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Batas Tanggal</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Target Dana</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Status</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Aksi</h6>
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pantauKampanye as $kampanye)
                <tr>
                  <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">{{$loop->iteration}}</h6></td>
                  <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-0"></h6>{{$kampanye->nama}}</td>
                  <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-0"></h6>Rp.{{ number_format($kampanye->dana_terkumpul, 0, ',', '.') }}</td>
                  <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-0"></h6>{{$kampanye->batas_tanggal}}</td>
                  <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-0"></h6>Rp.{{ number_format($kampanye->batas_nominal, 0, ',', '.') }}</td>
                    <td class="border-bottom-0">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge {{ $kampanye->status == 'selesai' ? 'bg-success' : 'bg-danger' }} rounded-3 fw-semibold">
                                {{ $kampanye->status }}
                            </span>
                        </div>
                    </td>
                    <td class="border-bottom-0">
                        @if ($kampanye->status == 'nonaktif')
                            <a href="{{ route('pantau-donasi.create', $kampanye->id) }}" class="btn btn-warning m-1">
                                <i class="fa-solid fa-circle-check"></i> Salurkan
                            </a>
                        @elseif ($kampanye->status == 'selesai')
                            <a href="" class="btn btn-info m-1">
                                <i class="fa-solid fa-eye"></i> Lihat Detail
                            </a>
                           <!-- Optional: You can add another button for other statuses -->
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
  </div>

@endsection
