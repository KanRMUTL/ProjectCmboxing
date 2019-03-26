@extends('layouts.adminlte')
@section('title','แก้ไขข้อมูลบัตร')
@section('header','แก้ไขบัตร')
@section('description','สำหรับแก้ไขข้อมูลบัตร')

@section('content')
{!! Form::open(['action' => ['marketing\TicketController@update', $ticket->id ], 'method' => 'PUT', 'files' => true]) !!}
{{ Form::token()}}

<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">แก้ไขบัตร</h4>
  </div>

  <div class="form-group">
      <img src="{{ URL::to('/') }}/shopping/img/ticket/{{$ticket->img}}" style="width:30%;" align="center">
  </div>
  <input type="hidden" name="ticketId" value="{{ $ticket->id }}">
  <div class="modal-body">
    <div class="form-group">
      <label for="name">ชื่อบัตร</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ $ticket->name }}">
    </div>
   
    <div class="form-group">
      <label for="price">ราคา</label>
    <input type="text" class="form-control" id="price" name="price" value="{{ $ticket->price }}" >
  </div>
    <div class="form-group">
      <label for="image">รูปภาพ</label>
    <input type="file" id="image" name="image" class="form-control-file">
  </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
    <button type="submit" class="btn btn-primary">บันทึก</button>
    
  </div>
</div>
{!! Form::close() !!}
@stop()