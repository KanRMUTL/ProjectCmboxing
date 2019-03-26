@extends('layouts.adminlte')
@section('title','Edit User')
@section('header','แก้ไขผู้ใช้')
@section('description','สำหรับแก้ไขข้อมูลผู้ใช้')

@section('content')
<div class="box box-info">
   <div class="box-header with-border">
      <h3 class="box-title">ผู้ใช้ : {{ $user->firstname }}&emsp;{{ $user->lastname }}</h3>
   </div>
   {!! Form::open(['action' => ['UserController@update', $user->id], 'method' => 'PUT']) !!}
   {{ Form::token()}}
   <input type="hidden" name="user_id" value="{{ $user->id}}">
   <div class="box-body">
      <div class="row">
         <div class="col-md-6">
            <div class="input-group">
               <span class="input-group-addon">ชื่อ</span>
               <input type="text" class="form-control" placeholder="ชื่อ" name="firstname" value="{{ $user->firstname }}">
            </div>
         </div>
         <div class="col-md-6">
            <div class="input-group">
               <span class="input-group-addon">นามสกุล</span>
               <input type="text" class="form-control" placeholder="นามสกุล" name="lastname" value="{{ $user->lastname }}">
            </div>
         </div>
      </div>
      <br>

      <div class="row">
         <div class="col-md-6">
            <div class="input-group">
               <span class="input-group-addon">อีเมล์</span>
               <input type="email" class="form-control" placeholder="อีเมล์" name="email" value="{{ $user->email }}">
            </div>
         </div>
         <div class="col-md-6">
            <div class="input-group">
               <span class="input-group-addon">เบอร์โทร</span>
               <input type="number" class="form-control" placeholder="เบอร์โทร" name="phone_number" value="{{ $user->phone_number }}">
            </div>
         </div>
      </div>
      <br>
      <div class="row">
         <div class="col-md-6">
            <div class="input-group">
               <span class="input-group-addon">ID Card</span>
               <input type="number" class="form-control" placeholder="หมายเลขบัตรประชาชน" name="id_card" value="{{ $user->employee->id_card }}">
            </div>
         </div>
         <div class="col-md-6">
            <div class="input-group">
               <span class="input-group-addon">รหัสผ่าน</span>
               <input type="password" class="form-control" placeholder="รหัสผ่านใหม่(ไม่จำเป็น)" name="password">
            </div>
         </div>
      </div>
      <br>
      <div class="row">
         <div class="col-md-12">
            <div class="input-group">
               <label>ที่อยู่</label>
               <textarea class="form-control" rows="3" cols="100" placeholder="ที่อยู่" name="address">{{ $user->address }}</textarea>
            </div>
         </div>
      </div>
      <br>
      @if(Auth::user()->role == 1)
         <div class="row">
            <div class="col-md-6">
               <label for="role">ตำแหน่ง</label>
               <select class="form-control" id="role" name="role">
                  @foreach ($roles as $key => $role)
                     @if($user->role == $key)
                        <option value="{{ $key+1 }}" selected>{{ $role }}</option>           
                        @continue       
                     @endif
                        <option value="{{ $key+1 }}" >{{ $role }}</option>                  

                  @endforeach
               </select>
            </div>
            <div class="col-md-6">
               <label for="zone">โซน</label>
               <select class="form-control" id="znoe" name="zone">
                  @foreach ($zones as $zone)
                     @if($zone->id == $user->employee->zone_id)
                        <option value="{{ $zone->id }}" selected>{{ $zone->name }}</option>
                        @continue
                     @endif()
                     <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                  @endforeach
               </select>
            </div>
         </div>
      @else
         <input type="hidden" name="zone" value="{{ $user->employee->zone_id }}">
         <input type="hidden" name="role" value="{{ $user->role }}">
      @endif
      <div class="box-footer">
         <button type="submit" class="btn btn-primary pull-right">บันทึก</button>
      </div>
   </div>
   <!-- /.box -->
   {!! Form::close() !!}
   @stop()