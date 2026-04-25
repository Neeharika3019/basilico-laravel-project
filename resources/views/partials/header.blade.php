<header>
    <div class="logo">
        <a href="{{ url('/') }}">
           <img src="{{ asset('assets/img/basilico-logo.png') }}" alt="Basilico Logo">
        </a>
    </div>

    <nav>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('about') }}">About</a>
        <a href="{{ route('menu') }}">Menu</a>
        <a href="{{ route('reservation') }}">Reservation</a>
        <a href="{{ route('order.online') }}">Order Online</a>

        @if(session()->has('user_id'))
            <span>Welcome, {{ session('first_name') }}</span>
            <a href="{{ route('logout') }}">Logout</a>
        @else
            <a href="{{ route('registration') }}">Registration</a>
            <a href="{{ route('login') }}">Login</a>
        @endif
    </nav>
</header>