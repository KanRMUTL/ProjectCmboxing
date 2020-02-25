@extends('shopping.layout.master')
@section('title', 'Welcome to CM Boxing')

@section('content')

<div id="vue">
    @if(Auth::check())
        <booking id="{{ Auth::user()->id }}"></booking>
    @else
        <booking id="0"></booking>
    @endif
    <section id="footer-s1" class="footer-s1 pt-5">
        <web-footer />
    </section>
</div>

@endsection