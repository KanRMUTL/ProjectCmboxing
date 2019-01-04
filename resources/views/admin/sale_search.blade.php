{!! Form::open(['url' => $url, 'method' => 'POST']) !!}
    {{ Form::token()}}
      <div class="col-md-2 col-xs-6 form-group">
        <input type="date" class="form-control" value="{{ $range['start'] }}" name="start">
      </div>
      <div class="col-md-2 form-group col-xs-6">
        <input type="date" class="form-control" value="{{ $range['end'] }}" name="end">
      </div>
        <div class="col-md-2 col-xs-6 form-group">
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
      <div class="col-md-2 col-xs-6 form-group">
        <div class="float-right">
          <button type="submit" class="btn btn-primary" name="submit">
            <i class="fa fa-search fa-lg"></i>
            ค้นหา
          </button>
        </div>
      </div>
{!! Form::close() !!}