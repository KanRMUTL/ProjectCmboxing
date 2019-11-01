@extends('shopping.layout.master')
@section('title', 'Welcome to CM Boxing')
@section('content')

@include('shopping.layout.default_banner')
<div id="vue">

  <section class="ftco-about d-md-flex">
    <div class="one-half img" style="background-image: url(shopping/img/about/about1.jpg);"></div>
    <div class="one-half">
      <div class="heading-section">
        <h3 class="mb-4"> Welcome To <span>Chiangmai Boxing Stadium</span></h3>
      </div>
      <div>
        <p>{{ $webdetail->about }}</p>
      </div>
    </div>
  </section>

  <!--====================================================
                         Ticket List
======================================================-->
  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center pb-3">
        <div class="col-md-7 heading-section ftco-animate text-center fadeInUp ftco-animated">
          <h2 class="mb-4">Tickets</h2>
        </div>
      </div>
      <div class="row">
        @foreach ($tickets as $ticket)
        <div class="col-md-6 col-lg-4">
          <div class="package-program ftco-animate fadeInUp ftco-animated">
            <div class="img" style="background-image: url(/shopping/img/ticket/{{ $ticket->img }});"></div>
            <div class="text mt-4">
              <h3>{{ $ticket->name }}</h3>
              <div class="d-flex mt-4">
                <p class="price"><sup>฿</sup>{{ $ticket->price}}<sub></sub></p>
                <p class="btn-custom float-right"><a href="/saleticket/{{ $ticket->id }}">Buy Now</a></p>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!--====================================================
                         Fight List
======================================================-->
  <section class="ftco-gallery">
    <div class="row justify-content-center pb-3">
      <div class="col-md-7 heading-section ftco-animate text-center fadeInUp ftco-animated">
        <h2 class="mb-4">Daily Fights</h2>
      </div>
    </div>
    <div class="container-wrap">
      <div class="row no-gutters">
        @foreach ($fights as $fight)
        <div class="col-md-3 ftco-animate fadeInUp ftco-animated">
          <div class="card-body text-center"
            style="background-color:#f1b81e; padding-top: 11px; padding-bottom: 9px; color: #fff">
            <i class="icon-calendar"></i>
            <h5 class="card-title" style="color: #fff; font-size: 1.2em;">
              {{ date_format(date_create($fight->day), 'd/m/Y') }}</h5>
          </div>
          <a href="shopping/img/fight/{{ $fight->img }}" class="gallery img d-flex align-items-center"
            style="background-image: url(shopping/img/fight/{{ $fight->img }});" data-lightbox="example-2">
            <div class="icon mb-4 d-flex align-items-center justify-content-center">
              <span class="icon-search"></span>
            </div>
          </a>
          <a href="shopping/img/fight/{{ $fight->img }}" data-lightbox="roadtrip"></a>
        </div>
        @endforeach
      </div>
    </div>
    <div class="row justify-content-md-center pt-3">
      {{ $fights->links() }}
    </div>
  </section>
  
 


@include('shopping/components/history')


<web-footer />

</div>
@endsection