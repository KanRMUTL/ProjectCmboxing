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
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูลการขายบัตร</h4>
      </div>
      {!! Form::open(['route' => 'sale.store', 'method' => 'POST']) !!}
      {{ Form::token()}}
      <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
      <input type="hidden" name="zoneId" value="{{ Auth::user()->employee->zone_id }}">
      <div class="modal-body">
        <div class="form-group">
            <label for="customerName">ชื่อ - นามสกุล(ของลูกค้า)</label>
            <input type="text" class="form-control" id="customerName" name="customerName" placeholder="ชื่อ - นามสกุล" value="{{ old('customerName') }}">
            @include('layouts.component.invalidFeedback', ['input' => 'customerName'])
        </div>
        <div class="form-group">
          <label for="phone">เบอร์โทรศัพท์</label>
          <input type="number" class="form-control" maxlength="10" id="phone" name="customerPhone"
            placeholder="เบอร์โทรศัพท์" value="{{ old('customerPhone') }}">
            @include('layouts.component.invalidFeedback', ['input' => 'customerPhone'])
        </div>

        @if($saleTypeName != 'walkin')
        <div class="row">
          <!-- Row-->
          <div class="col-md-6 col-sm-12">
            <div class="form-group">
              <label for="customerRoom">หมายเลขห้องลูกค้า</label>
              <input type="text" class="form-control" id="customerRoom" name="customerRoom" placeholder="หมายเลขห้อง" value="{{ old('customerRoom') }}">
              @include('layouts.component.invalidFeedback', ['input' => 'customerRoom'])
            </div>
          </div>

          <div class="col-md-6 col-sm-12">
            <label for="guesthouseId">เกสเฮาท์</label>
            <div class="form-group" id="guesthouseId">
              <select class="form-control" name="guesthouseId" value="{{ old('guesthouseId') }}">
                @foreach ($guesthouses as $guesthouse)
                <option value="{{ $guesthouse->id }}">{{ $guesthouse->name }}</option>
                @endforeach
              </select>
              @include('layouts.component.invalidFeedback', ['input' => 'guesthouseId'])
            </div>
          </div>

        </div> <!-- end Row-->
        @endif
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="form-group">
              <label for="visitDay">วันที่เข้ามาชม</label>
              <input type="date" class="form-control" id="visitDay" name="visitDay" value="{{ old('visitDay') }}">
              @include('layouts.component.invalidFeedback', ['input' => 'visitDay'])
            </div>
          </div>

          @if($saleTypeName != 'walkin')
          <div class="col-md-6 col-sm-12">
            <label for="ticketId">ประเภทการขาย</label>
            <div class="form-group" id="ticketId">
              <select class="form-control" name="saleTypeId" value="{{ old('saleTypeId') }}">
                @foreach ($saleTypes as $key => $saleType)
                <option value="{{ $key }}">{{ $saleType }}</option>
                @endforeach
              </select>
              @include('layouts.component.invalidFeedback', ['input' => 'saleTypeId'])
            </div>
          </div>
          @else
            <input type="hidden" name="saleTypeId" value="3">
          @endif

        </div>
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <label for="ticketId">ประเภทบัตร</label>
            <div class="form-group" id="ticketId">
              <select class="form-control" name="ticketId" value="{{ old('ticketId') }}">
                @foreach ($tickets as $ticket)
                <option value="{{ $ticket->id }}">{{ $ticket->name}} ({{ number_format($ticket->price, 2, '.',',') }})
                </option>
                @endforeach
              </select>
              @include('layouts.component.invalidFeedback', ['input' => 'ticketId'])
            </div>
          </div>

          <div class="col-md-6 col-sm-12">
            <label for="amount">จำนวนบัตร</label>
            <input type="number" class="form-control" id="amount" name="amount" placeholder="จำนวน" value="{{ old('amount') }}">
            @include('layouts.component.invalidFeedback', ['input' => 'amount'])
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