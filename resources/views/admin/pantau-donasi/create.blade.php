@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-4">Form Salurkan Donasi</h5>
          <div class="row">
            <div class="col-3 d-none d-sm-block"><img src="{{url('admin/assets/images/kampanye')}}/{{$kampanye->foto}}"
                alt="foto-kampanye" class="img-fluid rounded mb-3"></div>
            <div class="col-12 col-sm-9">
                <div class="project-info-box">
                    <h1><b>{{ $kampanye->nama }}</b></h1>
                    <div class="d-flex justify-content-between mb-1">
                        <span><b>Terkumpul:</b> Rp{{ number_format($kampanye->dana_terkumpul, 0, ',', '.') }} <b>Dari:</b> Rp{{ number_format($kampanye->batas_nominal, 0, ',', '.') }} </span>
                    </div>
                    <div class="progress" style="height: 20px;">
                        @php
                            $percentage = ($kampanye->dana_terkumpul / $kampanye->batas_nominal) * 100;
                        @endphp
                        <div class="progress-bar bg-success" role="progressbar"
                             style="width: {{ $percentage }}%;"
                             aria-valuenow="{{ $percentage }}"
                             aria-valuemin="0"
                             aria-valuemax="100">
                            {{ round($percentage, 2) }}%
                        </div>
                    </div>
                </div>

            </div>
        </div>
          <div class="card">
            <div class="card-body">
                <form action="{{ route('pantau-donasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Kampanye ID (Hidden) -->
                    <input type="hidden" name="kampanye_id" value="{{ $kampanye->id }}">

                    <!-- Tanggal Penyaluran -->
                    <div class="mb-3">
                        <label for="tgl_penyaluran" class="form-label">Tanggal Penyaluran</label>
                        <input type="date" name="tgl_penyaluran" id="tgl_penyaluran" class="form-control" required>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required></textarea>
                    </div>

                    <!-- Upload Foto Penyaluran -->
                    <div class="mb-3">
                        <label for="foto_penyaluran" class="form-label">Foto Penyaluran</label>
                        <input type="file" name="foto_penyaluran" id="foto_penyaluran" class="form-control" accept="image/jpeg,image/png,image/jpg" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
