
@extends('layouts.adminlte')
@section('title','ข้อมูลการขายบัตร')
@section('header','ข้อมูลการขายบัตรของพนักงาน')

@section('content')

  @include('_sale.create_sale')

  <div class="row">
    @if(Auth::user()->role_id == 1)  
      @include('admin.sale_search')
    @elseif(Auth::user()->role_id == 2)
      @include('head.sale_search')
    @elseif(Auth::user()->role_id == 3)
      @include('head.sale_search')
    @endif()
  </div>

  <div class="row">
    <div class="col-xs-12">
      <div class="box box box-info">
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table style="font-size: 120%" class="table table-hover">
            <tr>
              <th>ชื่อลูกค้า</th>
              <th>เบอร์โทร</th>
              <th>หมายเลขห้อง</th>
              <th>เกสเฮาท์</th>
              <th>บัตร</th>
              <th>จำนวน</th>
              <th>ยอดรวม</th>
              <th>วันที่เข้ามาชมมวย</th>
              <th>ขายโดย...</th>
              <th>วันที่ขาย</th>
              <th>แก้ไข</th>
              <th>ลบ</th>
            </tr>
            @foreach ($sales as $sale)
            <tr>
                <td>{{ $sale->customer_name }}</td>
                <td>{{ $sale->customer_phone }}</td>
                <td>{{ $sale->customer_room }}</td>
                <td>{{ $sale->guesthouse->name }}</td>
                <td>
                  <span class="label label-success">
                    {{ $sale->ticket->name }}
                  </span>
                </td>
                <td>
                    <span class="label label-primary">
                      {{ $sale->amount }}
                    </span>
                </td>
                <td>
                  <span class="label label-danger">
                    {{ number_format($sale->total, 2, '.',',') }}
                  </span>
                </td>
                <td>{{ $sale->visit }}</td>
                <td>{{ $sale->user->name }}</td>
                <td>{{ date('d/m/Y', strtotime($sale->created_at)) }}</td>
                <td>
                    @if (Auth::user()->id == $sale->user_id || Auth::user()->role_id == 1)  
                    <a href="/sale/{{ $sale->id }}/edit" class="btn btn-warning">
                      <i class="fa fa-edit fa-lg"></i>
                    </a>
                    @endif
                </td>
                <td>
                    @if (Auth::user()->id == $sale->user_id  || Auth::user()->role_id == 1)  
                    {!! Form::open(['action' => ['marketing\SaleController@destroy', $sale->id]]) !!}
                      {{ csrf_field() }}
                    {{ Form::hidden('_method','DELETE') }}
                      <button type="submit" class="btn btn-danger"><i class="fa fa-trash fa-lg"></i></button>
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
  </div>

  @endsection()

