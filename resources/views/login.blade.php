<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

    @include('partials.header')

    <div class="login-container">

        <h2 class="login-title">Log In Your Account</h2>

        @if(session('success'))
            <p style="color: green; font-weight: bold; text-align: center;">
                {{ session('success') }}
            </p>
        @endif

        @if(session('error'))
            <p style="color: red; font-weight: bold; text-align: center;">
                {{ session('error') }}
            </p>
        @endif

        @if ($errors->any())
            <div style="color: red; font-weight: bold; text-align: center;">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST" class="login-form">
            @csrf

            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" id="password" name="password" required>
                <i class="fa-solid fa-eye" id="togglePassword"></i>
            </div>

            <div class="btn-wrapper">
                <button type="submit" class="login-btn">Login</button>
            </div>
        </form>

    </div>

    @include('partials.footer')

    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        if (togglePassword && password) {
            togglePassword.addEventListener("click", function () {
                const type = password.type === "password" ? "text" : "password";
                password.type = type;

                this.classList.toggle("fa-eye");
                this.classList.toggle("fa-eye-slash");
            });
        }
    </script>

</body>
</html>