@extends('layouts.adminlte')
@section('title','แก้ไขข้อมูลการขายบัตร')
@section('header-class', 'center')
@section('header','แก้ไขการขายบัตร')

@section('content')
{!! Form::open(['route' => ['sale.update', $sale->id ], 'method' => 'PUT']) !!}
{{ Form::token()}}
<div class="modal-content col-md-6 col-md-offset-3">
  <div class="modal-header">
    <h4 class="modal-title" id="myModalLabel">{{$sale->customer_name}}</h4>
  </div>
  <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
  <div class="modal-body">
    <div class="form-group">
      <label for="customerName">ชื่อ - นามสกุล(ของลูกค้า)</label>
      <input type="text" class="form-control" id="customerName" name="customerName" value="{{$errors->has('customerName') ? old('customerName') : $sale->customer_name}}">
      @include('layouts.component.invalidFeedback', ['input' => 'customerName'])
    </div>
    <div class="form-group">
      <label for="phone">เบอร์โทรศัพท์</label>
      <input type="number" class="form-control" id="phone" name="customerPhone" value="{{$errors->has('customerPhone') ? old('customerPhone') : $sale->customer_phone}}">
      @include('layouts.component.invalidFeedback', ['input' => 'customerPhone'])
    </div>

    @if($sale->sale_type != 3)
    <div class="row">
      <!-- Row-->
      <div class="col-md-6 col-sm-12">
        <div class="form-group">
          <label for="customerRoom">หมายเลขห้องลูกค้า</label>
          <input type="text" class="form-control" id="customerRoom" name="customerRoom" value="{{$errors->has('customerRoom') ? old('customerRoom') : $sale->customer_room}}">
          @include('layouts.component.invalidFeedback', ['input' => 'customerRoom'])
        </div>
      </div>

      <div class="col-md-6 col-sm-12">
        <label for="guesthouseId">เกสเฮาท์</label>
        <div class="form-group" id="guesthouseId">
          <select class="form-control" name="guesthouseId">
            @foreach ($guesthouses as $guesthouse)
              @if($sale->guesthouse_id == $guesthouse->id)
                <option value="{{ $guesthouse->id }}" selected>{{ $guesthouse->name }} </option>
                @continue
              @endif
              <option value="{{ $guesthouse->id }}">{{ $guesthouse->name }} </option>
            @endforeach
          </select>
          @include('layouts.component.invalidFeedback', ['input' => 'guesthouseId'])
        </div>
      </div>

    </div> <!-- end Row-->
    @endif

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="visitDay">วันที่เข้ามาชม</label>
          <input type="date" class="form-control" id="visitDay" name="visitDay" value="{{ $errors->has('visitDay') ? old('visitDay') : $visit }}">
          @include('layouts.component.invalidFeedback', ['input' => 'visitDay'])
        </div>
    </div>

    @if($sale->sale_type != 3)
    <div class="col-md-6 col-sm-12">
        <label for="check">ประเภทการขาย</label>

       
        @foreach ($saleTypes as $key => $saleType)
          <div class="form-check form-check-inline" id="check">
              <input class="form-check-input" type="radio" name="saleTypeId" id="type{{ $errors->isEmpty() ? $key : old('saleTypeId') }}" value="{{  $errors->isEmpty() ? $key : old('saleTypeId') }}" {{ $sale->sale_type == $key ? 'checked' : null}}>
              <label class="form-check-label" for="type{{ $errors->isEmpty() ? $key : old('saleTypeId') }}">
                  {{ $saleType }}
              </label>
          </div>
          @include('layouts.component.invalidFeedback', ['input' => 'saleTypeId'])
          @endforeach

      </div>
    @else
      <input type="hidden" name="saleTypeId" value="3">
    @endif

    </div>
    <div class="row">
      <div class="col-md-6 col-sm-12">
        <label for="ticketId">ประเภทบัตร</label>
        <div class="form-group" id="ticketId">
          <select class="form-control" name="ticketId">
            @foreach ($tickets as $ticket)
              @if($sale->ticket_id == $ticket->id)
                <option value="{{ $ticket->id }}" selected>{{ $ticket->name}} ({{ $ticket->price }})</option>
                @continue
              @endif
              <option value="{{ $ticket->id }}">{{ $ticket->name}} ({{ $ticket->price }})</option>
            @endforeach
          </select>
          @include('layouts.component.invalidFeedback', ['input' => 'ticketId'])
        </div>
      </div>

      <div class="col-md-6 col-sm-12">
        <label for="amount">จำนวนบัตร </label>
        <div class="form-group" id="amount">
          <input type="number" name="amount" class="form-control" value="{{ $errors->has('amount') ? old('amount') : $sale->amount }}">
          @include('layouts.component.invalidFeedback', ['input' => 'amount'])
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary"><i class="fa fa-lg fa-save"></i> บันทึก</button>
  </div>
</div>
<!-- /.box -->
{!! Form::close() !!}
  @if($errors->any())
    @foreach($errors->all() as $error)
    <p>{{$error}}</p>
    @endforeach
  @endif
@endsection

@section('script')
  @include('layouts.component.errorMessage', ['title' => 'กรุณาป้อนข้อมูลการขายบัตรให้ถูกต้อง','message' => 'ไม่สามารถแก้ไขข้อมูลการขายบัตรได้'])
@endsection