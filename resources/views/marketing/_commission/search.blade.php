<div class="row">
    {!! Form::open(['route' => 'empCommission.search', 'method' => 'POST']) !!}
    {{ Form::token()}}
      <input type="hidden" name="zoneId" value="{{  Auth::user()->employee->zone_id }}">
      <div class="col-md-2 col-xs-6 form-group">
        <div class="input-group">
            <span class="input-group-addon">เริ่มต้น</span>
            <input type="date" class="form-control" value="{{ $range['start'] }}" name="start">
        </div>
      </div>
      <div class="col-md-2 col-xs-6 form-group">
        <div class="input-group">
          <span class="input-group-addon">สิ้นสุด</span>
          <input type="date" class="form-control" value="{{ $range['end'] }}" name="end">
        </div>
      </div>
      @if(auth::user()->role == 1)
      <div class="col-md-2 col-xs-6 form-group">
        <select name="zoneId" class="form-control">
          @foreach ($zones as $zone)
            @if (isset($zoneSelected) && $zone->id == $zoneSelected   )
              <option value="{{ $zone->id }}" selected>โซน {{ $zone->name }}</option>
              @continue
            @endif
            <option value="{{ $zone->id }}">โซน {{ $zone->name }}</option>
          @endforeach
        </select>
      </div>
      @endif
      <div class="col-md-2 col-xs-6 form-group">
        <button type="submit" class="btn btn-primary" name="submit">
          <i class="fa fa-search fa-lg"></i>
          ค้นหา
        </button>
      </div>
    {!! Form::close() !!}
  </div>