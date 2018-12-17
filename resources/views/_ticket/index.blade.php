@extends('layouts.adminlte')
@section('title', 'จัดการบัตร')
@section('header','จัดการข้อมูลบัตร')
@section('content')

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    <i class="fa fa-lg fa-ticket"></i> เพิ่มบัตร
  </button>
    
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">เพิ่มบัตรใหม่</h4>
          </div>
          {!! Form::open(['route' => 'ticket.store', 'method' => 'POST']) !!}
          {{ Form::token()}}
          <div class="modal-body">
            <div class="form-group">
              <label for="name">ชื่อบัตร</label>
              <input type="text" class="form-control" id="name" name="name" >
            </div>
            <div class="form-group">
              <label for="username">ราคา</label>
              <input type="text" class="form-control" id="username" name="price" >
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            <button type="submit" class="btn btn-primary">บันทึก</button>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div><!-- Modal -->
<div class="box-body">  
    <table class="table table-striped table-hover" style="font-size: 150%;">
      <thead>
      <tr align="center" style="text-align-last: center;">
        <th>ชื่อบัตร</th>
        <th>ราคา</th>
        <th>แก้ไข</th>
        <th>ลบ</th>
      </tr>
      </thead>
      <tbody>
       @foreach ($tickets as $ticket)
           <tr align="center">
            <td>{{ $ticket->name }}</td>
            <td>{{ $ticket->price }}</td>
            <td>
              <a href="/ticket/{{ $ticket->id }}/edit" class="btn btn-warning">
                <i class="fa fa-edit fa-lg"></i>
              </a>
            </td>
            <td>
              {!! Form::open(['action' => ['marketing\TicketController@destroy', $ticket->id]]) !!}
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
@endsection
