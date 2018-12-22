
@extends('layouts.adminlte')
@section('title','ข้อมูลการขายบัตร')
@section('header','ข้อมูลการขายบัตร')

@section('content')
<!-- Button trigger modal -->

  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              @if(auth::user()->role_id != 3)
              <th>ชื่อพนักงาน</th>
              <th>โซน</th>
              @endif
              <th>ประเภทบัตร</th>
              <th>จำนวนที่ขาย</th>
              <th>ค่าคอมมิชชั่น</th>
              <th>วันที่</th>
            </tr>
            @foreach ($data as $item)
            <tr>
                @if(auth::user()->role_id != 3)
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->user->zone->name }}</td>
                @endif
                <td>{{ $item->ticket->name }}</td>
                <td>
                  <span class="label label-primary">
                    {{ $item->amount }}
                  </td>
                <td>
                  <span class="label label-danger">
                    {{ number_format($item->commission, 2, '.',',') }}</td>
                  </span>
                <td>{{ $item->date_formated }}</td>
              </tr>
            @endforeach
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>

  @endsection()

