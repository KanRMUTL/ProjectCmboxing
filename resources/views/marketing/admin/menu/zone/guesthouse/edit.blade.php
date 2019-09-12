@extends('layouts.adminlte')
@section('title','แก้ไขเกสเฮาท์')
@section('header-class', 'center')
@section('header','แก้ไขเกสเฮาท์')
@section('description','')

@section('content')
{!! Form::open(['action' => ['marketing\GuesthouseController@update', $guesthouse->id ], 'method' => 'PUT'])
!!}
{{ Form::token()}}
<div class="col-md-4"></div>
<div class="form-horizontal col-md-4">

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
    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-lg fa-save"></i> บันทึก</button>
  </div>
</div>

{!! Form::close() !!}
@stop()