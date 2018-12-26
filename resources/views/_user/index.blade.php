
@extends('layouts.adminlte')
@section('title','ผู้ใช้งาน')
@section('header','ผู้ใช้ทั้งหมด')
@section('description','สำหรับจัดการผู้ใช้ทั้งหมด')

@section('content')

  @include('_user.create_user')

  <!-- box-body -->
  <div class="row">
      <div class="col-xs-12 col-md-12 col-sm-12">
        <div class="box box box-info">
          <!-- /.box-header -->
          <div class="box-body table-responsive"> 
    <table style="font-size: 120%" style="font-size: 120%" style="font-size: 120%" class="table table-hover" >
      <thead>
      <tr align="center" style="text-align-last: center;">
        <th>ชื่อ-นามสกุล</th>
        <th>username</th>
        <th>อีเมล์</th>
        <th>ตำแหน่ง</th>
        <th>โซน</th>
        <th>แก้ไข</th>
        <th>ลบ</th>
      </tr>
      </thead>
      <tbody>
       @foreach ($users as $user)
           <tr align="center">
            <td>{{ $user->name }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role->name }}</td>
            <td>
              <span class="label label-primary" style="font-size: 100%;">
                {{ $user->zone->name}}
                </span>
              </td>
            <td>
              <a href="/user/{{ $user->id }}/edit" class="btn btn-warning">
                <i class="fa fa-edit fa-lg"></i>
              </a>
            </td>
            <td>
              {!! Form::open(['action' => ['UserController@destroy', $user->id]]) !!}
              {{ csrf_field() }}
              {{ Form::hidden('_method','DELETE') }}
              <button type="submit" class="btn btn-danger"><i class="fa fa-trash fa-lg"></i></button>
              {{ Form::close() }}
            </td>
           </tr>
       @endforeach
      </tbody>
    </table>
          </div><!-- box-body -->
        </div><!-- box-info -->
      </div><!-- col -->
  </div><!-- row -->


  @endsection()