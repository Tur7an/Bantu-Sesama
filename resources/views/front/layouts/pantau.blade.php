@extends('front.layouts.app')
@section('content')

<main class="main">

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <br>
              <h1>Pantau Donasi</h1>
              <p class="mb-0">Pantau Setiap Penyaluran Dana Donasi Pada Halaman Ini</p>
              <div class="col-lg-12 text-center mb-4">
                <div class="d-flex align-items-center justify-content-center gap-3">
                  <label class="switch">
                    <input type="checkbox" id="toggleSwitch" checked>
                    <span class="slider"></span>
                  </label>
                  <p id="switchLabel" class="mb-0">Tersalurkan</p>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li class="current">Pantau Donasi</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <section id="recent-posts" class="recent-posts section">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
      </div>

      {{-- Donasi Tersalurkan --}}
      <div class="container" id="tersalurkanDiv">
        <div class="row gy-5">
            <h2>Tersalurkan</h2>
            @foreach ($pantauDonasi  as $pantau)
              <div class="col-xl-4 col-md-6">
                <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="100">
                  <div class="post-img position-relative overflow-hidden">
                    <img src="{{ url('admin/assets/images/kampanye') }}/{{ $pantau->foto }}" class="img-fluid" alt="">
                    <span class="post-date">Sudah Tersalurkan</span>
                  </div>

                  <div class="post-content d-flex flex-column">
                    <h3 class="post-title">{{ $pantau->nama }}</h3>
                    <hr>
                    <a href="{{ route('detail-pantau') }}" class="readmore stretched-link"><span>Detail</span><i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>
              </div><!-- End post item -->
            @endforeach
        </div>
      </div>

      {{-- Donasi Belum Tersalurkan --}}
      <div class="container" id="belumTersalurkanDiv" style="display: none;">
        <div class="row gy-5">
            <h2>Belum Tersalurkan</h2>
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
                    <hr>
                    <a href="{{ route('detail-pantau') }}" class="readmore stretched-link"><span>Detail</span><i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>
              </div><!-- End post item -->
            @endforeach
        </div>
      </div>

    </section><!-- /Recent Posts Section -->

</main>

<style>
    .d-flex {
      margin-top: 1rem;
    }

    .gap-3 {
      gap: 1rem;
    }

    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      transition: 0.4s;
      border-radius: 34px;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      border-radius: 50%;
      left: 4px;
      bottom: 4px;
      background-color: white;
      transition: 0.4s;
    }

    input:checked + .slider {
      background-color: #4CAF50;
    }

    input:checked + .slider:before {
      transform: translateX(26px);
    }

    #switchLabel {
      font-size: 1rem;
      font-weight: 500;
    }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toggleSwitch = document.getElementById('toggleSwitch');
    const tersalurkanDiv = document.getElementById('tersalurkanDiv');
    const belumTersalurkanDiv = document.getElementById('belumTersalurkanDiv');
    const switchLabel = document.getElementById('switchLabel');

    toggleSwitch.addEventListener('change', function() {
      if (toggleSwitch.checked) {
        tersalurkanDiv.style.display = 'block';
        belumTersalurkanDiv.style.display = 'none';
        switchLabel.textContent = 'Tersalurkan';
      } else {
        belumTersalurkanDiv.style.display = 'block';
        tersalurkanDiv.style.display = 'none';
        switchLabel.textContent = 'Belum Tersalurkan';
      }
    });

    if (toggleSwitch.checked) {
      tersalurkanDiv.style.display = 'block';
      belumTersalurkanDiv.style.display = 'none';
    } else {
      tersalurkanDiv.style.display = 'none';
      belumTersalurkanDiv.style.display = 'block';
    }
  });
</script>
@endsection
