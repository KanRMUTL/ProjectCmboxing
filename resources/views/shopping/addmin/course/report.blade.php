@extends('layouts.adminlte')
@section('title','รายงานการขายคอร์ส')
@section('header','รายงานการขายคอร์ส')
@section('content')
  <link rel="stylesheet" href="{{asset('css/pos/style.css')}}">
  <div>
    <div id="vue">
      <report-course></report-course>
    </div>
</div>
@endsection