@extends('admin.layouts.app')
@section('content')

@foreach ($kampanye as $k)


<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <!-- Link Font Awesome -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />

            <div class="container">
                <div class="row">
                    <!-- Column 1: Project Info -->
                    <div class="col-lg-5 col-md-6 col-12 mb-4">
                        <div class="project-info-box mt-0">
                            <h1><b>{{$k->nama}}</b></h1>
                            <p class="mb-0 text-muted">
                                {{$k->deskripsi}}
                            </p>
                        </div>
                        <br>
                        <div class="project-info-box">
                            <div class="project-info-box">
                                <p><b>Waktu Tersisa:</b> <span id="countdown"></span></p>
                            </div>

                            <script>
                                // Tanggal batas diambil langsung dari server-side Blade ke JavaScript
                                const targetDate = new Date("{{ $k->batas_tanggal }}").getTime();

                                // Perbarui hitung mundur setiap hari (tidak perlu interval detik)
                                const updateCountdown = () => {
                                    const now = new Date().getTime();
                                    const distance = targetDate - now;

                                    // Hitung hari tersisa
                                    const days = Math.ceil(distance / (1000 * 60 * 60 * 24)); // Dibulatkan ke atas

                                    // Tampilkan hasil
                                    if (distance > 0) {
                                        document.getElementById('countdown').innerText = `${days} hari lagi`;
                                    } else {
                                        document.getElementById('countdown').innerText = "Waktu habis";
                                    }
                                };

                                // Jalankan fungsi saat halaman dimuat
                                updateCountdown();

                                // Perbarui setiap hari pada tengah malam
                                setInterval(updateCountdown, 1000 * 60 * 60 * 24);
                            </script>
                            <div class="project-info-box">
                                <div class="d-flex justify-content-between mb-1">
                                    <span><b>Terkumpul:</b> Rp{{ number_format($k->dana_terkumpul, 0, ',', '.') }} <b>Dari:</b> Rp{{ number_format($k->batas_nominal, 0, ',', '.') }} </span>
                                </div>
                                <div class="progress" style="height: 20px;">
                                    @php
                                        $percentage = ($k->dana_terkumpul / $k->batas_nominal) * 100;
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

                    <!-- Column 2: Project Image and Details -->
                    <div class="col-lg-7 col-md-6 col-12">
                        <img src="{{url('admin/assets/images/kampanye')}}/{{$k->foto}}"
                        alt="foto-kampanye" class="img-fluid rounded mb-3">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endforeach

@endsection
