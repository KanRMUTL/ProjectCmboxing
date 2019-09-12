@extends('layouts.adminlte')
@section('title','แก้ไขข้อมูลบัตร')
@section('header-class', 'center')
@section('header','แก้ไขข้อมูลโซน')
@section('description','แก้ไขข้อมูลโซน')

@section('content')
{!! Form::open(['action' => ['marketing\ZoneController@update', $id ], 'method' => 'PUT'])
!!}
{{ Form::token()}}
<div class="col-md-3"></div>
<div class="form-horizontal col-md-5 offset-md-3">

  <div class="box-body">
    <div class="form-group">
      <label for="name">ชื่อโซน</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ $name }}">
    </div>

    <div class="form-group">
      <label for="latitude">ละติจูด</label>
      <input type="text" class="form-control" id="latitude" name="latitude" value="{{ $latitude }}">
    </div>
    <div class="form-group">
      <label for="longitude">ลองติจูด</label>
      <input type="text" class="form-control" id="longitude" name="longitude" value="{{ $latitude }}">
    </div>
  </div>
  <div class="card-footer">
    <button type="submit" class="btn btn-primary">บันทึก</button>
  </div>
</div>

{!! Form::close() !!}
@stop()