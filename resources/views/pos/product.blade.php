@extends('layouts.adminlte')
@section('title','จัดการสินค้า')
@section('header','จัดการสินค้า')
@section('content')
  <link rel="stylesheet" href="{{asset('css/pos/style.css')}}">
  <div>
    <div id="vue">
      <product></product>
    </div>
</div>
@endsection