<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Basilico — Authentic Italian Cuisine in Mauritius</title>

    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homestyle.css') }}">

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    @include('partials.header')

    <!-- ================= HERO SECTION ================= -->
    <section id="home" class="hero">
      <div class="container hero__grid">

        <div class="hero__text">
          <h1 class="hero__title">Basilico</h1>
          <p class="hero__subtitle">Authentic Italian Cuisine in Mauritius</p>
          <p class="hero__copy">
            Basilico is a cozy Italian eatery serving fresh, hand-made spaghetti dishes.
            From classic recipes to creative twists, every plate is crafted with authentic
            Italian flavors in a warm and inviting atmosphere.
          </p>

          <a class="btn primary" href="#" id="openReservationModal">Make a Reservation</a>
        </div>

        <figure class="hero__media">
          <img src="{{ asset('assets/img/hero-pasta.jpg') }}" alt="Fresh pasta being made">
        </figure>

      </div>
    </section>

    <!-- ================= WEEKLY SPECIALS ================= -->
    <section id="specials" class="specials">
      <div class="container">
        <h2 class="section-title">This week specials!</h2>

        <div id="cartMessage" style="margin-bottom: 15px; font-weight: bold;"></div>

        <div class="card-grid">
          @foreach($specials as $item)
            <article class="card special">

              <figure class="card_media">
                <img src="{{ $item->image_url }}" alt="{{ $item->dish_name }}">
              </figure>

              <div class="card_body">
                <h3 class="card_title">{{ $item->dish_name }}</h3>

                <div class="price">Rs {{ $item->price }}</div>

                <p class="card_text">
                  {{ $item->description }}
                </p>

                <button
                    class="btn primary add-to-cart-btn"
                    data-id="{{ $item->id }}">
                    Order a Deliver
                </button>
              </div>

            </article>
          @endforeach
        </div>
      </div>
    </section>

    <!-- ================= TESTIMONIALS ================= -->
    <section id="testimonials" class="testimonials">
      <div class="container">
        <h2 class="section-title">Testimonials</h2>

        <div class="testimonial-grid" id="testimonialsContainer">
            <p>Loading testimonials...</p>
        </div>
      </div>
    </section>

    <!-- ================= ABOUT SECTION ================= -->
    <section id="about" class="about">
      <div class="container about__grid">

        <div class="about__text">
          <h2>Basilico</h2><br />
          <p class="tagline">Authentic Italian Cuisine in Mauritius</p><br />
          <p>
            Basilico brings Italy to Mauritius with fresh, hand-crafted spaghetti in every style —
            from timeless classics to unique creations — served with warmth and tradition.
          </p>
        </div>

        <figure class="about__gallery slideshow-gallery">
            <img src="{{ asset('assets/img/restaurant-interior.jpg') }}" class="about-slide active-slide" alt="Restaurant interior">
            <img src="{{ asset('assets/img/pasta-bowl.jpg') }}" class="about-slide" alt="Pasta bowl">
        </figure>

      </div>
    </section>

    <!-- ================= RESERVATION MODAL ================= -->
    <div id="reservationModal" class="reservation-modal" style="display: none;">
        <div class="reservation-modal-content">
            <span id="closeReservationModal" class="close-modal">&times;</span>

            <h2>Check Reservation Availability</h2>

            <form id="reservationCheckForm">
                @csrf

                <div class="form-group">
                    <label for="reservation_date">Date</label>
                    <input type="date" id="reservation_date" name="reservation_date" required>
                </div>

                <div class="form-group">
                    <label for="reservation_time">Time</label>
                    <input type="time" id="reservation_time" name="reservation_time" required>
                </div>

                <div class="form-group">
                    <label for="guests">Number of Guests</label>
                    <input type="number" id="guests" name="guests" min="1" required>
                </div>

                <button type="submit" class="btn primary">Check Availability</button>
            </form>

            <div id="reservationCheckMessage" style="margin-top: 15px; font-weight: bold;"></div>
            <div id="reservationActionArea" style="margin-top: 15px;"></div>
        </div>
    </div>

    <!-- ================= ORDER LOGIN MODAL ================= -->
    <div id="orderLoginModal" class="reservation-modal" style="display: none;">
        <div class="reservation-modal-content">
            <span id="closeOrderLoginModal" class="close-modal">&times;</span>

            <h2>Login Required</h2>

            <p style="margin-top: 15px; margin-bottom: 20px; font-weight: bold; color: #b00020;">
                Please login first or register to be able to proceed with online ordering.
            </p>

            <a href="{{ route('login') }}" class="btn primary" style="margin-right: 10px;">Login</a>
            <a href="{{ route('registration') }}" class="btn primary">Register</a>
        </div>
    </div>

    <!-- ================= FOOTER ================= -->
    <footer class="footer">
        <div class="footer-logo">
            <img src="{{ asset('assets/img/basilico-footer.png') }}" alt="Basilico Logo">
        </div>

        <div class="footer-columns">
            <div class="footer-column">
                <h4>Doormat Navigation</h4>
                <p>Home</p>
                <p>Menu</p>
                <p>Reservation</p>
                <p>Order Online</p>
                <p>Registration</p>
                <p>Login</p>
            </div>

            <div class="footer-column">
                <h4>Contact</h4>
                <p>📍 Port Louis, Mauritius</p>
                <p>📞 +230 5555 1234</p>
                <p>✉️ contact@basilico.mu</p>
            </div>

            <div class="footer-column">
                <h4>Opening Hours</h4>
                <p>Mon-Fri: 11 00 AM - 10 00 PM</p>
                <p>Sat-Sun: 12 00 PM - 11.30 PM</p>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
    $(document).ready(function () {
        const isLoggedIn = {{ session()->has('user_id') ? 'true' : 'false' }};

        // Hero animation on page load
        $('.hero__text').hide().fadeIn(1000);
        $('.hero__media').hide().slideDown(1000);

        // Open reservation modal
        $('#openReservationModal').click(function (e) {
            e.preventDefault();
            $('#reservationModal').fadeIn();
        });

        // Close reservation modal
        $('#closeReservationModal').click(function () {
            $('#reservationModal').fadeOut();
            $('#reservationCheckMessage').html('');
            $('#reservationActionArea').html('');
            $('#reservationCheckForm')[0].reset();
        });

        // Close order login modal
        $('#closeOrderLoginModal').click(function () {
            $('#orderLoginModal').fadeOut();
        });

        // Close modals when clicking outside
        $(window).click(function (e) {
            if ($(e.target).is('#reservationModal')) {
                $('#reservationModal').fadeOut();
                $('#reservationCheckMessage').html('');
                $('#reservationActionArea').html('');
                $('#reservationCheckForm')[0].reset();
            }

            if ($(e.target).is('#orderLoginModal')) {
                $('#orderLoginModal').fadeOut();
            }
        });

        // AJAX reservation pre-check
        $('#reservationCheckForm').submit(function (e) {
            e.preventDefault();

            $('#reservationCheckMessage').css('color', 'black').html('Checking availability...');
            $('#reservationActionArea').html('');

            $.ajax({
                url: "{{ route('reservation.check') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    reservation_date: $('#reservation_date').val(),
                    reservation_time: $('#reservation_time').val(),
                    guests: $('#guests').val()
                },
                success: function (response) {
                    $('#reservationActionArea').html('');

                    if (response.available) {
                        $('#reservationCheckMessage').css('color', 'green').html(response.message);

                        if (isLoggedIn) {
                            $('#reservationActionArea').html(`
                                <a href="{{ route('reservation') }}" class="btn primary">Continue Reservation</a>
                            `);
                        } else {
                            $('#reservationActionArea').html(`
                                <p style="color: #b00020; font-weight: bold; margin-bottom: 10px;">
                                    Please login or register to complete your reservation.
                                </p>
                                <a href="{{ route('login') }}" class="btn primary" style="margin-right: 10px;">Login</a>
                                <a href="{{ route('registration') }}" class="btn primary">Register</a>
                            `);
                        }
                    } else {
                        $('#reservationCheckMessage').css('color', 'red').html(response.message);
                    }
                },
                error: function () {
                    $('#reservationCheckMessage').css('color', 'red').html('Something went wrong. Please try again.');
                    $('#reservationActionArea').html('');
                }
            });
        });

        // AJAX Add to Cart
        $(document).on('click', '.add-to-cart-btn', function () {
            let itemId = $(this).data('id');

            $('#cartMessage').css('color', 'black').html('Adding to cart...');

            $.ajax({
                url: "{{ route('cart.add') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: itemId,
                    quantity: 1
                },
                success: function (response) {
                    if (response.success) {
                        $('#cartMessage').css('color', 'black').html(`
                            ${response.message}
                            <br><a href="{{ route('order.online') }}" class="btn primary" style="margin-top:10px; display:inline-block;">
                                Go to Order Online
                            </a>
                        `);
                    } else {
                        $('#cartMessage').css('color', 'red').html(response.message);
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 401) {
                        $('#orderLoginModal').fadeIn();
                    } else {
                        $('#cartMessage').css('color', 'red').html('Could not add item to cart.');
                    }
                }
            });
        });

        // Load testimonials from JSON API
        function loadTestimonials() {
            $.ajax({
                url: "{{ route('api.testimonials') }}",
                type: "GET",
                success: function (data) {
                    let html = '';

                    if (data.length === 0) {
                        html = '<p>No testimonials available at the moment.</p>';
                    } else {
                        data.forEach(function (t) {
                            let stars = '';

                            for (let i = 0; i < 5; i++) {
                                stars += `<span class="star${i < t.rating ? ' star--on' : ''}">★</span>`;
                            }

                            html += `
                                <figure class="testimonial">
                                    <figcaption class="testimonial__meta">
                                        <span class="user">${t.username}</span>
                                        <span class="stars">${stars}</span>
                                    </figcaption>

                                    <blockquote class="testimonial__text">
                                        “${t.text}”
                                    </blockquote>
                                </figure>
                            `;
                        });
                    }

                    $('#testimonialsContainer').html(html);
                },
                error: function () {
                    $('#testimonialsContainer').html('<p>Unable to load testimonials.</p>');
                }
            });
        }

        loadTestimonials();

        // About section slideshow
        let currentSlide = 0;
        const slides = $('.about-slide');

        function showNextSlide() {
            slides.eq(currentSlide).fadeOut(800, function () {
                $(this).removeClass('active-slide');

                currentSlide = (currentSlide + 1) % slides.length;

                slides.eq(currentSlide).fadeIn(800).addClass('active-slide');
            });
        }

        slides.hide();
        slides.eq(0).show().addClass('active-slide');

        setInterval(showNextSlide, 3000);
    });
    </script>

</body>
</html>