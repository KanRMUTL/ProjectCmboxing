@extends('shopping.layout.master')
@section('title', 'Welcome to CM Boxing')
@section('content')
    
@include('shopping.layout.default_banner')  
<script src="https://www.paypal.com/sdk/js?client-id=AdeKmKTa4nB9aWe7oZbheexKhuDFwXkfJIwjf8qcbdVlek869ZnqJ34TvF-rUvJcjVSRcXh26ff7VdDk&currency=THB"></script>

<section class="about">     
<div class="container">
  <div class="row title-bar">
    <div class="col-md-12">
      <h1 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Welcome To Chiangmai Boxing Stadium</h1>
      <div class="heading-border"></div>
      <p class="wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
          {{ $webdetail->about }}
      </p>
      <div class="title-but"><button class="btn btn-general btn-green" role="button">Read More</button></div>
    </div>
  </div>
</div>
</section>
<!--====================================================
                         Ticket List
======================================================--> 
<div>
  <div id="vue" class="container">
          <section id="comp-offer">
            <div class="container-fluid">
              <h1 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Ticket</h1>
                <ticket><ticket>
            </div>
          </section>
  </div>  
</div>

@endsection  
