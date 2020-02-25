<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  <i class="fa fa-lg fa-user-plus"></i> เพิ่มพนักงาน
</button>
<br>
<br>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">เพิ่มพนักงาน</h4>
      </div>

      {!! Form::open(['route' => 'user.store', 'method' => 'POST', 'files' => true]) !!}
      {{ Form::token()}}
      <div class="modal-body">
       
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="firstname">ชื่อ</label>
              <input type="text" class="form-control" id="firstname" name="firstname" placeholder="ชื่อ" value="{{ old('firstname') }}" required>
              @include('layouts.component.invalidFeedback', ['input' => 'firstname'])
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="lastname">นามสกุล</label>
              <input type="text" class="form-control" id="lastname" name="lastname" placeholder="นามสกุล" value="{{ old('lastname') }}" required>
              @include('layouts.component.invalidFeedback', ['input' => 'lastname'])
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{ old('username') }}" required>
              @include('layouts.component.invalidFeedback', ['input' => 'username'])
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="id_card">รหัสบัตรประชาชน</label>
              <input type="number" class="form-control" id="id_card" name="id_card" placeholder="รหัสบัตรประชาชน" value="{{ old('id_card') }}" required>
                @include('layouts.component.invalidFeedback', ['input' => 'id_card'])
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="email">อีเมล์</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="อีเมล์" value="{{ old('email') }}" required>
              @include('layouts.component.invalidFeedback', ['input' => 'email'])
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="phone_number">เบอร์โทร</label>
              <input type="number" class="form-control" id="phone_number" name="phone_number" placeholder="เบอร์โทรศัพท์" value="{{ old('phone_number') }}" required>
              @include('layouts.component.invalidFeedback', ['input' => 'phone_number'])
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="input-group">
              <label>ที่อยู่</label>
              <textarea class="form-control" rows="3" cols="100" placeholder="ที่อยู่" name="address" required>{{ old('address') }}</textarea>
              @include('layouts.component.invalidFeedback', ['input' => 'address'])
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

              @foreach($roles as $key => $role)
              @if ($loop->first)
                  @continue 
              @endif
              <div class="form-check form-check-inline" id="check">
                <input class="form-check-input" type="radio" id="{{ $key }}" name="role" value="{{ $key+1 }}">
                <label class="form-check-label" for="{{ $key }}">
                    {{ $role}}
                </label>
              </div>
              @endforeach
              @include('layouts.component.invalidFeedback', ['input' => 'role'])
            </div>
          </div>
          <div class="col-md-6">
            <label for="zone">โซน</label>
            <div class="form-group" id="zone">
              <select class="form-control" name="zone_id" required>
              <option disabled selected>เลือกโซน</option>
                @foreach ($zones as $zone)
                <option value="{{ $zone->id }}">{{ $zone->name}}</option>
                @endforeach
              </select>
              @include('layouts.component.invalidFeedback', ['input' => 'zone_id'])
            </div>
            @else
            <!-- ถ้าไม่ใช่ Admin กำหนดตำแหน่งกับโซนไม่ได้ -->
            <input type="hidden" name="zone_id" value="{{  Auth::user()->employee->zone_id }}">
            <input type="hidden" name="role" value="3">
            @endif
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="img">รูปประจำตัว</label>
              <input type="file" id="img" name="img" class="form-control" required>
              @include('layouts.component.invalidFeedback', ['input' => 'img'])
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="password">รหัสผ่าน</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="รหัสผ่าน" required>
          @include('layouts.component.invalidFeedback', ['input' => 'password'])
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="password_confirmation" placeholder="ยืนยันรหัสผ่าน" required>
          @include('layouts.component.invalidFeedback', ['input' => 'password_confirmation'])
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-lg fa-ban"></i> ยกเลิก</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-lg fa-save"></i> บันทึก</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div><!-- Modal -->