@extends('shopping.layout.master')
@section('title', 'My Ticket')
@section('content')

<div id="vue" class="container">
    <my-ticket id="{{ Auth::user()->id }}" />
</div>
@endsection