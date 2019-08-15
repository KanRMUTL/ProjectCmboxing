@extends('shopping.layout.master')
@section('title', 'My Course')
@section('content')

<div id="vue" class="container">
    <customer-resetpassword id="{{ Auth::user()->id }}" />
</div>

@endsection