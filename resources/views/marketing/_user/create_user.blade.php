<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  <i class="fa fa-lg fa-user-plus"></i> เพิ่มผู้ใช้
</button>
@foreach ($errors->all() as $message)
<p class="text-red"> {{ $message }}</p>
@endforeach
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">ผู้ใช้ใหม่</h4>
      </div>
      {!! Form::open(['route' => 'user.store', 'method' => 'POST']) !!}
      {{ Form::token()}}
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="id_card">รหัสบัตรประชาชน</label>
              <input type="number" class="form-control" id="id_card" name="id_card" placeholder="รหัสบัตรประชาชน"
                value="">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="firstname">ชื่อ</label>
              <input type="text" class="form-control" id="firstname" name="firstname" placeholder="ชื่อ" value="">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="lastname">นามสกุล</label>
              <input type="text" class="form-control" id="lastname" name="lastname" placeholder="นามสกุล" value="">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="email">อีเมล์</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="อีเมล์" value="">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="phone_number">เบอร์โทร</label>
              <input type="number" class="form-control" id="phone_number" name="phone_number" placeholder="เบอร์โทรศัพท์" value="">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="input-group">
              <label>ที่อยู่</label>
              <textarea class="form-control" rows="3" cols="100" placeholder="ที่อยู่" name="address"></textarea>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-6">
            @if (auth::user()->role == 1)
            <!-- ถ้าเป็น Admin สามารถกำหนด ตำแหน่ง กับ โซน -->
            <label for="role">ตำแหน่ง</label>
            <div class="form-group" id="role">
              <select class="form-control" name="role">
                <option disabled selected>เลือกตำแหน่ง</option>
                @foreach ($roles as $key => $role)
                  @if ($loop->first)
                     @continue 
                  @endif
                  <option value="{{ $key }}">{{ $role}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <label for="zone">โซน</label>
            <div class="form-group" id="zone">
              <select class="form-control" name="zone">
              <option disabled selected>เลือกโซน</option>
                @foreach ($zones as $zone)
                <option value="{{ $zone->id }}">{{ $zone->name}}</option>
                @endforeach
              </select>
            </div>
            @else
            <!-- ถ้าไม่ใช่ Admin กำหนดตำแหน่งกับโซนไม่ได้ -->
            <input type="hidden" name="zone" value="{{  Auth::user()->employee->zone_id }}">
            <input type="hidden" name="role" value="3">
            @endif
          </div>
        </div>
        <div class="form-group">
          <label for="password">รหัสผ่าน</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="รหัสผ่าน">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="confirm_password" placeholder="ยืนยันรหัสผ่าน">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        <button type="submit" class="btn btn-primary">บันทึก</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div><!-- Modal -->