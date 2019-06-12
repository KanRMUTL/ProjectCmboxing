@extends('auth.login.master')
@section('content')
<section class="hero-area">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12 ">
        <div class="contact-h-cont">
          <h3 class="text-center">Register</h3><br>

          <form class="form-horizontal" method="post" action="/customerRegister" enctype="multipart/form-data">
            {!! csrf_field() !!}

            <div class="form-group">
              <label for="img" class="cols-sm-2 control-label">Profile Image</label>
              <div class="cols-sm-10">
                <input type="file" name="img" id="img" class="form-control {{ $errors->has('img') ? 'is-invalid' : '' }}">

                @if($errors->has('img'))
                <div class="invalid-feedback">
                  {{$errors->first('img')}}
                </div>
                @endif
                
              </div>
            </div>

            <div class="form-group">
              <label for="username" class="cols-sm-2 control-label">Username</label>
              <div class="cols-sm-10">
                <input type="text" name="username" id="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" value="{{ old('username') }}">

                @if($errors->has('img'))
                  <div class="invalid-feedback">
                    {{$errors->first('username')}}
                  </div>
                @endif

              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-6">
                <label for="firstname" class="cols-sm-2 control-label">Your First Name</label>
                <div class="cols-sm-10">
                  <input type="text" name="firstname" id="firstname"
                    class="form-control {{ $errors->has('firstname') ? 'is-invalid' : '' }}"
                    value="{{ old('firstname') }}">

                  @if($errors->has('img'))
                    <div class="invalid-feedback">
                      {{$errors->first('firstname')}}
                    </div>
                  @endif

                </div>
              </div>

              <div class="form-group col-md-6">
                <label for="lastname" class="cols-sm-2 control-label">Your Last Name</label>
                <div class="cols-sm-10">
                  <input type="text" name="lastname" id="lastname"
                    class="form-control {{ $errors->has('lastname') ? 'is-invalid' : '' }}"
                    value="{{ old('lastname') }}">

                  @if($errors->has('img'))
                    <div class="invalid-feedback">
                      {{$errors->first('lastname')}}
                    </div>
                  @endif

                </div>
              </div>
            </div>


            <div class="form-group">
              <label for="email" class="cols-sm-2 control-label">Your Email</label>
              <div class="cols-sm-10">
                {{-- <div class="input-group"> --}}
                {{-- <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span> --}}
                <input type="text" name="email" id="email"
                  class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}">

                @if($errors->has('img'))
                  <div class="invalid-feedback">
                    {{$errors->first('email')}}
                  </div>
                @endif

              </div>
            </div>

            <div class="form-group">
              <label for="phone_number" class="cols-sm-2 control-label">Phone</label>
              <div class="cols-sm-10">
                <input type="number" name="phone_number" id="phone_number"
                  class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}"
                  value="{{ old('phone_number') }}">

                @if($errors->has('img'))
                  <div class="invalid-feedback">
                    {{$errors->first('phone_number')}}
                  </div>
                @endif

              </div>
            </div>

            <div class="form-group">
              <label for="address" class="cols-sm-2 control-label">Address</label>
              <div class="cols-sm-10">
                <textarea type="text" name="address" id="address"
                  class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}">{{ old('address') }}</textarea>

                @if($errors->has('img'))
                  <div class="invalid-feedback">
                    {{$errors->first('address')}}
                  </div>
                @endif

              </div>
            </div>

            <div class="form-group">
              <label for="password" class="cols-sm-2 control-label">Password</label>
              <div class="cols-sm-10">
                <input type="password" name="password" id="password"
                  class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" value="{{ old('password') }}">

                @if($errors->has('img'))
                  <div class="invalid-feedback">
                    {{$errors->first('password')}}
                  </div>
                @endif
                
              </div>
            </div>

            <div class="form-group">
              <label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
              <div class="cols-sm-10">
                <input type="password" name="password_confirmation" id="password_confirmation"
                  class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                  value="{{ old('password_confirmation') }}">

                @if($errors->has('img'))
                  <div class="invalid-feedback">
                    {{$errors->first('password_confirmation')}}
                  </div>
                @endif

              </div>
            </div>
            <div class="form-group ">
              <button class="btn btn-general btn-blue" role="button"><i fa="" fa-right-arrow=""></i>Register</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection