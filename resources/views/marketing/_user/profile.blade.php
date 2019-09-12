@extends('layouts.adminlte')
@section('header-class', 'center')
@section('title','โปรไฟล์')
@section('header','โปรไฟล์')
@section('description','สำหรับแก้ไขข้อมูลส่วนตัว')

@section('content')
    <div id="vue">
        <profile id="{{ Auth::user()->id }}"></profile>
    </div>
@endsection