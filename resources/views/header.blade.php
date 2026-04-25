<header>
    <div class="logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/basilico-logo.png') }}" alt="Basilico Logo" width="120">
        </a>
    </div>

    <nav>
        <a href="{{ url('/') }}">Home</a>
        <a href="{{ url('/about') }}">About</a>
        <a href="{{ url('/menu') }}">Menu</a>
        <a href="{{ url('/reservation') }}">Reservation</a>
        <a href="{{ url('/order-online') }}">Order Online</a>

        @if(session()->has('user_id'))
            <span>Welcome, {{ session('first_name') }}</span>
            <a href="{{ route('logout') }}">Logout</a>
        @else
            <a href="{{ route('registration') }}">Registration</a>
            <a href="{{ route('login') }}">Login</a>
        @endif
    </nav>
</header>