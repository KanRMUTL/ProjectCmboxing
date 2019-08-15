@extends('shopping.layout.master')
@section('title', 'About')

@section('custom-css')
    <style>
      .img-fluid{ padding: 2%; }
    </style>
@endsection

@section('content')

@include('shopping.layout.about_banner')

<!--====================================================
                         About
======================================================-->
<div class="container">
  <section id="about" class="career-p1 about">
    <div class="container">
      <div class="row title-bar" style="padding: 2%;">
        <h1 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">About Me</h1>
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

  <section>
    <div class="row" id="media">
      <div class="row no-gutters">
        <div class="col-md-6 col-sm-6">
          <div class="img-wrapper">

            <img src="{{asset('shopping/img/ticket/ticket_grandstand.jpg')}}" class="img-fluid" alt="Work">

          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="img-wrapper">

            <img src="{{asset('shopping/img/ticket/ticket_grandstand.jpg')}}" class="img-fluid" alt="Work">

          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="img-wrapper">

            <img src="{{asset('shopping/img/ticket/ticket_grandstand.jpg')}}" class="img-fluid" alt="Work">

          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="img-wrapper">

            <img src="{{asset('shopping/img/ticket/ticket_grandstand.jpg')}}" class="img-fluid" alt="Work">

          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="img-wrapper">

            <img src="{{asset('shopping/img/ticket/ticket_grandstand.jpg')}}" class="img-fluid" alt="Work">

          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="img-wrapper">

            <img src="{{asset('shopping/img/ticket/ticket_grandstand.jpg')}}" class="img-fluid" alt="Work">

          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@include('shopping/layout/footer')

@endsection