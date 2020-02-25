{!! Form::open(['url' => $url, 'method' => 'POST']) !!}
    {{ Form::token()}}
    <input type="hidden" name="zoneId" value="{{  Auth::user()->employee->zone_id }}">
      <div class="col-12 col-md-2 form-group">
        <div class="input-group">
          <span class="input-group-addon">เริ่มต้น</span>
          <input type="date" class="form-control" value="{{ $range['start'] }}" name="start">
        </div>
        </div>
      <div class="col-12 col-md-2 form-group">
        <div class="input-group">
          <span class="input-group-addon">สิ้นสุด</span>
          <input type="date" class="form-control" value="{{ $range['end'] }}" name="end">
        </div>
      </div>
      <div class="col-12 col-md-2 form-group">
        <button type="submit" class="btn btn-primary" name="submit">
          <i class="fa fa-search fa-lg"></i>
          ค้นหา
        </button>
      </div>
{!! Form::close() !!}