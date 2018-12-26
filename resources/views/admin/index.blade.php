@extends('layouts.adminlte')
@section('title','แดชบอร์ด')
@section('header','แดชบอร์ด')
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
            <a href="/saleByEmployee" class="small-box-footer">
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
            <a href="/saleByEmployee" class="small-box-footer">
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
            <a href="/saleByEmployee" class="small-box-footer">
                ข้อมูลเพิ่มเติม <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>
@endsection