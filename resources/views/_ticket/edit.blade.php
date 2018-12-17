@extends('layouts.adminlte')
@section('title','แก้ไขข้อมูลบัตร')
@section('header','แก้ไขบัตร')
@section('description','สำหรับแก้ไขข้อมูลบัตร')

@section('content')
{!! Form::open(['action' => ['marketing\TicketController@update', $ticket->id ], 'method' => 'PUT']) !!}
{{ Form::token()}}

<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">แก้ไขบัตร</h4>
  </div>
  {!! Form::open(['route' => 'ticket.store', 'method' => 'POST']) !!}
  {{ Form::token()}}
  <input type="hidden" name="ticketId" value="{{ $ticket->id }}">
  <div class="modal-body">
    <div class="form-group">
      <label for="name">ชื่อบัตร</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ $ticket->name }}">
    </div>
    <div class="form-group">
      <label for="username">ราคา</label>
    <input type="text" class="form-control" id="username" name="price" value="{{ $ticket->price }}" >
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
    <button type="submit" class="btn btn-primary">บันทึก</button>
    {!! Form::close() !!}
  </div>
</div>
{!! Form::close() !!}
@stop()