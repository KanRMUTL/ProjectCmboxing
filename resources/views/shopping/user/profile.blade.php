@extends('shopping.layout.master')
@section('title', 'My Course')
@section('content')

<div id="vue" class="container">
    <user-profile id="{{ Auth::user()->id }}" />
</div>

@endsection