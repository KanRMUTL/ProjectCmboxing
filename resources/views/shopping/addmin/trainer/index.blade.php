@extends('layouts.adminlte')
@section('title', 'จัดการครูสอน')
@section('header','จัดการข้อมูลครูสอนมวยไทย')
@section('content')

@include('shopping.addmin.trainer.create')

<div class="row">
  <div class="col-xs-12 col-md-12 col-sm-12">
    <div class="box box box-info">
      <!-- /.box-header -->
      <div class="box-body table-responsive">
        <table style="font-size: 120%" class="table table-striped table-hover" >
          <thead>
            <tr align="center" style="text-align-last: center;">
              <th style="width: 30%;">ชื่อครูสอน</th>
              <th style="width: 35%;">รายละเอียด</th>
              <th style="width:10%;">รูปประจำตัว</th>
              <th>แก้ไข</th>
              <th>ลบ</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($trainers as $trainer)
            <tr align="center">
                <td>{{ $trainer->name}}</td>
                <td>{{ $trainer->detail}}</td>
                <td>
                    <img src="{{ URL::to('/') }}/shopping/img/trainer/{{$trainer->img}}" style="width:100%;" align="center">
                </td>
                <td>
                <a href="/trainer/{{ $trainer->id }}/edit" class="btn btn-warning">
                    <i class="fa fa-edit fa-lg"></i>
                </a>
                </td>
                <td>
                    {!! Form::open(['action' => ['shopping\TrainerController@destroy', $trainer->id]]) !!}
                    {{ csrf_field() }}
                    {{ Form::hidden('_method','DELETE') }}
                    <button type="submit" class="btn btn-danger" onclick="return confirm('คุณต้องการลลบข้อมูลครูสอนหรือไม่')"><i class="fa fa-trash fa-lg"></i></button>
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