@extends('layouts.adminlte')
@section('title','แก้ไขข้อมูลการชกมวย')
@section('header-class', 'center')
@section('header','แก้ไขข้อมูลการชกมวย')
@section('description','สำหรับแก้ไขข้อมูลบัตร')

@section('content')
{!! Form::open(['action' => ['shopping\FightController@update', $id ], 'method' => 'PUT', 'files' => true])
!!}
{{ Form::token()}}

<div class="col-md-2"></div>
<div class="modal-content col-md-8">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
        aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูลการชกมวย</h4>
  </div>

    <div class="form-group center">
      <img src="{{ URL::to('/') }}/shopping/img/fight/{{$img}}" style="width:50%;" align="center">
    </div>
    <input type="hidden" name="fightId" value="{{ $id }}">
    
    <div class="modal-body row">
      <div class="form-group col-md-6">
        <label for="day">วันที่ชก</label>
        <input type="date" id="day" name="day" value="{{ $day }}" class="form-control col-md-5">
      </div>
      <div class="form-group col-md-6">
        <label for="img">รูปภาพ</label>
       <input type="file" id="img" name="img" class="form-control-file">
      </div>
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><i class="fa fa-lg fa-save"></i> บันทึก</button>
    </div>

</div>
{!! Form::close() !!}
@endsection

@section('script')
@include('layouts.component.errorMessage', ['title' => 'กรุณาลองใหม่อีกครั้ง','message' =>
'ไม่สามารถแก้ไขข้อมูลครูฝึกสอนมวยไทยได้'])
@endsection