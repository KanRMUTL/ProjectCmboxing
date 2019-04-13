@extends('shopping.layout.master')
@section('title', 'My Ticket')
@section('content')

<div id="vue" class="container">
    <ticket id="{{ Auth::user()->id }}" />
</div>
@endsection