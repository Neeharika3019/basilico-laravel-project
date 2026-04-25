<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Make a Reservation</title>

    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reservation.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    
</head>
<body>

    @include('partials.header')

    <section class="reservation-section">
        <h1>Book Your Table</h1>
        <p class="subtitle">Reserve a table easily and quickly</p>

        <div class="reservation-container">
            <form class="reservation-form" method="POST" action="#">
                @csrf

                <label for="name">Name</label>
                <input type="text" id="name" value="User Name" disabled>

                <label for="email">Email</label>
                <input type="email" id="email" value="user@email.com" disabled>

                <label for="phone">Phone</label>
                <input type="text" id="phone" value="12345678" disabled>

                <label for="date">Date</label>
                <input type="date" name="date" id="date" required>

                <label for="people">Number of People</label>
                <input type="number" name="people" id="people" min="1" required>

                <label for="time">Time</label>
                <input type="time" name="time" id="time" required>

                <button type="submit" class="reserve-btn">Reserve</button>
            </form>

            <div class="reservation-image">
                <img src="{{ asset('assets/img/pasta-bowl.jpg') }}" alt="Restaurant Table">
            </div>
        </div>
    </section>

    @include('partials.footer')

</body>
</html>