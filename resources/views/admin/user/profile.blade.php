@extends('admin.layouts.app')
@section('content')
<div class="container-xl px-4 mt-4">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Foto Profil</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2" src="{{asset('storage/fotos/'.$user->foto)}}" alt="" style="width: 200px; height: 200px; object-fit: cover; border-radius: 10px;">

                    <!-- Profile picture help block-->
                    <h1>{{$user->name}}</h1>
                    <p>{{$user->email}}</p>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Detail Akun</div>
                <div class="card-body">
                    <form method="POST" action="{{url('admin/profile/' .$user->id)}}" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Nama Pengguna</label>
                            <input class="form-control @error('name') is-invalid @enderror" id="inputUsername" type="text" name="name" value="{{$user->name}}" required_autocomplete="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" id="inputEmailAddress" type="email" name="email" placeholder="Enter your email address" value="{{$user->email}}" required_autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Form Group (old password)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputOldPassword">Kata Sandi Lama</label>
                            <input class="form-control @error('old_password') is-invalid @enderror" id="inputOldPassword" type="password" name="old_password">
                            @error('old_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Form Group (new password)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputPassword">Kata Sandi Baru</label>
                            <input class="form-control @error('password') is-invalid @enderror" id="inputPassword" type="password" name="password" placeholder="Isi jika mengganti kata sandi">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Form Group (password confirmation)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputKonfirmasiPassword">Konfirmasi Kata Sandi</label>
                            <input class="form-control" name="password_confirmation" id="inputKonfirmasiPassword" type="password">
                        </div>

                        <!-- Form Group (profile photo)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputFoto">Foto Profil</label>
                            <input class="form-control" name="foto" id="inputFoto" type="file" value="$user->foto">
                        </div>

                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
