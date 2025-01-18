@extends('front.layouts.app')
@section('content')


<main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1 data-aos="fade-up">Bantu Sesama Dengan Mudah</h1>
            <p data-aos="fade-up" data-aos-delay="100">Platform Donasi Online</p>
            <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
              <a href="#donasi" class="btn-get-started">Mulai Donasi<i class="bi bi-arrow-down"></i></a>
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
            <div id="donationCampaignCarousel" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="2000">
                  <img src="{{asset('front')}}/assets/img/hero-img.png" class="d-block w-100 img-fluid" alt="Donation Campaign 1">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                  <img src="{{asset('front')}}/assets/img/hero-img.png" class="d-block w-100 img-fluid" alt="Donation Campaign 2">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                  <img src="{{asset('front')}}/assets/img/hero-img.png" class="d-block w-100 img-fluid" alt="Donation Campaign 3">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#donationCampaignCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#donationCampaignCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>

        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- Values Section -->
    <section id="donasi" class="values section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Kampanye Donasi</h2>
        <p>Pilih Donasi dan Mulai Berbagi.<br></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card">
              <img src="{{asset('front')}}/assets/img/values-1.png" class="img-fluid" alt="">
              <h3>Lorem, ipsum dolor.</h3>
              <p>----------------------------------------------------------------------</p>
              <a class="btn btn-primary" href="{{ route('form-donasi') }}">Mulai Donasi</a>
            </div>
          </div><!-- End Card Item -->

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card">
              <img src="{{asset('front')}}/assets/img/values-2.png" class="img-fluid" alt="">
              <h3>Voluptatem voluptatum alias</h3>
              <p>----------------------------------------------------------------------</p>
              <a class="btn btn-primary" href="{{ route('form-donasi') }}">Mulai Donasi</a>
            </div>
          </div><!-- End Card Item -->

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="card">
              <img src="{{asset('front')}}/assets/img/values-3.png" class="img-fluid" alt="">
              <h3>Fugit cupiditate alias nobis.</h3>
              <p>----------------------------------------------------------------------</p>
              <a class="btn btn-primary" href="{{ route('form-donasi') }}">Mulai Donasi</a>
            </div>
          </div><!-- End Card Item -->

        </div>

      </div>

    </section><!-- /Values Section -->

    <!-- Contact Section -->
    <section id="kontak" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <p>Informasi Kontak</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-6">

            <div class="row gy-4">
              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="200">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Alamat</h3>
                  <p>Kota Bengkulu</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="300">
                  <i class="bi bi-telephone"></i>
                  <h3>No. Telp</h3>
                  <p>+62 812 3456 7890</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="400">
                  <i class="bi bi-envelope"></i>
                  <h3>Email</h3>
                  <p>bantusesama@example.com</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="500">
                  <i class="bi bi-clock"></i>
                  <h3>Jam Kerja</h3>
                  <p>Senin - Jumat</p>
                  <p>9:00 WIB - 16:00 WIB</p>
                </div>
              </div><!-- End Info Item -->

            </div>

          </div>

          <div class="col-lg-6">
            <form id="whatsapp-form" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-12">
                  <input type="text" id="name" class="form-control" placeholder="Nama" required>
                </div>

                <div class="col-12">
                  <textarea id="message" class="form-control" rows="6" placeholder="Pesan" required></textarea>
                </div>

                <div class="col-12 text-center">
                  <button type="button" class="btn btn-outline-primary" onclick="sendWhatsApp()">Kirim Pesan</button>
                </div>

              </div>
            </form>
          </div>

          <!-- SweetAlert Library -->
          <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

          <script>
            function sendWhatsApp() {
              const name = document.getElementById("name").value.trim();
              const message = document.getElementById("message").value.trim();

              if (!name || !message) {
                // Jika salah satu kolom kosong, tampilkan SweetAlert
                Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: "Harap isi semua kolom sebelum mengirim pesan.",
                });
                return;
              }

              // Jika semua kolom terisi
              const phoneNumber = "628123456789"; // Ganti dengan nomor WhatsApp tujuan
              const url = `https://wa.me/${phoneNumber}?text=Halo, nama saya ${encodeURIComponent(name)}.%0A${encodeURIComponent(message)}`;
              Swal.fire({
                icon: "success",
                title: "Pesan terkirim!",
                text: "Mengalihkan ke WhatsApp...",
                showConfirmButton: false,
                timer: 2000, // Menutup otomatis setelah 2 detik
              }).then(() => {
                window.open(url, "_blank");
              });
            }
          </script>


          <div class="col-md-12">
            <div class="info-item" data-aos="fade" data-aos-delay="500">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127389.73494565331!2d102.30457874999999!3d-3.8253459!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e36b01e37e39279%3A0xa079b576e790a6ea!2sBengkulu%2C%20Kota%20Bengkulu%2C%20Bengkulu!5e0!3m2!1sid!2sid!4v1736530738606!5m2!1sid!2sid"
                width="100%"
                height="350"
                style="border:0;"
                allowfullscreen=""
                loading="lazy">
              </iframe>
            </div>
          </div><!-- End Info Item -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>
