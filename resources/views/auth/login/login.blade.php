<section class="hero-area">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12 ">
          <div class="contact-h-cont">
            <h3 class="text-center"><img src="shopping/img/Logo.png" class="img-fluid" alt=""></h3><br>
            <form id="login-form" action="{{ route('login') }}" method="post">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text"class="form-control" name="username"  id="username" placeholder="Enter Username"> 
              </div>  
              <div class="form-group">
                <label for="exampleInputEmail1">Password</label>
                <input class="form-control"type="password" name="password"  value="hunter2" id="example-password-input"> 
              </div>   
              <button class="btn btn-general btn-blue" role="button"><i fa="" fa-right-arrow=""></i>Login</button>
            </form>
          </div>
      </div>
    </div>  
  </div>
</section>