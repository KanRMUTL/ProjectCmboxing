<!--====================================================
                     Navbar
======================================================--> 
<header>
    
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav" data-toggle="affix">
        <div class="container">
        <a class="navbar-brand smooth-scroll" href="/">
            <img src="shopping/img/logo.png" id="logo" alt="logo" style="height:55px">
        </a> 
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"> 
                <span class="navbar-toggler-icon"></span>
        </button>  
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item" ><a class="nav-link smooth-scroll" href="/">Home</a></li>
                <li class="nav-item" ><a class="nav-link smooth-scroll" href="/seat">Booking</a></li>
                <li class="nav-item" ><a class="nav-link smooth-scroll" href="/courses">Training Muay Thai</a></li>
                <li class="nav-item" ><a class="nav-link smooth-scroll" href="/about">About</a></li>
                <li class="nav-item" ><a class="nav-link smooth-scroll" href="/contact">Contact</a></li>
                @if(Auth::check())
                <li class="nav-item" ><a class="nav-link smooth-scroll" href="/dashboard">{{ Auth::user()->firstname }}&emsp;{{ Auth::user()->lastname }}</a></li>
                @else
                <li class="nav-item" ><a class="nav-link smooth-scroll" href="/login">Login</a></li>
                @endif
            </ul>  
        </div>
        </div>
    </nav>
</header>