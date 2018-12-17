@extends('layouts.adminlte')
@section('title','Edit User')
@section('header','แก้ไขผู้ใช้')
@section('description','สำหรับแก้ไขข้อมูลผู้ใช้')

@section('content')
<div class="box box-info">
<div class="box-header with-border">
   <h3 class="box-title">ผู้ใช้ : {{ $user->name }}</h3>
</div>
{!! Form::open(['action' => ['UserController@update', $user->id], 'method' => 'PUT']) !!}
{{ Form::token()}}
<input type="hidden" name="id" value="{{ $user->id}}">
<div class="box-body">
   <div class="input-group">
      <span class="input-group-addon">ชื่อ</span>
      <input type="text" class="form-control" placeholder="ชื่อผู้ใช้" name="name" value="{{ $user->name}}">
   </div>
   <br>
   <div class="input-group">
      <span class="input-group-addon">อีเมล์</span>
      <input type="email" class="form-control" placeholder="อีเมล์" name="email" value="{{ $user->email}}">
   </div>
   <br>
   <div class="input-group">
      <span class="input-group-addon">รหัสผ่าน</span>
      <input type="password" class="form-control" placeholder="รหัสผ่านใหม่(ไม่จำเป็น)" name="password">
   </div>
   <br>
      <div class="row">
         <div class="col-xs-6">
            <label for="role">ตำแหน่ง</label>
            <select class="form-control" id="role" name="role">
            @foreach ($roles as $role)
                {{ $selected = ''}}
                @if($user->role_id == $role->id)
                    {{ $selected = 'selected' }}
                @endif()
                <option value="{{ $role->id }}" {{ $selected }} >{{ $role->name }}</option>
            @endforeach
            </select>
         </div>
         <div class="col-xs-6">
            <label for="zone">โซน</label>
            <select class="form-control" id="znoe" name="zone">
            @foreach ($zones as $zone)
                {{ $selected = ''}}
                @if($zone->id == $user->zone_id)
                    {{ $selected ='selected'}}
                @endif()
                <option value="{{ $zone->id }}" {{ $selected }}>{{ $zone->name }}</option>
            @endforeach
            </select>
         </div>
      </div>
   <div class="box-footer">
      <button type="submit" class="btn btn-primary pull-right">บันทึก</button>
   </div>
</div>
<!-- /.box -->
{!! Form::close() !!}
@stop()