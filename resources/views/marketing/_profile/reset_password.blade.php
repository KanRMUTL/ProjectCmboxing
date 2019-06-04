@extends('layouts.adminlte') 
@section('title','ข้อมูลพนักงาน') 
@section('custom-stylesheet')
    <link rel="stylesheet" href="{{asset('css/marketing/profile.css')}}">
@endsection()
@section('header', 'โปรไฟล์พนักงาน') 
@section('content')

<link rel="stylesheet" href="{{asset('css/marketing/profile.css')}}">
<div class="container" id="vue">
    <div class="row">
        <div class="col-md-12  col-lg-12">
            <div class="well profile">
                <div class="col-sm-12">
                    <password-reset :id="{{ auth::user()->id }}"/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection()