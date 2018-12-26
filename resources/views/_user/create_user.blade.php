
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
        <i class="fa fa-lg fa-user-plus"></i> เพิ่มผู้ใช้
      </button>
        
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
                <div class="form-group">
                  <label for="name">ชื่อ</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="ชื่อ - นามสกุล"  value="">
                </div>
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Username"  value="">
                </div>
                <div class="form-group">
                  <label for="email">อีเมล์</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="อีเมล์"  value="">
                </div>
      
                @if (auth::user()->role_id == 1)  <!-- ถ้าเป็น Admin สามารถกำหนด ตำแหน่ง กับ โซน -->
                <label for="role">ตำแหน่ง</label>
                <div class="form-group" id="role">
                  <select class="form-control" name="role">
                 
                    <option disabled selected>เลือกตำแหน่ง</option>
                    @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name}}</option>
                  @endforeach
                  </select>
                </div>
                    <label for="zone">โซน</label>
                <div class="form-group" id="zone">
                  <option disabled selected>เลือกโซน</option>
                  <select class="form-control" name="zone">
                    @foreach ($zones as $zone)
                      <option value="{{ $zone->id }}">{{ $zone->name}}</option>
                    @endforeach
                  </select>
                </div>
                @else <!-- ถ้าไม่ใช่ Admin กำหนดตำแหน่งกับโซนไม่ได้ -->
                  <input type="hidden" name="zone" value="{{ auth::user()->zone_id }}">
                  <input type="hidden" name="role" value="3">
                @endif
      
                <div class="form-group">
                  <label for="password">รหัสผ่าน</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="รหัสผ่าน" value="password">
                </div>
                <div class="form-group">
                <input type="password" class="form-control"  name="confirm_password" placeholder="ยืนยันรหัสผ่าน" value="password">
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