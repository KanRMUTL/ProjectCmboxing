@extends('layouts.adminlte')
@section('title', 'จัดการโซนการตลาด')
@section('header','จัดการข้อมูลโซนการตลาด')
@section('content')

@include('marketing.admin.menu.zone.create')

<div class="row">
  <div class="col-xs-12 col-md-12 col-sm-12">
    <div class="box box box-info">
      <div class="box-body table-responsive">
        <table style="font-size: 120%" class="table table-striped table-hover" >
          <thead>
            <tr align="center" style="text-align-last: center;">
              <th>ชื่อโซน</th>
              <th>ละติจูด</th>
              <th>ลองติจูด</th>
              <th>เกสเฮาท์</th>
              <th>แก้ไข</th>
              <th>ลบ</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($zones as $zone)
            <tr align="center">
              <td>
                  <span class="label label-primary">
                    {{ $zone->name }}</td>
                  </span>
              <td>
                  {{ $zone->latitude }}
              </td>
              <td>
                    {{ $zone->longitude }}
                </td>
              <td>
                <a href="/zone/{{ $zone->id }}/guesthouse" class="btn btn-primary">
                  <i class="fa fa-search fa-lg"></i>
                </a>
              </td>
              <td>
                <a href="/zone/{{ $zone->id }}/edit" class="btn btn-warning">
                  <i class="fa fa-edit fa-lg"></i>
                </a>
              </td>
              <td>
                {!! Form::open(['action' => ['marketing\ZoneController@destroy', $zone->id]]) !!}
                {{ csrf_field() }}
                {{ Form::hidden('_method','DELETE') }}
                <button type="submit" class="btn btn-danger" onclick="return confirm('คุณต้องการลลบโซนดังกล่าวหรือไม่')"><i class="fa fa-trash fa-lg"></i></button>
                {{ Form::close() }}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection