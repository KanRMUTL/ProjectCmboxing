@extends('layouts.adminlte')
@section('title','รายงานการขายสินค้า')
@section('header','รายงานการขายสินค้า')
@section('content')
  <link rel="stylesheet" href="{{asset('css/pos/style.css')}}">
  <div>
    <div id="vue">
      <report></report>
    </div>
</div>
@endsection