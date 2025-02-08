@extends('front.layouts.app')
@section('content')

<main class="main">
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8"><br><br>
                        <h1>Pantau Donasi</h1>
                        <p class="mb-0">Pantau Setiap Penyaluran Dana Donasi Pada Halaman Ini</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index.html">Beranda</a></li>
                    <li class="current">Pantau Donasi</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <section id="recent-posts" class="recent-posts section">
        <div class="container section-title" data-aos="fade-up"></div>

        <!-- Donasi Tersalurkan -->
        <div class="container">
            <div class="row gy-5">
                <h4><b>Tersalurkan</b></h4><hr>
                @foreach ($pantauDonasi as $pantau)
                    <div class="col-xl-4 col-md-6">
                        <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="100">
                            <div class="post-img position-relative overflow-hidden">
                                <img src="{{ url('admin/assets/images/kampanye') }}/{{ $pantau->foto }}" class="img-fluid" alt="">
                                <span class="post-date">Tersalurkan</span>
                            </div>
                            <div class="post-content d-flex flex-column">
                                <h3 class="post-title">{{ $pantau->nama }}</h3>
                                <p>Dana Terkumpul : Rp.{{ number_format($pantau->dana_terkumpul, 0, ',', '.') }}</p>
                                <hr>
                                <a href="{{ route('detail-pantau', ['id' => $pantau->id]) }}" class="readmore stretched-link"><span>Detail</span><i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End post item -->
                @endforeach
            </div>
        </div>

        <!-- Donasi Belum Tersalurkan -->
        <br><br><div class="container">
            <div class="row gy-5">
                <h4><b>Belum Tersalurkan</b></h4><hr>
                @foreach ($kampanyeNonaktif as $kampanye)
                    <div class="col-xl-4 col-md-6">
                        <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="100">
                            <div class="post-img position-relative overflow-hidden">
                                <img src="{{ url('admin/assets/images/kampanye') }}/{{ $kampanye->foto }}" class="img-fluid" alt="">
                                <span class="post-date">Belum Tersalurkan</span>
                            </div>
                            <div class="post-content d-flex flex-column">
                                <h3 class="post-title">{{ $kampanye->nama }}</h3>
                                <li class="list-inline-item">
                                    <span><b>Terkumpul:</b> Rp.{{ number_format($kampanye->dana_terkumpul, 0, ',', '.') }}</span>
                                    <span><b>Dari:</b> Rp.{{ number_format($kampanye->batas_nominal, 0, ',', '.') }}</span>
                                    <div class="progress" style="height: 15px;">
                                        @php
                                        $percentage = ($kampanye->dana_terkumpul / $kampanye->batas_nominal) * 100;
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
                            </div>
                        </div>
                    </div><!-- End post item -->
                @endforeach
            </div>
        </div>
    </section><!-- /Recent Posts Section -->
</main>
@endsection
