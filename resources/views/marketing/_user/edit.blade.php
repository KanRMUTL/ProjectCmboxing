@extends('layouts.adminlte')
@section('title','แก้ไขข้อมูลพนักงาน')
@section('header','แก้ไขข้อมูลพนักงาน')

@section('content')
<div class="box box-info">
   <div class="box-header with-border">
      <h3 class="box-title">ผู้ใช้ : {{ $user->firstname }}&emsp;{{ $user->lastname }}</h3>
   </div>
   {!! Form::open(['action' => ['UserController@update', $user->id], 'method' => 'PUT', 'files' => true]) !!}
   {{ Form::token()}}
   <input type="hidden" name="user_id" value="{{ $user->id}}">
   <div class="box-body">
      <div class="row">
         <div class="row">
            <div class="col-md-12">
                  <figure>
                     <img
                        src="{{asset('/images/userImg/'.$user->img)}}"
                        class="img-circle img-responsive"
                        style="margin: 0 auto;"
                     >
                  </figure>
            </div>
         </div>
         <div class="col-md-6">
            <div class="input-group">
               <span class="input-group-addon">ชื่อ</span>
               <input type="text" class="form-control" placeholder="ชื่อ" name="firstname" value="{{ $errors->has('firstname') ? old('firstname') : $user->firstname }}">
            </div>
            @include('layouts.component.invalidFeedback', ['input' => 'firstname'])
         </div>
         <div class="col-md-6">
            <div class="input-group">
               <span class="input-group-addon">นามสกุล</span>
               <input type="text" class="form-control" placeholder="นามสกุล" name="lastname" value="{{ $errors->has('lastname') ? old('lastname') :  $user->lastname }}">
            </div>
            @include('layouts.component.invalidFeedback', ['input' => 'lastname'])
         </div>
      </div>
      <br>

      <div class="row">
         <div class="col-md-6">
            <div class="input-group">
               <span class="input-group-addon">ID Card</span>
               <input type="number" class="form-control" placeholder="หมายเลขบัตรประชาชน" name="id_card" value="{{ $errors->has('id_card') ? old('id_card') : $user->employee->id_card }}">
            </div>
            @include('layouts.component.invalidFeedback', ['input' => 'id_card'])
         </div>
         <div class="col-md-6">
            <div class="input-group">
               <span class="input-group-addon">Username</span>
               <input type="text" class="form-control" value="{{ $user->username }}" disabled>
            </div>
         </div>
      </div>
      <br>

      <div class="row">
         <div class="col-md-6">
            <div class="input-group">
               <span class="input-group-addon">อีเมล์</span>
               <input type="email" class="form-control" placeholder="อีเมล์" name="email" value="{{ $errors->has('email') ? old('email') : $user->email }}">
            </div>
            @include('layouts.component.invalidFeedback', ['input' => 'email'])
         </div>
         <div class="col-md-6">
            <div class="input-group">
               <span class="input-group-addon">เบอร์โทร</span>
               <input type="number" class="form-control" placeholder="เบอร์โทร" name="phone_number" value="{{ $errors->has('phone_number') ? old('phone_number') :  $user->phone_number }}">
            </div>
            @include('layouts.component.invalidFeedback', ['input' => 'phone_number'])
         </div>
      </div>
      <br>
      
      <div class="row">
         <div class="col-md-6">
            <div class="input-group">
               <label>ที่อยู่</label>
               <textarea class="form-control" rows="3" cols="100" placeholder="ที่อยู่" name="address">{{ $errors->has('address') ? old('address') :  $user->address }}</textarea>
            </div>
            @include('layouts.component.invalidFeedback', ['input' => 'address'])
         </div>
         <div class="col-md-6">
            <label for="img">รูปประจำตัว</label>
            <input type="file" id="img" name="img" class="form-control">
            @include('layouts.component.invalidFeedback', ['input' => 'img'])
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
                        <option value="{{ $key }}" selected>{{ $role }}</option>           
                        @continue       
                     @endif
                        <option value="{{ $key }}" >{{ $role }}</option>                  

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
      <br>
      <div class="row">
         <div class="col-md-6">
            <div class="input-group">
               <span class="input-group-addon">รหัสผ่านใหม่</span>
               <input type="password" class="form-control" placeholder="รหัสผ่านใหม่(กรณีพนักงานลืมรหัสผ่าน)" name="password">
            </div>
            @include('layouts.component.invalidFeedback', ['input' => 'password'])
         </div>
      </div>

      <div class="box-footer">
         <button type="submit" class="btn btn-primary pull-right">บันทึก</button>
      </div>
   </div>
   <!-- /.box -->
   {!! Form::close() !!}
   {{-- @stop() --}}
@endsection