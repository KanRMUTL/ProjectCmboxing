
@extends('layouts.adminlte')
@section('title','ข้อมูลการขายบัตร')
@section('header','ข้อมูลการขายบัตร')

@section('content')

<!-- Button trigger modal -->
<div class="row">
  <div class="col-md-12">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
      <i class="fa fa-lg fa-ticket"></i> ขายบัตร
    </button>
  </div>  
</div>    
<br>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูลการขายบัตร</h4>
          </div>
          {!! Form::open(['route' => 'sale.store', 'method' => 'POST']) !!}
          {{ Form::token()}}
          <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
          <input type="hidden" name="zoneId" value="{{ Auth::user()->zone_id }}">
          <div class="modal-body">
            <div class="form-group">
              <label for="customerName">ชื่อ - นามสกุล(ของลูกค้า)</label>
              <input type="text" class="form-control" id="customerName" name="customerName" placeholder="ชื่อ - นามสกุล"  >
            </div>
            <div class="form-group">
              <label for="phone">เบอร์โทรศัพท์</label>
              <input type="text" class="form-control" maxlength="10" id="phone" name="customerPhone" placeholder="เบอร์โทรศัพท์" >
            </div>

            <div class="row"> <!-- Row-->
              <div class="col-md-6 col-sm-12">
                <div class="form-group">
                  <label for="customerRoom">หมายเลขห้องลูกค้า</label>
                  <input type="text" class="form-control" id="customerRoom" name="customerRoom" placeholder="หมายเลขห้อง" >
                </div>
              </div>

              <div class="col-md-6 col-sm-12">
                <label for="guesthouseId">เกสเฮาท์</label>
                <div class="form-group" id="guesthouseId">
                  <select class="form-control" name="guesthouseId">
                    @foreach ($guesthouses as $guesthouses)
                      <option value="{{ $guesthouses->id }}">{{ $guesthouses->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

            </div>  <!-- end Row-->

            <div class="form-group">
                <label for="visitDay">วันที่เข้ามาชม</label>
                <input type="date" class="form-control" id="visitDay" name="visitDay">
              </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                <label for="ticketId">ประเภทบัตร</label>
                <div class="form-group" id="ticketId">
                  <select class="form-control" name="ticketId">
                    @foreach ($tickets as $ticket)
                    <option value="{{ $ticket->id }}">{{ $ticket->name}} ({{ number_format($ticket->price, 2, '.',',') }})</option>
                  @endforeach
                  </select>
                </div>
              </div>
          
              <div class="col-md-6 col-sm-12">
                <label for="amount">จำนวนบัตร</label>
                <input type="number" class="form-control" id="visitDay" name="amount" placeholder="จำนวน" >
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            <button type="submit" class="btn btn-primary">บันทึก</button>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div><!-- Modal -->

  <div class="row">
    {!! Form::open(['route' => 'sale.search', 'method' => 'POST']) !!}
    {{ Form::token()}}
      <div class="col-md-2 form-group">
      <input type="date" class="form-control" value="{{ $range['start'] }}" name="start">
      </div>
      <div class="col-md-2 form-group">
        <input type="date" class="form-control" value="{{ $range['end'] }}" name="end">
      </div>
      @if(Auth::user()->role_id == 1)
        <div class="col-md-2">
          <select name="zoneId" class="form-control">
            @foreach ($zones as $zone)
              @if ($zone->id == $zoneSelected)
                <option value="{{ $zone->id }}" selected>โซน {{ $zone->name }}</option>
                @continue
              @endif
              <option value="{{ $zone->id }}">โซน {{ $zone->name }}</option>
            @endforeach
          </select>
        </div>
      @else
      <input type="hidden" name="zoneId" value="{{ Auth::user()->zone_id }}">
      @endif
      
      <div class="col-md-2 form-group">
        <button type="submit" class="btn btn-primary" name="submit">
          <i class="fa fa-search fa-lg"></i>
          ค้นหา
        </button>
      </div>
    {!! Form::close() !!}
  </div>

  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table class="table table-hover">
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
                {{-- <td><span class="label label-success">Approved</span></td>
                <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td> --}}
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

