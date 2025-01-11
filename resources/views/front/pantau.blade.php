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

    <div class="container">
      <div class="row">

        <div class="col-lg-12">

              <!-- Recent Posts Section -->
    <section id="recent-posts" class="recent-posts section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-5">

          <div class="col-xl-4 col-md-6">
            <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="100">

              <div class="post-img position-relative overflow-hidden">
                <img src="{{asset('front')}}/assets/img/blog/blog-1.jpg" class="img-fluid" alt="">
                <span class="post-date">December 12</span>
              </div>

              <div class="post-content d-flex flex-column">

                <h3 class="post-title">Eum ad dolor et. Autem aut fugiat debitis</h3>

                <div class="meta d-flex align-items-center">
                </div>

                <hr>

                <a href="{{ route('detail-pantau') }}" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>

              </div>

            </div>
          </div><!-- End post item -->

          <div class="col-xl-4 col-md-6">
            <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="200">

              <div class="post-img position-relative overflow-hidden">
                <img src="{{asset('front')}}/assets/img/blog/blog-2.jpg" class="img-fluid" alt="">
                <span class="post-date">July 17</span>
              </div>

              <div class="post-content d-flex flex-column">

                <h3 class="post-title">Et repellendus molestiae qui est sed omnis</h3>

                <div class="meta d-flex align-items-center">
                </div>

                <hr>

                <a href="{{ route('detail-pantau') }}" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>

              </div>

            </div>
          </div><!-- End post item -->

          <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="post-item position-relative h-100">

              <div class="post-img position-relative overflow-hidden">
                <img src="{{asset('front')}}/assets/img/blog/blog-3.jpg" class="img-fluid" alt="">
                <span class="post-date">September 05</span>
              </div>

              <div class="post-content d-flex flex-column">

                <h3 class="post-title">Quia assumenda est et veritati tirana ploder</h3>

                <div class="meta d-flex align-items-center">
                </div>

                <hr>

                <a href="{{ route('detail-pantau') }}" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>

              </div>

            </div>
          </div><!-- End post item -->

        </div>

      </div>

    </section><!-- /Recent Posts Section -->

            </div>

          </section><!-- /Blog Posts Section -->

          <!-- Blog Pagination Section -->
          <section id="blog-pagination" class="blog-pagination section">

            <div class="container">
              <div class="d-flex justify-content-center">
                <ul>
                  <li><a href="#"><i class="bi bi-chevron-left"></i></a></li>
                  <li><a href="#">1</a></li>
                  <li><a href="#" class="active">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li>...</li>
                  <li><a href="#">10</a></li>
                  <li><a href="#"><i class="bi bi-chevron-right"></i></a></li>
                </ul>
              </div>
            </div>

          </section><!-- /Blog Pagination Section -->

        </div>

          </div>

        </div>

      </div>
    </div>

  </main>

