@extends('layouts.adminlte')
@section('title','จัดการคอร์สฝึกสอน')
@section('header','จัดการคอร์สฝึกสอน')
@section('content')
  <link rel="stylesheet" href="{{asset('css/pos/style.css')}}">
  <div>
    <div id="vue">
      <course></course>
    </div>
</div>
@endsection