
@extends('layouts.adminlte')
@section('title','ข้อมูลการขายบัตร')
@section('header', $header)

@section('content')

  @include('marketing._sale.create_sale')
 

  <div class="row">
    @if(Auth::user()->role == 1)  
    @include('marketing.admin.sale_search')
    @elseif(Auth::user()->role == 2)
    @include('marketing.head.sale_search')
    @elseif(Auth::user()->role == 3)
    @include('marketing.head.sale_search')
    @endif()
  </div>
  
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-info">
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table style="font-size: 120%" class="table table-hover">
            <tr>
              <th class="center">ชื่อลูกค้า</th>
              <th class="center">เบอร์โทร</th>
              <th class="center">หมายเลขห้อง</th>
              <th class="center">เกสเฮาท์</th>
              <th class="center">บัตร</th>
              <th class="center">จำนวน</th>
              
              <th class="center">วันที่เข้ามาชมมวย</th>
              <th class="center">ขายโดย...</th>
              <th class="center">วันที่ขาย</th>
              <th class="right money">ยอดรวม</th>
              <th>แก้ไข</th>
              <th>ลบ</th>
            </tr>
            @foreach ($sales as $sale)
            <tr>
                <td>{{ $sale->customer_name }}</td>
                <td class="center">{{ $sale->customer_phone }}</td>
                <td class="center">{{ $sale->customer_room }}</td>
                <td class="center">{{ $sale->guesthouse->name }}</td>
                <td class="center">
                  <span class="label label-success">
                    {{ $sale->ticket->name }}
                  </span>
                </td>
                <td class="center">
                    <span class="label label-primary">
                      {{ $sale->amount }}
                    </span>
                </td>
                <td class="center">{{ $sale->visit }}</td>
                <td>{{ $sale->firstname }}&emsp;{{ $sale->lastname }}</td> 
                <td class="center">{{ date('d/m/Y', strtotime($sale->created_at)) }}</td>
                <td class="right money">
                  <span class="label label-danger">
                    {{ number_format($sale->total, 2, '.',',') }}
                  </span>
                </td>
                <td>
                    @if (Auth::user()->id == $sale->userId || Auth::user()->role == 1)  
                    <a href="/sale/{{ $sale->id }}/edit" class="btn btn-warning">
                      <i class="fa fa-edit fa-lg"></i>
                    </a>
                    @endif
                </td>
                <td>
                    @if (Auth::user()->id == $sale->userId  || Auth::user()->role == 1)  
                    {!! Form::open(['action' => ['marketing\SaleController@destroy', $sale->id]]) !!}
                      {{ csrf_field() }}
                    {{ Form::hidden('_method','DELETE') }}
                      <button type="submit" class="btn btn-danger" onclick="return confirm('ต้องการลบข้อมูลการขายหรือไม่')"><i class="fa fa-trash fa-lg"></i></button>
                    {{ Form::close() }}
                    @endif  
                </td>
              </tr>
            @endforeach
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
      <div class="col-md-12 mt-3">
          {!! Form::open(['url' => '/saleReport', 'method' => 'POST']) !!}
          {{ Form::token()}}
            <input type="hidden" value="{{ $range['start'] }}" name="start">
            <input type="hidden" value="{{ $range['end'] }}" name="end">
            <input type="hidden" value="{{ $zoneSelected }}" name="zoneId">
            <input type="hidden" value="{{ $saleTypeName }}" name="saleTypeName">
            <input type="submit" class="btn btn-success btn-block" value="ออกรายงาน">
          {!! Form::close() !!}
      </div>
  </div>

  @endsection()

@section('script')
  @include('layouts.component.errorMessage', ['title' => 'กรุณาป้อนข้อมูลการขายบัตรให้ถูกต้อง','message' => 'ไม่สามารถบันทึกข้อมูลการขายบัตรได้'])
@endsection