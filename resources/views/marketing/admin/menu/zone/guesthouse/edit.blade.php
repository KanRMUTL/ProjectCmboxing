@extends('layouts.adminlte')
@section('title','แก้ไขข้อมูลบัตร')
@section('header-class', 'center')
@section('header','แก้ไขบัตร')
@section('description','สำหรับแก้ไขข้อมูลบัตร')

@section('content')
{!! Form::open(['action' => ['marketing\GuesthouseController@update', $guesthouse->id ], 'method' => 'PUT'])
!!}
{{ Form::token()}}
<div class="col-md-3"></div>
<div class="form-horizontal col-md-5 offset-md-3">

  <div class="box-body">
    <div class="form-group">
      <label for="name">ชื่อเกสเฮาท์</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ $guesthouse->name }}">
    </div>
    <div class="form-group">
      <label for="zone_id">โซน</label>
      <select class="form-control" id="zone_id" name="zone_id">
        @foreach ($zones as $zone)
          <option value="{{ $zone->id }}" {{ $guesthouse->zone_id == $zone->id ? 'selected' : null}}>
            {{ $zone->name }}
          </option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="card-footer">
    <button type="submit" class="btn btn-primary">บันทึก</button>
  </div>
</div>

{!! Form::close() !!}
@stop()