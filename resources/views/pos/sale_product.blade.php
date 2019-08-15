@extends('layouts.adminlte')
@section('title','ขายสินค้า')
@section('header','ขายสินค้า')
@section('content')
  <link rel="stylesheet" href="{{asset('css/pos/style.css')}}"> 
  <div>
    <div id="vue">
      <saling id="{{ Auth::user()->id }}"></saling>
    </div>
</div>
@endsection

@section('script')

@endsection
