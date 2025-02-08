@extends('front.layouts.app')
@section('content')

<main class="main">
    <div class="page-title">
      <div class="heading">
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{ route('beranda') }}">Beranda</a></li>
            <li><a href="{{ route('pantau') }}">Pantau Donasi</a></li>
            <li class="current">Detail Pantau Donasi</li>
          </ol>
        </div>
      </nav>
    </div>
    <!-- Detail Pantau Section -->
    <section id="portfolio-details" class="portfolio-details section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper init-swiper">
              <script type="application/json" class="swiper-config">
                {
                  "loop": true,
                  "speed": 600,
                  "autoplay": {
                    "delay": 5000
                  },
                  "slidesPerView": "auto",
                  "pagination": {
                    "el": ".swiper-pagination",
                    "type": "bullets",
                    "clickable": true
                  }
                }
              </script>
              <div class="swiper-wrapper align-items-center">
                <div class="swiper-slide">
                  <img src="{{ url('admin/assets/images/pantauDonasi') }}/{{ $pantauDonasi->foto_penyaluran }}" alt="Foto Penyaluran">
                </div>
              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">
              <h3>Informasi Penyaluran Donasi</h3>
              <ul>
                <li><strong>Kampanye</strong>: {{ $pantauDonasi->kampanye_nama }}</li>
                <li><strong>Tanggal Penyaluran</strong>: {{$pantauDonasi->tgl_penyaluran}}</li>
                <li><strong>Dana Terkumpul</strong>: Rp. {{ number_format($pantauDonasi->dana_terkumpul, 0, ',', '.') }}</li>
                <li><strong>Deskripsi</strong>: <br>{{ $pantauDonasi->deskripsi }}</li>
              </ul>
            </div>
        </div>
      </div>
    </section><!-- /Detail Pantau Details Section -->
  </main>
@endsection
