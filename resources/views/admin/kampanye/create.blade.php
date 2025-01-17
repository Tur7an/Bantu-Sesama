@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-4">Form Tambah Kampanye</h5>
          <div class="card">
            <div class="card-body">
            @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
              <form method="POST" action="{{route('kampanye.store')}}"
              enctype="multipart/form-data">
              @csrf
                <div class="mb-3">
                    <label for="namaKampanye" class="form-label">Nama Kampanye</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="namaKampanye" name="nama">
                    @error('nama')
                        <div class="invalid=feedback" style="color: red;">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control  @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3"></textarea>
                    @error('deskripsi')
                        <div class="invalid=feedback" style="color: red;">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="batasNominal" class="form-label">Batas Nominal</label>
                    <input type="number" class="form-control  @error('batas_nominal') is-invalid @enderror" id="batasNominal" name="batas_nominal" step="1000">
                    @error('batas_nominal')
                    <div class="invalid=feedback" style="color: red;">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="batasTanggal" class="form-label">Batas Tanggal</label>
                    <input type="date" class="form-control  @error('batas_tanggal') is-invalid @enderror" id="batasTanggal" name="batas_tanggal">
                    @error('batas_tanggal')
                    <div class="invalid=feedback" style="color: red;">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control  @error('status') is-invalid @enderror" id="status" name="status">
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                    @error('status')
                    <div class="invalid=feedback" style="color: red;">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="fotoKampanye" class="form-label">Foto Kampanye</label>
                    <input type="file" class="form-control  @error('foto') is-invalid @enderror" id="fotoKampanye" name="foto">
                    @error('foto')
                    <div class="invalid=feedback" style="color: red;">
                        {{$message}}
                    </div>
                    @enderror
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
