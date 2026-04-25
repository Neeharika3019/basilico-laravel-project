<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Basilico – Order Online</title>

    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/order-online.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
</head>
<body>

    @include('partials.header')

    @if(session('success'))
        <p style="color: green; text-align:center; font-weight:bold;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color: red; text-align:center; font-weight:bold;">{{ session('error') }}</p>
    @endif

    <main>

        <section class="hero">
            <h1>How To Order Online?</h1>
            <img src="{{ asset('assets/img/tomato_spaghetti.jpg') }}" alt="Pasta Dish">
        </section>

        <section class="step-bar">
            <div class="step">
                <div class="step-number">1</div>
                <div class="step-text">Sign in / Login</div>
            </div>
            <div class="step">
                <div class="step-number">2</div>
                <div class="step-text">Place Order</div>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <div class="step-text">Delivery / Pickup</div>
            </div>
        </section>

        <section class="menu-btn-wrapper">
            <a href="{{ route('menu') }}">
                <button class="menu-btn" type="button">Menu</button>
            </a>
        </section>

        @php
            $cart = session('cart', []);
            $total = 0;
        @endphp

        <section class="order-table-section">
            <h3>🍽 Buon Appetito!<br><br>
            Check your meals, update quantities, and enjoy your Italian feast.</h3>

            <form action="{{ route('cart.update') }}" method="POST">
                @csrf

                <table>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price (Rs)</th>
                    </tr>

                    @if(count($cart) > 0)
                        @foreach($cart as $id => $qty)
                            @php
                                $cartItem = $specials->firstWhere('id', $id);
                            @endphp

                            @if($cartItem)
                                @php
                                    $subtotal = $cartItem->price * $qty;
                                    $total += $subtotal;
                                @endphp
                                <tr>
                                    <td>{{ $cartItem->dish_name }}</td>
                                    <td>
                                        <input type="number" name="qty[{{ $id }}]" value="{{ $qty }}" min="0">
                                    </td>
                                    <td>{{ number_format($subtotal, 2) }}</td>
                                </tr>
                            @endif
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">No items in cart yet.</td>
                        </tr>
                    @endif
                </table>

                <button class="cart-btn" type="submit">Update Cart</button>
            </form>

            <div class="total-amount">Total Amount: Rs {{ number_format($total, 2) }}</div>
        </section>

        <section class="delivery-strip">
            <form action="{{ route('checkout') }}" method="POST">
                @csrf

                <button class="delivery-btn" type="button">Delivery / Pick Up</button>

                <div class="delivery-form">
                    <label>
                        <input type="radio" name="method" value="delivery"> Delivery
                    </label>
                    <label>
                        <input type="radio" name="method" value="pickup"> Pickup
                    </label>

                    <br><br>

                    <label>
                        Address:
                        <input type="text" name="address" placeholder="Required only for Delivery">
                    </label>

                    <br><br>

                    <button type="submit">Confirm Order</button>
                </div>
            </form>
        </section>

    </main>

    @include('partials.footer')

</body>
</html>