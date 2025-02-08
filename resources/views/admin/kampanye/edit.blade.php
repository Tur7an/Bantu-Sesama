@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-4">Form Edit Kampanye</h5>
          <div class="card">
            <div class="card-body">
                @foreach ($kampanye as $k)
              <form method="POST" action="{{route('kampanye.update',$k->id)}}"
              enctype="multipart/form-data">
              @csrf
              @method('PUT')
                <div class="mb-3">
                    <label for="namaKampanye" class="form-label">Nama Kampanye</label>
                    <input type="text" class="form-control" id="namaKampanye" name="nama" value="{{$k->nama}}" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{$k->deskripsi}}</textarea>
                </div>

                <div class="mb-3">
                    <label for="batasNominal" class="form-label">Batas Nominal</label>
                    <input type="number" class="form-control" id="batasNominal" name="batas_nominal" step="1000" value="{{$k->batas_nominal}}" required>
                </div>

                <div class="mb-3">
                    <label for="batasTanggal" class="form-label">Batas Tanggal</label>
                    <input type="date" class="form-control" id="batasTanggal" name="batas_tanggal" value="{{$k->batas_tanggal}}" required>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" name="status" disabled>
                        <option value="aktif" {{ old('status', $k->status ?? '') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status', $k->status ?? '') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="fotoKampanye" class="form-label">Foto Kampanye</label>
                    <input type="file" class="form-control" id="fotoKampanye" name="foto" value="{{$k->foto}}"><br>
                    <img src="{{url('admin/assets/images/kampanye')}}/{{$k->foto}}" alt="" srcset="">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </form>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

@endsection
