
@extends('layouts.adminlte')
@section('title','ค่าคอมมิชชั่น')
@section('header','ข้อมูลค่าคอมมิชชั่นของพนักงาน')

@section('content')

@include('marketing._commission.search')

  <div class="row">
    <div class="col-xs-12 col-md-12 col-sm-12">
      <div class="box box box-info">
        <div class="box-body table-responsive">
          <table style="font-size: 120%" class="table table-hover">
            <tr>
              @if(auth::user()->role != 3)
              <th>ชื่อพนักงาน</th>
                @if(auth::user()->role != 2)
                <th>โซน</th>
                @endif
              @endif
              <th>ประเภทบัตร</th>
              <th>จำนวนที่ขาย</th>
              <th>ค่าคอมมิชชั่น</th>
              <th>วันที่</th>
            </tr>
            @foreach ($commission as $item)
            <tr>
                @if(auth::user()->role != 3)
                <td>{{ $item->user->firstname }}&emsp;{{ $item->user->lastname }} </td>
                  @if(auth::user()->role != 2)
                  <td>{{ $item->user->employee->zone->name }}</td>
                  @endif
                @endif
                <td>
                    <span class="label label-success">
                      {{ $item->ticket->name }}</td>
                    </span>
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
      @include('marketing._commission.report')

    </div>
  </div>

  @endsection()

