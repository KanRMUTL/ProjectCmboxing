@extends('layouts.adminlte')
@section('title','แก้ไขข้อมูลบัตร')
@section('header-class', 'center')
@section('header','แก้ไขข้อมูลเว็บไซต์')
@section('description','สำหรับแก้ไขข้อมูลทั่วไป')

@section('content')
{!! Form::open(['action' => ['WebdetailController@update', $id], 'method' => 'PUT'])
!!}
{{ Form::token()}}
<div class="col-md-3"></div>
<div class="form-horizontal col-md-6 offset-md-3">

  <div class="box-body">
    <div class="form-group">
      <label for="email">ชื่อโซน</label>
      <input type="text" class="form-control" id="email" name="email" value="{{ $email }}">
    </div>

    <div class="form-group">
      <label for="phone">เบอร์โทร</label>
      <input type="number" class="form-control" id="phone" name="phone" value="{{ $phone }}">
    </div>

    <div class="form-group">
      <label for="about">เกี่ยวกับ</label>
      <textarea type="text" class="form-control" id="about" name="about" rows="7">{{ $about }}</textarea>
    </div>

    <div class="form-group">
     <label for="facebook">ลิงค์ Facebook</label>
     <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $facebook }}">
   </div>

   <div class="form-group">
     <label for="line_token">Line Token สำหรับบริการแจ้งเตือนผ่านไลน์</label>
     <input type="text" class="form-control" id="line_token" name="line_token" value="{{ $line_token }}">
   </div>

  </div> <!-- End Boxbody -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary btn-block">บันทึก</button>
  </div>
</div>

{!! Form::close() !!}
@stop()