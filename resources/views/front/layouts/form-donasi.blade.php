@extends('front.layouts.app')
@section('content')

<script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script>

@foreach ($kampanye as $k)
<main class="main">
    <div class="page-title">
        <div class="heading">
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ route('beranda') }}#donasi">Home</a></li>
                        <li class="current">Form Donasi</li>
                    </ol>
                </div>
            </nav>
        </div>
        <div class="container">
            <div class="row">
                <!-- Card Detail Donasi -->
                <div class="col-lg-6">
                    <section id="blog-details" class="blog-details">
                        <article class="article">
                            <div class="post-img mb-3">
                                <img src="{{ url('admin/assets/images/kampanye') }}/{{ $k->foto }}" alt="Donasi" class="img-fluid rounded d-block mx-auto">
                            </div>
                            <h4><b>{{ $k->nama }}</b></h4>
                            <h6>{{ $k->deskripsi }}</h6>
                            <div class="d-flex flex-wrap align-items-center mb-4">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item me-3">
                                        @php
                                        $now = \Carbon\Carbon::now(); // Waktu saat ini
                                        $targetDate = \Carbon\Carbon::parse($k->batas_tanggal); // Tanggal batas dari database
                                        $daysLeft = $now->lessThan($targetDate) ? round($now->diffInDays($targetDate), 0) : 0; // Hitung sisa hari dan bulatkan
                                        @endphp
                                            <p><i class="bi bi-clock me-2"></i><b>Waktu Tersisa:</b>
                                                {{ $daysLeft > 0 ? $daysLeft . ' hari lagi' : 'Waktu habis' }}
                                            </p>
                                    </li><br>
                                    <li class="list-inline-item">
                                        <span><b>Terkumpul:</b> Rp.{{ number_format($k->dana_terkumpul, 0, ',', '.') }}</span>
                                        <span><b>Dari:</b> Rp.{{ number_format($k->batas_nominal, 0, ',', '.') }}</span>
                                        <div class="progress" style="height: 15px;">
                                            @php
                                            $percentage = ($k->dana_terkumpul / $k->batas_nominal) * 100;
                                            @endphp
                                            <div class="progress-bar bg-primary" role="progressbar"
                                                style="width: {{ $percentage > 100 ? 100 : $percentage }}%;"
                                                aria-valuenow="{{ $percentage }}"
                                                aria-valuemin="0"
                                                aria-valuemax="100">
                                                {{ round($percentage, 2) }}%
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </article>
                    </section>
                </div>
                <!-- End Card Detail Donasi -->

                <!-- Form Donasi -->
                <div class="col-lg-6 sidebar">
                    <div class="widgets-container">
                        <h4 class="mb-3">Berdonasi</h4>
                        <p class="mb-4">Silahkan isi form di bawah ini untuk melakukan donasi</p>

                        <form id="donasiForm">
                            @csrf
                            <input type="hidden" name="kampanye_id" value="{{ $kampanye->first()->id }}">

                            <!-- Nama Donatur -->
                            <div class="form-group mb-3">
                                <label for="nama">Nama Donatur</label>
                                <input id="nama" name="nama_donatur" type="text" class="form-control"
                                    placeholder="Nama (Sembunyikan Nama Dengan 'Orang Baik')" required>
                                <div class="mt-2">
                                    <button type="button" class="btn btn-outline-dark m-1 btn-sm" onclick="fillName('Orang Baik')">Orang Baik</button>
                                </div>
                            </div>

                            <!-- Nominal Donasi -->
                            <div class="form-group mb-3">
                                <label for="nominal">Nominal Donasi</label>
                                <input id="nominal" name="nominal_donasi" type="number" class="form-control"
                                    placeholder="Pilih atau isi nominal donasi" required>
                                <div class="mt-2">
                                    <button type="button" class="btn btn-outline-success m-1 btn-sm" onclick="fillAmount(10000)">Rp 10.000</button>
                                    <button type="button" class="btn btn-outline-success m-1 btn-sm" onclick="fillAmount(20000)">Rp 20.000</button>
                                    <button type="button" class="btn btn-outline-success m-1 btn-sm" onclick="fillAmount(50000)">Rp 50.000</button>
                                    <button type="button" class="btn btn-outline-success m-1 btn-sm" onclick="fillAmount(100000)">Rp 100.000</button>
                                </div>
                            </div>

                            <!-- Tombol Submit -->
                            <br>
                            <div class="text-center">
                                <button type="button" id="pay-button" class="btn btn-primary">Konfirmasi Donasi</button>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- End Form Donasi -->
                <!-- Pop-up Midtrans -->
                <script type="text/javascript">
                    document.getElementById('pay-button').addEventListener('click', function (event) {
                        event.preventDefault();
                        let formData = new FormData(document.getElementById('donasiForm'));
                        fetch("{{ route('donasi.store') }}", {
                            method: "POST",
                            body: formData,
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.snap_token) {
                                window.snap.pay(data.snap_token, {
                                    onSuccess: function(result) {
                                        alert("Pembayaran berhasil!");
                                        console.log(result);
                                        location.reload();
                                    },
                                    onPending: function(result) {
                                        alert("Menunggu pembayaran!");
                                        console.log(result);
                                    },
                                    onError: function(result) {
                                        alert("Pembayaran gagal!");
                                        console.log(result);
                                    },
                                    onClose: function() {
                                        alert("Anda menutup pop-up tanpa menyelesaikan pembayaran.");
                                    }
                                });
                            } else {
                                alert("Terjadi kesalahan: " + data.message);
                                console.error(data);
                            }
                        })
                        .catch(error => {
                            console.error("Error:", error);
                            alert("Terjadi kesalahan pada server.");
                        });
                    });
                    </script>
                            </div>
                        </div>
                    </div>
                </main>
                @endforeach
                <script>
                    function fillName(nama) {
                        document.getElementById('nama').value = nama;
                    }
                    function fillAmount(amount) {
                        document.getElementById('nominal').value = amount;
                    }
                </script>
@endsection
