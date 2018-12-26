{!! Form::open(['route' => 'searchSaleByEmp', 'method' => 'POST']) !!}
    {{ Form::token()}}
    <input type="hidden" name="zoneId" value="{{ Auth::user()->zone_id }}">
      <div class="col-md-2 form-group">
      <input type="date" class="form-control" value="{{ $range['start'] }}" name="start">
      </div>
      <div class="col-md-2 form-group">
        <input type="date" class="form-control" value="{{ $range['end'] }}" name="end">
      </div>
      <div class="col-md-2 form-group">
        <button type="submit" class="btn btn-primary" name="submit">
          <i class="fa fa-search fa-lg"></i>
          ค้นหา
        </button>
      </div>
{!! Form::close() !!}