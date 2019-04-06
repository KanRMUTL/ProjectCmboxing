@extends('shopping.layout.master')
@section('title', 'Welcome to CM Boxing')

@section('content')
@include('shopping.layout.about_banner')
<div id="vue">
    <div  class="container">
        <courses-index id="{{ Auth::user()->id }}"></courses-index>
    </div>    
</div>
@endsection