<nav>
    <div class="navbar">
        <div class="container nav-container">
            <input class="checkbox" type="checkbox" name="" id="" />
            <div class="hamburger-lines">
                <span class="line line1"></span>
                <span class="line line2"></span>
                <span class="line line3"></span>
            </div>
            <div class="logo">
                <h1>DATA PEGAWAI</h1>
            </div>
            <div class="menu-items">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="{{ route('admin.view') }}">Pegawai</a></li>
                @if (Auth::check() == false)
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
                @else
                <li><a href="{{ route('logout') }}">Logout</a></li>
                @endif
            </div>
        </div>
    </div>
</nav>


