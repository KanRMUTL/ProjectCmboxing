<!--====================================================
                     Navbar
======================================================--> 
<header>
    
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav" data-toggle="affix">
        <div class="container">
        <a class="navbar-brand smooth-scroll" href="/">
            <img src="{{ asset('shopping/img/logo.png') }}" id="logo" alt="logo" style="height:55px">
        </a> 
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"> 
            <span class="navbar-toggler-icon"></span>
        </button>  
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item" ><a class="nav-link smooth-scroll" href="/">Home</a></li>
                <li class="nav-item" ><a class="nav-link smooth-scroll" href="/booking">Booking</a></li>
                <li class="nav-item" ><a class="nav-link smooth-scroll" href="/courses">Training Muay Thai</a></li>
                <li class="nav-item" ><a class="nav-link smooth-scroll" href="/about">About</a></li>

                @if(Auth::check())
                   
                    <li class="nav-item dropdown" >
                        <a class="nav-link dropdown-toggle smooth-scroll" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->firstname }}&emsp;{{ Auth::user()->lastname }}
                        </a> 
                        <div class="dropdown-menu dropdown-cust" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/booking/{{ Auth::user()->id }}">My Ticket</a>
                            <a class="dropdown-item" href="/course/{{ Auth::user()->id }}">My Course</a>
                            
                            @if(Auth::user()->role != 4)  {{-- ไม่ใช่ user ทั่วไป --}}
                                <a class="dropdown-item" href="/dashboard">Dashboard</a>
                            @else {{-- ไม่ใช่ user ทั่วไป (ลูกค้า) --}}
                                <a class="dropdown-item" href="/userprofile">Profile</a>
                                <a class="dropdown-item" href="/customer_resetpassword">Reset password</a>
                            @endif

                            <a class="dropdown-item" href="/logout">logout</a>
                        </div>
                    </li>

                @else

                    <li class="nav-item" ><a class="nav-link smooth-scroll" href="/register">Register</a></li>
                    <li class="nav-item" ><a class="nav-link smooth-scroll" href="/login">Login</a></li>

                @endif

            </ul>  
        </div>
        </div>
    </nav>
</header>