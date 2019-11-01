@extends('shopping.layout.master')
@section('title', 'Register')
@section('content')

@include('shopping.layout.default_banner')

<section class="pb-5">
    <div class="row justify-content-center pt-5 ">
        <div class="col-md-12 heading-section ftco-animate text-center fadeInUp ftco-animated">
          <h2 class="mb-4">Register</h2>
        </div>
      </div>
      <div class="col-md-4 offset-md-4">
        
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
              <div class="cols-sm-10">
                <input type="text" name="username" placeholder="Username" id="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" value="{{ old('username') }}">

                @if($errors->has('img'))
                  <div class="invalid-feedback">
                    {{$errors->first('username')}}
                  </div>
                @endif

              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-6">
                <div class="cols-sm-10">
                  <input type="text" name="firstname" placeholder="Firstname" id="firstname"
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
                <div class="cols-sm-10">
                  <input type="text" name="lastname" placeholder="Lastname" id="lastname"
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
              <div class="cols-sm-10">
                <input type="text" name="email" placeholder="Email" id="email"
                  class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}">

                @if($errors->has('img'))
                  <div class="invalid-feedback">
                    {{$errors->first('email')}}
                  </div>
                @endif

              </div>
            </div>

            <div class="form-group">
              <div class="cols-sm-10">
                <input type="number"  placeholder="Phone" name="phone_number" id="phone_number"
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
              <div class="cols-sm-10">
                <input type="password" name="password"  placeholder="Password" id="password" 
                  class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" value="{{ old('password') }}">

                @if($errors->has('img'))
                  <div class="invalid-feedback">
                    {{$errors->first('password')}}
                  </div>
                @endif
                
              </div>
            </div>

            <div class="form-group">
              <div class="cols-sm-10">
                <input type="password"  placeholder="Confirm Password" name="password_confirmation" id="password_confirmation"
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
              <button class="btn btn-primary btn-block" role="button"><i fa="" fa-right-arrow=""></i>Register</button>
            </div>
          </form>
      </div>
    </div>
</section>

@endsection