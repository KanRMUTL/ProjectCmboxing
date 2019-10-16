@extends('layouts.adminlte')
@section('title','แดชบอร์ด')
@section('header','ข้อมูลรายสัปดาห์')
@section('content')
<div class="row">
    <div class="col-lg-3 col-xs-12 ">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h4>จำนวนบัตรที่ขายได้</h4>
                <h3>{{$ticketAmount}} ใบ</h3>
            </div>
            <div class="icon">
                <i class="fa fa-ticket"></i>
            </div>
            <a href="/sale/employee" class="small-box-footer">
                ข้อมูลเพิ่มเติม <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-12 ">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h4>จำนวนลูกค้าที่ซื้อบัตร</h4>
                <h3>{{$customerAmount}} คน</h3>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="/sale/employee" class="small-box-footer">
                ข้อมูลเพิ่มเติม <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-12 ">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h4>รายได้ทั้งหมด</h4>
                <h3>{{number_format($income, null, '.',',') }} บาท</h3>
            </div>
            <div class="icon">
                <i class="fa fa-money"></i>
            </div>
            <a href="/income" class="small-box-footer">
                ข้อมูลเพิ่มเติม <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-12 ">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h4>พนักงาน</h4>
                <h3>{{ $employee }} คน</h3>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
            <a href="/user" class="small-box-footer">
                จัดการ <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>
@endsection