@extends('shopping.layout.master')
@section('title', 'Welcome to CM Boxing')

@section('content')
@include('shopping.layout.about_banner')
<div id="vue">
    <div  class="container">
        @if(Auth::check())
            <courses-index id="{{ Auth::user()->id }}"></courses-index>
        @else
            <courses-index id="0"></courses-index>
        @endif
    </div>    
</div>
@endsection