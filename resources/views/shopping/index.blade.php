@extends('shopping.layout.master')
@section('title', 'Welcome to CM Boxing')
@section('content')
    
@include('shopping.layout.default_banner')  

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
     <div class="container">
       <section id="comp-offer">
      <div class="container-fluid">
          <h1 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Ticket</h1>
        <div class="row">

          @foreach($tickets as $ticket)
          <div class="col-md-4 col-sm-6 desc-comp-offer wow fadeInUp" data-wow-delay="0.4s">
            <div class="desc-comp-offer-cont">
              <div class="thumbnail-blogs">
                  <img src="shopping/img/ticket/{{ $ticket->img}}" class="img-fluid" alt="...">
              </div>
              <h3>{{ $ticket->name }}</h3>
             
                <div class="col-md-10">
                  <p>{{ number_format($ticket->price,0) }} ฿</p>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-general btn-white" role="button">Buy</button>
                </div>
          </div>
        </div>
        @endforeach

      </div>
    </section>
    <div class="paypal-button"></div>
    
</div>
  

 
  {{-- Sandbox account
    kanlowongsa20-facilitator@gmail.com
    Client ID : AQZbGQEf5otDqdSkMMnC0Sl4o0fBkWbWc-8lwLxJyqGrl1QSqVrHA1emHt_R4Z1KcfQFnLIOcFiA2_06
    
    Secret
      Hide
        ENH3llqOMone7VQwQydI6AstkzfyV2Bpg-UlJBYNGa1dcdMb3zLfnNrbohrtx6cv4QcdUBaH49H3RHkW

    ON LIVE
        Client ID: AU5el8asBKaUPXR9d5v1wekhjVBFqtbDfy0z0TX9IMhKoMbNkbhcKUngX-OHv1WFy0E_hXMWFaF9HBfH    
        Secret : EJNkImTYGJ22-d-l-50fz2GYoghqk65YDpXx-FNDYC7upCnq3jmC3vyPBuuvgkLQ7UlPvpEVRQlqRJ9F --}}

 

@endsection  
