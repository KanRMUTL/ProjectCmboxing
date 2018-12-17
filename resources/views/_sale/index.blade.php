
@extends('layouts.adminlte')
@section('title','ข้อมูลการขายบัตร')
@section('header','ข้อมูลการขายบัตร')

@section('content')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  <i class="fa fa-lg fa-ticket"></i> ขายบัตร
</button>
  
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
              <input type="date" class="form-control" id="visitDay" name="visitDay" placeholder="เบอร์โทรศัพท์" >
            </div>
          <div class="row">
              <div class="col-md-6 col-sm-12">
              <label for="ticketId">ประเภทบัตร</label>
              <div class="form-group" id="ticketId">
                <select class="form-control" name="ticketId">
                  @foreach ($tickets as $ticket)
                  <option value="{{ $ticket->id }}">{{ $ticket->name}} ({{ $ticket->price }})</option>
                @endforeach
                </select>
              </div>
            </div>
        
            <div class="col-md-6 col-sm-12">
              <label for="amount">จำนวนบัตร</label>
              <div class="form-group" id="amount">
                <select class="form-control" name="amount">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
              </div>
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
    <div class="col-xs-12">
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
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
              <th>แก้ไข</th>
              <th>ลบ</th>
            </tr>
            @foreach ($sales as $sale)
            <tr>
                <td>{{ $sale->customer_name }}</td>
                <td>{{ $sale->customer_phone }}</td>
                <td>{{ $sale->customer_room }}</td>
                <td>{{ $sale->guesthouse->name }}</td>
                <td><span class="label label-success">{{ $sale->ticket->name }}</span></td>
                <td>{{ $sale->amount }}</td>
                <td><span class="label label-danger">{{ $sale->total }}</span></td>
                <td>{{ $sale->visit }}</td>
                <td>{{ $sale->user->name }}</td>
                <td>
                    @if (Auth::user()->id == $sale->user_id)  
                    <a href="/sale/{{ $sale->id }}/edit" class="btn btn-warning">
                      <i class="fa fa-edit fa-lg"></i>
                    </a>
                    @endif
                </td>
                <td>
                    @if (Auth::user()->id == $sale->user_id)  
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

