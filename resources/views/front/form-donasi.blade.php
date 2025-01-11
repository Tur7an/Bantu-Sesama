@extends('front.layouts.app')
@section('content')

<main class="main">

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{ route('home') }}#donasi">Home</a></li>
            <li class="current">Form Donasi</li>
          </ol>
        </div>
      </nav>

      <div class="container">
        <div class="row">
          <!-- Blog Details Section -->
          <div class="col-lg-6">
            <section id="blog-details" class="blog-details">
              <article class="article">
                <div class="post-img mb-3">
                  <img src="{{ asset('front/assets/img/blog/blog-1.jpg') }}" alt="Blog Image" class="img-fluid rounded">
                </div>

                <h2 class="title">Dolorum optio tempore voluptas dignissimos cumque fuga qui quibusdam quia</h2>

                <div class="meta-top d-flex flex-wrap align-items-center mb-4">
                  <ul class="list-inline mb-0">
                    <li class="list-inline-item me-3">
                      <i class="bi bi-person me-2"></i>
                      <a href="blog-details.html">John Doe</a>
                    </li>
                    <li class="list-inline-item me-3">
                      <i class="bi bi-clock me-2"></i>
                      <a href="blog-details.html"><time datetime="2022-01-01">Jan 1, 2022</time></a>
                    </li>
                    <li class="list-inline-item">
                      <i class="bi bi-chat-dots me-2"></i>
                      <a href="blog-details.html">12 Comments</a>
                    </li>
                  </ul>
                </div>

                <div class="content">
                  <p>
                    Similique neque nam consequuntur ad non maxime aliquam quas. Quibusdam animi praesentium. Aliquam et laboriosam eius aut nostrum quidem aliquid dicta.
                    Et eveniet enim. Qui velit est ea dolorem doloremque deleniti aperiam unde soluta. Est cum et quod quos aut ut et sit sunt. Voluptate porro consequatur assumenda perferendis dolore.
                  </p>
                </div>
              </article>
            </section>
          </div>
          <!-- End Blog Details Section -->

          <!-- Donation Form Section -->
          <div class="col-lg-6 sidebar">
            <div class="widgets-container">
              <h4 class="mb-3">Berdonasi</h4>
              <p class="mb-4">Silahkan isi form di bawah ini untuk melakukan donasi</p>

              <form action="donation-handler-url" method="POST">
                <div class="form-group mb-3">
                  <input name="name" type="text" class="form-control" placeholder="Nama*" required>
                </div>
                <div class="form-group mb-3">
                  <input name="amount" type="number" class="form-control" placeholder="Nominal Donasi" required>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Konfirmasi Donasi</button>
                </div>
              </form>
            </div>
          </div>
          <!-- End Donation Form Section -->
        </div>
      </div>

      </div>
    </div>

  </main>
