@extends('layouts.adminlte')
@section('title','แก้ไขข้อมูลการขายบัตร')
@section('header','แก้ไขการขายบัตร')

@section('content')
{!! Form::open(['route' => ['sale.update', $sale->id ], 'method' => 'PUT']) !!}
{{ Form::token()}}
<div class="modal-content">
  <div class="modal-header">
    <h4 class="modal-title" id="myModalLabel">{{$sale->customer_name}}</h4>
  </div>
  <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
  <div class="modal-body">
    <div class="form-group">
      <label for="customerName">ชื่อ - นามสกุล(ของลูกค้า)</label>
      <input type="text" class="form-control" id="customerName" name="customerName" value="{{$sale->customer_name}}">
    </div>
    <div class="form-group">
      <label for="phone">เบอร์โทรศัพท์</label>
      <input type="number" class="form-control" id="phone" name="customerPhone" value="{{$sale->customer_phone}}">
    </div>

    <div class="row">
      <!-- Row-->
      <div class="col-md-6 col-sm-12">
        <div class="form-group">
          <label for="customerRoom">หมายเลขห้องลูกค้า</label>
          <input type="text" class="form-control" id="customerRoom" name="customerRoom" value="{{$sale->customer_room}}">
        </div>
      </div>

      <div class="col-md-6 col-sm-12">
        <label for="guesthouseId">เกสเฮาท์</label>
        <div class="form-group" id="guesthouseId">
          <select class="form-control" name="guesthouseId">
            @foreach ($guesthouses as $guesthouse)
            {{ $selected = ''}}
            @if($sale->guesthouse_id == $guesthouse->id)
            {{ $selected = 'selected' }}
            @endif
            <option value="{{ $guesthouse->id }}" {{ $selected }}>{{ $guesthouse->name }} </option>
            @endforeach
          </select>
        </div>
      </div>

    </div> <!-- end Row-->

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="visitDay">วันที่เข้ามาชม</label>
          <input type="date" class="form-control" id="visitDay" name="visitDay" value="{{ $visit }}">
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <label for="ticketId">ประเภทการขาย</label>
        <div class="form-group" id="ticketId">
          <select class="form-control" name="saleTypeId">
            @foreach ($saleTypes as $saleType)
              @if ($sale->sale_type == $saleType->id)
              <option value="{{ $saleType->id }}" selected>{{ $saleType->name}}</option>
              @continue
              @endif
              <option value="{{ $saleType->id }}">{{ $saleType->name}}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-sm-12">
        <label for="ticketId">ประเภทบัตร</label>
        <div class="form-group" id="ticketId">
          <select class="form-control" name="ticketId">
            @foreach ($tickets as $ticket)
            {{ $selected = ''}}
            @if($sale->ticket_id == $ticket->id)
            {{ $selected = 'selected' }}
            @endif
            <option value="{{ $ticket->id }}" {{ $selected }}>{{ $ticket->name}} ({{ $ticket->price }})</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="col-md-6 col-sm-12">
        <label for="amount">จำนวนบัตร </label>
        <div class="form-group" id="amount">
          <input type="number" name="amount" class="form-control" value="{{ $sale->amount }}">
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">บันทึก</button>
  </div>
</div>
<!-- /.box -->
{!! Form::close() !!}
@stop()