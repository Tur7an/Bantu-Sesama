@extends('front.layouts.app')
@section('content')


<main class="main">
    <!-- Beranda Section -->
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
            <div id="donationCampaignCarousel" class="carousel slide shadow-lg rounded-4" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($pantauDonasi as $key => $donasi)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" data-bs-interval="3000">
                            <img src="{{ asset('admin/assets/images/pantauDonasi/' . $donasi->foto_penyaluran) }}"
                                 class="d-block w-100 img-fluid rounded-4"
                                 style="height: 350px; object-fit: cover; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);"
                                 alt="Donation Campaign {{ $key + 1 }}">
                        </div>
                    @endforeach
                </div>

                <!-- Tombol Navigasi -->
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

    </section><!-- /Beranda Section -->

    <!-- Donasi Section -->
<section id="donasi" class="values section">
  <div class="container section-title" data-aos="fade-up">
      <h2>Kampanye Donasi</h2>
      <p>Pilih Donasi dan Mulai Berbagi.<br></p>
  </div>
  <div class="container">
      <div class="row gy-4">
          @foreach ($kampanye as $k)
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
              <div class="card position-relative">
                  <button class="btn btn-outline-primary position-absolute top-0 end-0 m-2"
                      data-bs-toggle="modal"
                      data-bs-target="#copyLinkModal"
                      data-id="{{ $k->id }}"
                      data-link="{{ url('form-donasi/'.$k->id) }}">
                      <i class="bi bi-share"></i>
                  </button>
                  <img src="{{ url('admin/assets/images/kampanye') }}/{{ $k->foto }}" class="img-fluid" alt="foto-kampanye">
                  <h5 class="mt-3"><b>{{ $k->nama }}</b></h5>
                  @php
                      $now = \Carbon\Carbon::now();
                      $targetDate = \Carbon\Carbon::parse($k->batas_tanggal);
                      $daysLeft = $now->lessThan($targetDate) ? round($now->diffInDays($targetDate), 0) : 0;
                  @endphp
                  <p><b>Waktu Tersisa:</b> {{ $daysLeft > 0 ? $daysLeft . ' hari lagi' : 'Waktu habis' }}</p>
                  <div class="mb-2">
                      <span><b>Terkumpul:</b> Rp.{{ number_format($k->dana_terkumpul, 0, ',', '.') }}</span>
                      <span><b>Dari:</b> Rp.{{ number_format($k->batas_nominal, 0, ',', '.') }}</span>
                  </div>
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
                  <a class="btn btn-outline-primary m-1" href="{{url('form-donasi/'.$k->id)}}">Mulai Donasi</a>
              </div>
          </div>
          @endforeach
      </div>
  </div>

  <!-- Modal Salin Link Kampanye -->
  <div class="modal fade" id="copyLinkModal" tabindex="-1" aria-labelledby="copyLinkModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="copyLinkModalLabel">Bagikan Kampanye</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="input-group">
                      <input type="text" class="form-control" id="campaignLink" value="" readonly>
                      <button class="btn btn-outline-primary" id="copyButton">Salin</button>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <script>
      document.addEventListener("DOMContentLoaded", function () {
          // Saat modal dibuka, ambil ID kampanye dan update input
          var copyLinkModal = document.getElementById('copyLinkModal');
          copyLinkModal.addEventListener('show.bs.modal', function (event) {
              var button = event.relatedTarget; // Tombol yang men-trigger modal
              var campaignLink = button.getAttribute('data-link'); // Ambil link dari data-link

              // Set nilai input dengan URL kampanye
              document.getElementById('campaignLink').value = campaignLink;
          });

          // Tombol Salin
          document.getElementById('copyButton').addEventListener('click', function () {
              var copyText = document.getElementById('campaignLink');
              copyText.select();
              copyText.setSelectionRange(0, 99999); // Untuk kompatibilitas dengan mobile
              document.execCommand("copy");

              // Alert sukses
              alert('Berhasil disalin, Bagikan Kampanye Donasi di Sosial Media Anda.');

              // Tutup modal setelah menyalin
              var modalInstance = bootstrap.Modal.getInstance(copyLinkModal);
              modalInstance.hide();
          });
      });
  </script>
</section> <!-- End Section Donasi -->


    <!-- Kontak Section -->
    <section id="kontak" class="contact section">
      <div class="container section-title" data-aos="fade-up">
        <p>Informasi Kontak</p>
      </div>
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
              </div>
              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="300">
                  <i class="bi bi-telephone"></i>
                  <h3>No. Telp</h3>
                  <p>+62 812 3456 7890</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="400">
                  <i class="bi bi-envelope"></i>
                  <h3>Email</h3>
                  <p>bantusesama@example.com</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="500">
                  <i class="bi bi-clock"></i>
                  <h3>Jam Kerja</h3>
                  <p>Senin - Jumat</p>
                  <p>9:00 WIB - 16:00 WIB</p>
                </div>
              </div>
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

          <!-- SweetAlert Form Pesan -->
          <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
          <script>
            function sendWhatsApp() {
              const name = document.getElementById("name").value.trim();
              const message = document.getElementById("message").value.trim();
              if (!name || !message) {
                Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: "Harap isi semua kolom sebelum mengirim pesan.",
                });
                return;
              }
              const phoneNumber = "6281279715551";
              const url = `https://wa.me/${phoneNumber}?text=Halo, nama saya ${encodeURIComponent(name)}.%0A${encodeURIComponent(message)}`;
              Swal.fire({
                icon: "success",
                title: "Pesan terkirim!",
                text: "Mengalihkan ke WhatsApp...",
                showConfirmButton: false,
                timer: 2000,
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
          </div>
        </div>
      </div>
    </section><!-- /Kontak Section -->
  </main>
