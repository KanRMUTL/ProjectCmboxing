@extends('shopping.layout.master')
@section('title', 'My Course')
@section('content')

<div id="vue" class="container">
    <my-course id="{{ Auth::user()->id }}" />
</div>
@endsection