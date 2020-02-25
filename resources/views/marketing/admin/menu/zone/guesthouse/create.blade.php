<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    <i class="fa fa-lg fa-plus"></i> เพิ่มเกสเฮาท์
</button>
<br><br>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">เพิ่มเกสเฮาท์</h4>
    </div>
    {!! Form::open(['route' => 'guesthouse.store', 'method' => 'POST', 'files' => true]) !!}
    {{ Form::token()}}
    <div class="modal-body">
        <div class="form-group">
            <label for="name">ชื่อเกสเฮาท์</label>
            <input type="text" class="form-control" id="name" name="name">
            <input type="hidden" class="form-control" name="zone_id" value="{{$zone->id}}">
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