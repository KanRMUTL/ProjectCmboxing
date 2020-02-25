@extends('shopping.layout.master')
@section('title', 'Welcome to CM Boxing')
@section('content')
<div class="container pb-5">
  <div class="row">
    <div class="col-md-12 pt-5 mt-5">
      <h1 class="wow fadeInUp text-center" style="visibility: visible; animation-name: fadeInUp;">
        Location
      </h1>
      <div class="heading-border"></div>
    </div>
      
    <div class="col-md-12">
      <div class="card map">
        <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3776.9180670916057!2d98.98038551538194!3d18.801804365418594!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30da3a93abd71e55%3A0x43c8fac502001a10!2sChiangmai+Boxing+Stadium!5e0!3m2!1sth!2sth!4v1558955967888!5m2!1sth!2sth"
                height="750"
                frameborder="0" style="border:0"
                allowfullscreen
          ></iframe>
      </div>
    </div>
  </div>
</div>
@endsection