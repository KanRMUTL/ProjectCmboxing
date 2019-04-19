<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    <i class="fa fa-lg fa-trainer"></i> เพิ่มครูสอน
</button>
<br><br>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">เพิ่มครูสอนมวยไทย</h4>
        </div>
        {!! Form::open(['url' => 'trainer', 'method' => 'POST', 'files' => true]) !!}
        {{ Form::token()}}
        <div class="modal-body">
          <div class="form-group">
            <label for="name">ชื่อครูสอน</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="form-group">
            <label for="detail">รายละเอียด</label>
            <textarea type="text" class="form-control" id="detail" name="detail"></textarea>
          </div>
          <div class="form-group">
            <label for="img">รูปภาพ</label>
            <input type="file" id="img" name="img">
          </div>
        </div>
        <div class="modal-footer form-group">
          <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
          <button type="submit" class="btn btn-primary">บันทึก</button>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div><!-- Modal -->