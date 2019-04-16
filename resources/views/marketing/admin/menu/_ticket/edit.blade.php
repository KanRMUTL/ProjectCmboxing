@extends('layouts.adminlte')
@section('title','แก้ไขข้อมูลบัตร')
@section('header','แก้ไขบัตร')
@section('description','สำหรับแก้ไขข้อมูลบัตร')

@section('content')
{!! Form::open(['action' => ['marketing\TicketController@update', $ticket->id ], 'method' => 'PUT', 'files' => true]) !!}
{{ Form::token()}}

<div class="form-horizontal">
  <div>
    <h4 class="card-title">แก้ไขบัตร</h4>
  </div>

      <img src="{{ URL::to('/') }}/shopping/img/ticket/{{$ticket->img}}" style="width:30%;" align="center">
  <input type="hidden" name="ticketId" value="{{ $ticket->id }}">
  <div class="box-body">
    <div class="form-group">
      <label for="name">ชื่อบัตร</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ $ticket->name }}">
    </div>
   
    <div class="form-group">
      <label for="price">ราคา</label>
      <input type="number" class="form-control" id="price" name="price" value="{{ $ticket->price }}" >
    </div>

    <div class="form-group">
      <label for="commission">ค่าคอมมิชชั่นสำหรับไกด์</label>
      <input type="number" class="form-control" id="commission" name="commission" value="{{ $ticket->commission }}" >
    </div>

    <div class="form-group">
      <label for="image">รูปภาพ</label>
      <input type="file" id="image" name="image" class="form-control-file">
    </div>
  </div>
  <div class="card-footer">
    <button type="submit" class="btn btn-primary">บันทึก</button>
  </div>
</div>

{!! Form::close() !!}
@stop()