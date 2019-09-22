@extends('shopping.layout.master')
@section('title', 'Payment')
@section('content')

@include('shopping.layout.about_banner')

<!--====================================================
                         Single Ticket
======================================================-->
<div id="vue">
     <div class="container pb-5">
          <single-ticket :id="{{$id}}" :title="{{ Auth::user()->id }}" />
     </div>
     <section id="footer-s1" class="footer-s1">
          <web-footer />
     </section>
</div>

@endsection