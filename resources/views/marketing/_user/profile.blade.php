@extends('layouts.adminlte')
@section('title','โปรไฟล์')
@section('header','โปรไฟล์')

@section('content')
    <div id="vue">
        <profile id="{{ Auth::user()->id }}"></profile>
    </div>
@endsection