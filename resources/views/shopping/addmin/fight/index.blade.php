@extends('layouts.adminlte')
@section('title', 'จัดการข้อมูลการชกมวย')
@section('header','จัดการข้อมูลการชกมวย')
@section('content')

@include('shopping.addmin.fight.create')

<div class="row">
  <div class="col-xs-12 col-md-12 col-sm-12">
    <div class="box box box-info">
      <!-- /.box-header -->
      <div class="box-body table-responsive">
        <table style="font-size: 120%" class="table table-striped table-hover" >
          <thead>
            <tr align="center" style="text-align-last: center;">
              <th style="width: 30%;">วันที่ชก</th>
              <th style="width: 35%;">รูปภาพ</th>
              <th>แก้ไข</th>
              <th>ลบ</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($fights as $fight)
            <tr align="center">
                <td>{{ date_format(date_create($fight->day), 'd/m/Y')}}</td>
                <td>
                    <img src="{{ URL::to('/') }}/shopping/img/fight/{{$fight->img}}" style="width:50%;" align="center">
                </td>
                <td>
                <a href="/fight/{{ $fight->id }}/edit" class="btn btn-warning">
                    <i class="fa fa-edit fa-lg"></i>
                </a>
                </td>
                <td>
                    {!! Form::open(['action' => ['shopping\FightController@destroy', $fight->id]]) !!}
                    {{ csrf_field() }}
                    {{ Form::hidden('_method','DELETE') }}
                    <button type="submit" class="btn btn-danger" onclick="return confirm('คุณต้องการลลบข้อมูลรายการชกมวยหรือไม่')"><i class="fa fa-trash fa-lg"></i></button>
                    {{ Form::close() }}
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div><!-- box-body -->
    </div><!-- box-body -->
  </div><!-- box-body -->
</div><!-- box-body -->

@endsection

@section('script')
  @include('layouts.component.errorMessage', ['title' => 'กรุณาลองใหม่อีกครั้ง','message' => 'ไม่สามารถเพิ่มข้อมูลครูฝึกสอนมวยไทยได้'])
@endsection