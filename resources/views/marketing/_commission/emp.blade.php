
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
              <th class="center">ชื่อพนักงาน</th>
                @if(auth::user()->role != 2)
                <th class="center">โซน</th>
                @endif
              @endif
              <th class="center">ประเภทบัตร</th>
              <th class="center">จำนวนที่ขาย</th>
              <th class="center">ค่าคอมมิชชั่น</th>
              <th class="center">วันที่</th>
            </tr>
            @foreach ($commission as $item)
            <tr>
                @if(auth::user()->role != 3)
                <td class="center">{{ $item->user->firstname }}&emsp;{{ $item->user->lastname }} </td>
                  @if(auth::user()->role != 2)
                  <td class="center">{{ $item->user->employee->zone->name }}</td>
                  @endif
                @endif
                <td class="center">
                    <span class="label label-success">
                      {{ $item->ticket->name }}</td>
                    </span>
                <td class="center">
                  <span class="label label-primary">
                    {{ $item->amount }}
                  </td>
                <td class="center">
                  <span class="label label-danger">
                    {{ number_format($item->commission, 2, '.',',') }}</td>
                  </span>
                <td class="center">{{ $item->date_formated }}</td>
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

