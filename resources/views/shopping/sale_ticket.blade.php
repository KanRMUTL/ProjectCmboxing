@extends('shopping.layout.master')
@section('title', 'Payment')
@section('content')

@include('shopping.layout.about_banner')

<!--====================================================
                         Single Ticket
======================================================--> 
<div class="container" id="vue">
     <single-ticket :id="{{$id}}" :title="{{ Auth::user()->id }}"/>
</div>

@endsection