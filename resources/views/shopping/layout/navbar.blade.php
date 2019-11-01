<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.html">CNX<small>Stadium</small></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="/" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="/booking" class="nav-link">Booking</a></li>
                <li class="nav-item"><a href="/courses" class="nav-link">Training Muay Thai</a></li>
                <li class="nav-item"><a href="/about" class="nav-link">About</a></li>
                <li class="nav-item"><a href="/location" class="nav-link">Location</a></li>

                @if(Auth::check())
                <li class="dropdown show nav-item">
                    <a class="nav-link dropdown-toggle smooth-scroll" href="#" id="navbarDropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->firstname }}&emsp;{{ Auth::user()->lastname }}
                    </a>
                    <div class="dropdown-menu dropdown-cust" aria-labelledby="navbarDropdownMenuLink">
                        @if(Auth::user()->role == 4)
                        <a class="dropdown-item nav-link" href="/booking/{{ Auth::user()->id }}">My Ticket</a>
                        <a class="dropdown-item" href="/course/{{ Auth::user()->id }}">My Course</a>
                        @endif
                        @if(Auth::user()->role != 4) {{-- ไม่ใช่ user ทั่วไป --}}
                        <a class="dropdown-item nav-link" href="/dashboard">Dashboard</a>
                        @else {{-- ไม่ใช่ user ทั่วไป (ลูกค้า) --}}
                        <a class="dropdown-item nav-link" href="/userprofile">Profile</a>
                        <a class="dropdown-item nav-link" href="/customer_resetpassword">Reset password</a>
                        @endif
                        <a class="dropdown-item nav-link" href="/logout">logout</a>
                    </div>
                </li>
                @else
                <li class="dropdown show nav-item">
                    <a class="nav-link" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Account
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item nav-link" href="/register">Register</a>
                        <a class="dropdown-item nav-link" href="/login">Login</a>
                    </div>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->