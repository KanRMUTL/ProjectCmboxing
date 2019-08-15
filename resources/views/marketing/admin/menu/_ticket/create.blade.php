<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    <i class="fa fa-lg fa-ticket"></i> เพิ่มบัตร
</button>
<br><br>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">เพิ่มบัตรใหม่</h4>
    </div>
    {!! Form::open(['route' => 'ticket.store', 'method' => 'POST', 'files' => true]) !!}
    {{ Form::token()}}
    <div class="modal-body">
        <div class="form-group">
            <label for="name">ชื่อบัตร</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="username">ราคา</label>
            <input type="number" class="form-control" id="username" name="price">
        </div>
        <div class="form-group">
            <label for="commission">ค่าคอมมิชชั่นสำหรับไกด์</label>
            <input type="number" class="form-control" id="commission" name="commission">
        </div>
        <div class="form-group">
            <label for="image">รูปภาพ</label>
            <input type="file" id="image" name="image">
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