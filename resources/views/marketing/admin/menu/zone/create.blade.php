<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    <i class="fa fa-lg fa-plus"></i> เพิ่มโซนการตลาด
</button>
<br><br>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">เพิ่มโซนการตลาด</h4>
    </div>
    {!! Form::open(['route' => 'zone.store', 'method' => 'POST', 'files' => true]) !!}
    {{ Form::token()}}
    <div class="modal-body">
        <div class="form-group">
            <label for="name">ชื่อโซน</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="latitude">ละติจูด</label>
            <input type="text" class="form-control" id="latitude" name="latitude">
        </div>
        <div class="form-group">
            <label for="longitude">ละติจูด</label>
            <input type="text" class="form-control" id="longitude" name="longitude">
        </div>
    </div>
    <div class="modal-footer form-group">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-lg fa-ban"></i> ยกเลิก</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-lg fa-save"></i> บันทึก</button>
        {!! Form::close() !!}
    </div>
    </div>
</div>
</div><!-- Modal -->