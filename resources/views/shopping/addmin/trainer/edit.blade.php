@extends('layouts.adminlte')
@section('title','แก้ไขข้อมูลครูสอนมวยไทย')
@section('header','แก้ไขข้อมูลครูสอนมวยไทย')
@section('description','สำหรับแก้ไขข้อมูลบัตร')

@section('content')
{!! Form::open(['action' => ['shopping\TrainerController@update', $trainer->id ], 'method' => 'PUT', 'files' => true])
!!}
{{ Form::token()}}

<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
        aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูลครูสอนมวยไทย</h4>
  </div>

  <div class="form-group">
    <img src="{{ URL::to('/') }}/shopping/img/trainer/{{$trainer->img}}" style="width:30%;" align="center">
  </div>
  <input type="hidden" name="trainerId" value="{{ $trainer->id }}">
  <div class="modal-body">
    <div class="form-group">
      <label for="name">ชื่อบัตร</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ $trainer->name }}">
    </div>
    <div class="form-group">
      <label for="detail">รายละเอียด</label>
      <textarea class="form-control" id="detail" name="detail">{{ $trainer->detail }}</textarea>
    </div>
    <div class="form-group">
      <label for="img">รูปภาพ</label>
      <input type="file" id="img" name="img" class="form-control-file">
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
    <button type="submit" class="btn btn-primary">บันทึก</button>
  </div>
</div>
{!! Form::close() !!}
@stop()