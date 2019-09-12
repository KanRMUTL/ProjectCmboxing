<div class="col-md-12 mt-3">
    {!! Form::open(['url' => '/EmpCommissionReport', 'method' => 'GET']) !!}
    {{ Form::token()}}
      <input type="hidden" value="{{ $range['start'] }}" name="start">
      <input type="hidden" value="{{ $range['end'] }}" name="end">
      <input type="hidden" value="{{ $zoneSelected }}" name="zoneId">
      <input type="submit" class="btn btn-success btn-block" value="ออกรายงาน">
    {!! Form::close() !!}
  </div>