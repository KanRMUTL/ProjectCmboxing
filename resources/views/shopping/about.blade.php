@extends('shopping.layout.master')
@section('title', 'About')

@section('custom-css')
<style>
  .img-fluid {
    padding: 2%;
  }
</style>
@endsection

@section('content')

@include('shopping.layout.default_banner')

<!--====================================================
                         About
======================================================-->
<div class="container">
  <section id="about" class="career-p1 about">
    <div class="row justify-content-center pt-3">
      <div class="col-md-12 heading-section ftco-animate text-center fadeInUp ftco-animated">
        <h2 class="mb-4">About Us</h2>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="career-p1-himg">
            <img src="shopping/img/image-2.jpg" class="img-fluid wow fadeInUp" data-wow-delay="0.1s" alt=""
              style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
          </div>
        </div>
        <div class="col-md-6">
          <div class="career-p1-desc">
            <p>{{ $webdetail->about }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  @include('shopping/components/history')

  <section>
    <div class="row" id="media">
        <div class="col-md-6 col-sm-6">
          <div class="img-wrapper">
            <a href="shopping/img/ticket/ticket_grandstand.jpg" class="gallery img d-flex align-items-center"
              style="background-image: url(shopping/img/ticket/ticket_grandstand.jpg);" data-lightbox="example-2">
              <div class="icon mb-4 d-flex align-items-center justify-content-center">
                <span class="icon-search"></span>
              </div>
            </a>
          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="img-wrapper">
            <a href="shopping/img/ticket/ticket_ringside.jpg" class="gallery img d-flex align-items-center"
              style="background-image: url(shopping/img/ticket/ticket_ringside.jpg);" data-lightbox="example-2">
              <div class="icon mb-4 d-flex align-items-center justify-content-center">
                <span class="icon-search"></span>
              </div>
            </a>
          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="img-wrapper">
            <a href="shopping/img/about/67249058_474733233324867_6021814512888315904_o.jpg"
              class="gallery img d-flex align-items-center"
              style="background-image: url(shopping/img/about/67249058_474733233324867_6021814512888315904_o.jpg);"
              data-lightbox="example-2">
              <div class="icon mb-4 d-flex align-items-center justify-content-center">
                <span class="icon-search"></span>
              </div>
            </a>
          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="img-wrapper">
            <a href="shopping/img/about/67506406_474733356658188_6018593158567297024_o.jpg"
              class="gallery img d-flex align-items-center"
              style="background-image: url(shopping/img/about/67506406_474733356658188_6018593158567297024_o.jpg);"
              data-lightbox="example-2">
              <div class="icon mb-4 d-flex align-items-center justify-content-center">
                <span class="icon-search"></span>
              </div>
            </a>
          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="img-wrapper">
            <a href="shopping/img/about/67522636_474733376658186_7376900888327094272_o.jpg"
              class="gallery img d-flex align-items-center"
              style="background-image: url(shopping/img/about/67522636_474733376658186_7376900888327094272_o.jpg);"
              data-lightbox="example-2">
              <div class="icon mb-4 d-flex align-items-center justify-content-center">
                <span class="icon-search"></span>
              </div>
            </a>
          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="img-wrapper">
            <a href="shopping/img/about/67272601_472475853550605_8374041884703588352_o.jpg"
              class="gallery img d-flex align-items-center"
              style="background-image: url(shopping/img/about/67272601_472475853550605_8374041884703588352_o.jpg);"
              data-lightbox="example-2">
              <div class="icon mb-4 d-flex align-items-center justify-content-center">
                <span class="icon-search"></span>
              </div>
            </a>
          </div>
        </div>
      </div>
  </section>
</div>

@include('shopping/layout/footer')

@endsection