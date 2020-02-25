@extends('shopping.layout.master')
@section('title', 'Welcome to CM Boxing')

@section('content')

@include('shopping.layout.default_banner')

<div id="vue">
    <div class="container pt-5">
        @if(Auth::check())
            <courses-index id="{{ Auth::user()->id }}"></courses-index>
        @else
            <courses-index id="0"></courses-index>
        @endif
    </div>    
    
    <section id="footer-s1" class="footer-s1">
        <web-footer />
    </section>
</div>
    @endsection