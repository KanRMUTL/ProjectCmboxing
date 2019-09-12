@extends('layouts.adminlte')
@section('title','แก้ไขข้อมูลครูสอนมวยไทย')
@section('header-class', 'center')
@section('header','แก้ไขข้อมูลครูสอนมวยไทย')
@section('description','สำหรับแก้ไขข้อมูลบัตร')

@section('content')
{!! Form::open(['action' => ['shopping\TrainerController@update', $trainer->id ], 'method' => 'PUT', 'files' => true])
!!}
{{ Form::token()}}

<div class="col-md-2"></div>
<div class="modal-content col-md-8">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
        aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูลครูสอนมวยไทย</h4>
  </div>

    <div class="form-group center">
      <img src="{{ URL::to('/') }}/shopping/img/trainer/{{$trainer->img}}" style="width:50%;" align="center">
    </div>
    <input type="hidden" name="trainerId" value="{{ $trainer->id }}">
    
    <div class="modal-body">
      <div class="form-group">
        <label for="name">ชื่อครูฝึก</label>
        <input type="text" class="form-control" id="name" name="name" required
          value="{{ $errors->has('name') ? old('name') : $trainer->name }}">
        @include('layouts.component.invalidFeedback', ['input' => 'name'])
      </div>
      <div class="form-group">
        <label for="detail">รายละเอียด</label>
        <textarea class="form-control" id="detail" name="detail"
          required> {{ $errors->has('detail') ? old('detail') : $trainer->detail }}</textarea>
        @include('layouts.component.invalidFeedback', ['input' => 'detail'])
      </div>
      <div class="form-group">
        <label for="img">รูปภาพ</label>
        <input type="file" id="img" name="img" class="form-control-file">
        @include('layouts.component.invalidFeedback', ['input' => 'img'])
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