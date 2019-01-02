
@extends('layouts.adminlte')
@section('title','ค่าคอมมิชชั่น')
@section('header','ข้อมูลค่าคอมมิชชั่นของไกด์')

@section('content')
<!-- Button trigger modal -->
<div class="row">
  {!! Form::open(['route' => 'empCommission.search', 'method' => 'POST']) !!}
  {{ Form::token()}}
    <input type="hidden" name="zoneId" value="{{ auth::user()->zone_id }}">
    <div class="col-md-2 col-xs-6 form-group">
    <input type="date" class="form-control" value="{{ $range['start'] }}" name="start">
    </div>
    <div class="col-md-2 col-xs-6 form-group">
      <input type="date" class="form-control" value="{{ $range['end'] }}" name="end">
    </div>
    @if(auth::user()->role_id == 1)
    <div class="col-md-2 col-xs-6 form-group">
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
    <div class="col-md-2 col-xs-6 form-group">
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
              @if(auth::user()->role_id != 3)
              <th>ชื่อพนักงาน</th>
                @if(auth::user()->role_id != 2)
                <th>โซน</th>
                @endif
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
                  @if(auth::user()->role_id != 2)
                  <td>{{ $item->user->zone->name }}</td>
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
    </div>
  </div>

  @endsection()

