@extends('layouts.adminlte')
@section('title','กราฟรายงานการขายบัตร')
@section('header','กราฟรายงานการขายบัตรแต่ละโซน')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>

<div id="vue">
  <chart :id="{{Auth::user()->id}}"/>
</div>

@endsection()