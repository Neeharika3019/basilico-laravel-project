<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>

    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/registration.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
</head>

<body>
    @include('partials.header')

    <div class="form-container">

        <h2 class="form-title">Create Your Own Account</h2>

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

        <form action="{{ route('register.process') }}" method="POST" class="reg-form">
            @csrf

            <div class="row">
                <div class="input-group">
                    <label>Name</label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" required>
                </div>

                <div class="input-group">
                    <label>Surname</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" required>
                </div>
            </div>

            <div class="row">
                <div class="input-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                           title="Enter a valid email address">
                </div>

                <div class="input-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required
                           pattern="[0-9]{8}"
                           title="Phone number must contain exactly 8 digits">
                </div>
            </div>

            <div class="row">
                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" required
                           pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}"
                           title="Password must contain at least 8 characters, 1 uppercase letter, 1 lowercase letter, and 1 number">
                </div>

                <div class="input-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" required>
                </div>
            </div>

            <div class="btn-wrapper">
                <button type="submit" class="submit-btn">Create Account</button>
            </div>

        </form>

    </div>

    @include('partials.footer')
</body>
</html>