
@extends('layouts.adminlte')
@section('title','ข้อมูลรายได้นำเข้าสนามมวย')

@section('content')

{{-- Condition Search --}}
@if(Auth::user()->role ==1)
  @include('marketing.admin.income_search')
@elseif(Auth::user()->role == 2)
  @include('marketing.head.income_search')
@else
  @include('marketing.head.income_search')
@endif

  <div class="row">
    <div class="col-xs-12">
      <div class="box box box-info">
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table style="font-size: 120%" class="table table-hover center">
            <tr>
              <th class="center">ผู้ขาย</th>
              <th class="center">ประเภทบัตร</th>
              <th class="center">จำนวนบัตร</th>
              <th  class="center">ประเภทการขาย</th>
              <th class="right" style="width: 10%;">ยอดรวม</th>
              <th class="right" style="width: 10%;">นำเข้าสนามมวย</th>
              <th class="center">วันที่</th>
            </tr>
            @foreach ($incomes as $income)
            <tr>
              <td>{{ $income->user['firstname'] }}&emsp;{{$income->user['lastname']}}</td>
              <td>{{ $income->ticket->name }}</td>
              <td>{{ $income->amount }}</td>
              <td>{{ $income->sale_type_name }}</td>
              <th class="right">{{ number_format($income->total, 2, '.',',') }}</th>
              <th class="right">{{ number_format($income->income, 2, '.',',') }}</th>
              <td class="center">{{ date('d/m/Y', strtotime($income->created_at)) }}</td>
            </tr>
            @endforeach
          </table>
          <div class="col-md-12 mt-3">
            <form action="/incomeReport" method="POST" target="_blank">
              {{@csrf_field()}}
              <input type="hidden" value="{{ $range['start'] }}" name="start">
              <input type="hidden" value="{{ $range['end'] }}" name="end">
              <input type="hidden" value="{{ $zoneSelected }}" name="zoneId">
              <input type="submit" class="btn btn-success btn-block" value="ออกรายงาน">
            </form>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>

  @endsection()

