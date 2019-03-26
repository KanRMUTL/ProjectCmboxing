
@extends('layouts.adminlte')
@section('title','ข้อมูลรายได้นำเข้าสนามมวย')

@section('content')

{{-- Condition Search --}}
@if(Auth::user()->role ==1)
  @include('admin.income_search')
@elseif(Auth::user()->role == 2)
  @include('head.income_search')
@else
  @include('head.income_search')
@endif

  <div class="row">
    <div class="col-xs-12">
      <div class="box box box-info">
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table style="font-size: 120%" class="table table-hover">
            <tr>
              <th>ผู้ขาย</th>
              <th>ประเภทบัตร</th>
              <th>จำนวน</th>
              <th>ประเภทการขาย</th>
              <th>ยอดรวม</th>
              <th>นำเข้าสนามมวย</th>
              <th>วันที่</th>
            </tr>
            @foreach ($incomes as $income)
            <tr>
              <td>{{ $income->user['firstname'] }}&emsp;{{$income->user['lastname']}}</td>
              <td>{{$income->ticket->name}}</td>
              <td>{{ $income->amount}}</td>
              <td>{{ $income->sale_type_name }}</td>
              <th>{{ $income->total }}</th>
              <th>{{ $income->income }}</th>
              <td>{{ date('d/m/Y', strtotime($income->created_at)) }}</td>
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

