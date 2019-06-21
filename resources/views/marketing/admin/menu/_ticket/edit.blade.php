@extends('layouts.adminlte')
@section('title','แก้ไขข้อมูลบัตร')
@section('header-class', 'center')
@section('header','แก้ไขบัตร')
@section('description','สำหรับแก้ไขข้อมูลบัตร')

@section('content')
{!! Form::open(['action' => ['marketing\TicketController@update', $ticket->id ], 'method' => 'PUT', 'files' => true])
!!}
{{ Form::token()}}
<div class="col-md-3"></div>
<div class="form-horizontal col-md-5 offset-md-3">

  <img src="{{ URL::to('/') }}/shopping/img/ticket/{{$ticket->img}}" style="width:100%; margin: 0 auto;">
  <input type="hidden" name="ticketId" value="{{ $ticket->id }}">
  <div class="box-body">
    <div class="form-group">
      <label for="name">ชื่อบัตร</label>
      <input type="text" class="form-control" id="name" name="name"
        value="{{ $errors->has('name')? old('name') : $ticket->name }}">
      @include('layouts.component.invalidFeedback', ['input' => 'name'])
    </div>

    <div class="form-group">
      <label for="price">ราคา</label>
      <input type="number" class="form-control" id="price" name="price"
        value="{{ $errors->has('price')? old('price') : $ticket->price }}">
      @include('layouts.component.invalidFeedback', ['input' => 'price'])
    </div>

    <div class="form-group">
      <label for="commission">ค่าคอมมิชชั่นสำหรับไกด์</label>
      <input type="number" class="form-control" id="commission" name="commission"
        value="{{ $errors->has('commission')? old('commission') : $ticket->commission }}">
      @include('layouts.component.invalidFeedback', ['input' => 'commission'])
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