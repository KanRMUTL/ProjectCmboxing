@extends('shopping.layout.master')
@section('title', 'Welcome to CM Boxing')
@section('content')

@include('shopping.layout.default_banner')

<section class="about">
  <div class="container">
    <div class="row title-bar" style="padding: 20px;">
      <div class="col-md-12">
        <h1 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
          Welcome To Chiangmai Boxing Stadium
          </h1>
        <div class="heading-border"></div>
        <p class="wow fadeInUp" data-wow-delay="0.4s"
          style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
          {{ $webdetail->about }}
        </p>
        <div class="title-but">
          <button class="btn btn-general btn-green" role="button">
            <a href="/about">Read More</a>
          </button>
        </div>
      </div>
    </div>
  </div>
</section>
<hr>
<!--====================================================
                         Ticket List
======================================================-->
<div>
  <div id="vue" class="container">
    <section id="comp-offer" style="padding: 20px;">
      <div class="container-fluid">
        <div class="row title-bar" style="padding: 0px;">
          <div class="col-md-12">
            <h1 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp; font-size: 200%;">
              Ticket
            </h1>
            <div class="heading-border"></div>
          </div>
        </div>
        <ticket>
        </ticket>
      </div>

      <div class="container-fluid">
        <div class="row title-bar" style="padding: 0px;">
          <div class="col-md-12">
            <h1 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp; font-size: 200%;">
               Daily Fight
            </h1>
            <div class="heading-border"></div>
          </div>
        </div>
        <fight-list></fight-list>
      </div>
    </section>
   
  </div>
</div>

@include('shopping/layout/footer')

@endsection