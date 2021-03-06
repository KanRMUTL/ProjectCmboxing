
@extends('layouts.adminlte')
@section('title','ค่าคอมมิชชั่น')
@section('header','ข้อมูลค่าคอมมิชชั่นของไกด์')

@section('content')

<div class="row">
  {!! Form::open(['route' => 'guidecommission.search', 'method' => 'POST']) !!}
  {{ Form::token()}}
    <input type="hidden" name="zoneId" value="{{ auth::user()->employee->zone_id }}">
    <div class="col-12 col-md-2 form-group">
      <div class="input-group">
        <span class="input-group-addon">เริ่มต้น</span>
        <input type="date" class="form-control" value="{{ $range['start'] }}" name="start">
      </div>
    </div>
    <div class="col-12 col-md-2 form-group">
      <div class="input-group">
        <span class="input-group-addon">สิ้นสุด</span>
        <input type="date" class="form-control" value="{{ $range['end'] }}" name="end">
      </div>
    </div>
    @if(auth::user()->role == 1)
    <div class="col-12 col-md-2 form-group">
      <select name="zoneId" class="form-control">
        @foreach ($zones as $zone)
          @if (isset($zoneSelected) && $zone->id == $zoneSelected   )
            <option value="{{ $zone->id }}" selected>โซน {{ $zone->name }}</option>
            @continue
          @endif
          <option value="{{ $zone->id }}">โซน {{ $zone->name }}</option>
        @endforeach
      </select>
    </div>
    @endif
    <div class="col-12 col-md-2 form-group">
      <button type="submit" class="btn btn-primary" name="submit">
        <i class="fa fa-search fa-lg"></i>
        ค้นหา
      </button>
    </div>
  {!! Form::close() !!}
</div>

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
                <td class="center">{{ $item->user->firstname }}&emsp;{{ $item->user->lastname }}</td>
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
      <div class="col-md-12 mt-3">
        {!! Form::open(['url' => '/guideCommissionReport', 'method' => 'GET']) !!}
        {{ Form::token()}}
          <input type="hidden" value="{{ $range['start'] }}" name="start">
          <input type="hidden" value="{{ $range['end'] }}" name="end">
          <input type="hidden" value="{{ $zoneSelected }}" name="zoneId">
          <input type="submit" class="btn btn-success btn-block" value="ออกรายงาน">
        {!! Form::close() !!}
      </div>
    </div>
  </div>

  @endsection()

