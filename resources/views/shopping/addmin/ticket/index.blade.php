@extends('layouts.adminlte')
@section('title','ข้อมูลการขายบัตรออนไลน์')
@section('header','ข้อมูลการขายบัตรออนไลน์')
@section('content')
  <link rel="stylesheet" href="{{asset('css/pos/style.css')}}">
  <div>
    <div id="vue">
      <sale-ticket-online></sale-ticket-online>
    </div>
</div>
@endsection