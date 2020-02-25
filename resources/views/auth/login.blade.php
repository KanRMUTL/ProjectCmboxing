@extends('shopping.layout.master')
@section('title', 'Login')

@section('content')
<section class="mb-5 pb-5">
    <div class="row justify-content-center pt-5 mt-5 pb-5">
        <div class="col-md-12 heading-section ftco-animate text-center fadeInUp ftco-animated">
            <h2 class="mb-4">Login</h2>
        </div>
    </div>
    <div class="col-md-4 offset-md-4 ftco-animate fadeInUp ftco-animated">
        <form action="{{ route('login') }}" method="post" class="contact-form">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input type="submit" value="Login" class="btn btn-block btn-primary py-3 px-5">
            </div>
        </form>
    </div>
</section>
@endsection