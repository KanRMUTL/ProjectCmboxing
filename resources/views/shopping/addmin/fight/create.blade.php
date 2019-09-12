<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    <i class="fa fa-lg fa-plus"></i> เพิ่มข้อมูลการชกมวย
</button>
<br><br>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูลการชกมวย</h4>
        </div>
        {!! Form::open(['url' => 'fight', 'method' => 'POST', 'files' => true]) !!}
        {{ Form::token()}}
        <div class="modal-body">
          <div class="form-group">
            <label for="name">วันที่ชก</label>
            <input type="date" class="form-control" id="name" name="day" value="{{ old('name') }}" required>
            @include('layouts.component.invalidFeedback', ['input' => 'name'])
          </div>
          <div class="form-group">
            <label for="img">รูปภาพ</label>
            <input type="file" id="img" name="img" value="{{ old('img') }}" required>
            @include('layouts.component.invalidFeedback', ['input' => 'img'])
          </div>
        </div>
        <div class="modal-footer form-group">
          <button type="submit" class="btn btn-primary"><i class="fa fa-lg fa-save"></i> บันทึก</button>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div><!-- Modal -->
 