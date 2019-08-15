@extends('layouts.adminlte')
@section('title', 'จัดการบัตร')
@section('header','จัดการข้อมูลบัตร')
@section('content')

{{-- @include('marketing.admin.menu._ticket.create') --}}

<div class="row">
  <div class="col-xs-12 col-md-12 col-sm-12">
    <div class="box box box-info">
      <div class="box-body table-responsive">
        <table style="font-size: 120%" class="table table-striped table-hover" >
          <thead>
            <tr align="center" style="text-align-last: center;">
              <th>ชื่อบัตร</th>
              <th>ราคา</th>
              <th>ค่าคอมมิชชั่นไกด์</th>
              <th>แก้ไข</th>
              {{-- <th>ลบ</th> --}}
            </tr>
          </thead>
          <tbody>
            @foreach ($tickets as $ticket)
            <tr align="center">
              <td>{{ $ticket->name }}</td>
              <td>
                <span class="label label-primary">
                  {{ $ticket->price }}
                </span>
              </td>
              <td>
                  <span class="label label-primary">
                    {{ $ticket->commission }}
                  <span>
                </td>
              <td>
                <a href="/ticket/{{ $ticket->id }}/edit" class="btn btn-warning">
                  <i class="fa fa-edit fa-lg"></i>
                </a>
              </td>
              {{-- <td>
                {!! Form::open(['action' => ['marketing\TicketController@destroy', $ticket->id]]) !!}
                {{ csrf_field() }}
                {{ Form::hidden('_method','DELETE') }}
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash fa-lg"></i></button>
                {{ Form::close() }}
              </td> --}}
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection