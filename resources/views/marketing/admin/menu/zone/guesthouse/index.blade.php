@extends('layouts.adminlte')
@section('title', 'จัดการเกสเฮาส์')
@section('header','จัดการเกสเฮาส์')
@section('content')

@include('marketing.admin.menu.zone.guesthouse.create')

<div class="row">
  <div class="col-xs-12 col-md-12 col-sm-12">
    <div class="box box box-info">
      <div class="box-body table-responsive">
        <table style="font-size: 120%" class="table table-striped table-hover" >
          <thead>
            <tr align="center" style="text-align-last: center;">
              <th>ชื่อเกสเฮาส์</th>
              <th>โซน</th>
              <th>แก้ไข</th>
              <th>ลบ</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($guesthouses as $guesthouse)
            <tr align="center">
              <td>
                    {{ $guesthouse->name }}</td>
              <td>
                  {{ $zone->name }}
              </td>
              <td>
                <a href="/guesthouse/{{ $guesthouse->id }}/edit" class="btn btn-warning">
                  <i class="fa fa-edit fa-lg"></i>
                </a>
              </td>
              <td>
                {!! Form::open(['action' => ['marketing\GuesthouseController@destroy', $guesthouse->id]]) !!}
                {{ csrf_field() }}
                {{ Form::hidden('_method','DELETE') }}
                <button type="submit" class="btn btn-danger" onclick="return confirm('คุณต้องการลลบเกสเฮาส์ดังกล่าวหรือไม่')"><i class="fa fa-trash fa-lg"></i></button>
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