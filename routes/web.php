<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\OrderOnlineController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomepageController::class, 'index'])->name('home');

Route::view('/about', 'about')->name('about');
Route::view('/menu', 'menu')->name('menu');

Route::get('/reservation', function () {
    if (!session()->has('user_id')) {
        return redirect()->route('registration')
            ->with('error', 'Please create an account first before making a reservation.');
    }

    return view('reservation');
})->name('reservation');

Route::post('/reservation/check', [HomepageController::class, 'checkReservationAvailability'])->name('reservation.check');
Route::get('/api/testimonials', [HomepageController::class, 'getTestimonials'])->name('api.testimonials');

Route::get('/order-online', [OrderOnlineController::class, 'index'])->name('order.online');
Route::get('/start-order/{id}', [OrderOnlineController::class, 'startOrder'])->name('start.order');
Route::post('/add-to-cart', [OrderOnlineController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [OrderOnlineController::class, 'updateCart'])->name('cart.update');
Route::post('/checkout', [OrderOnlineController::class, 'checkout'])->name('checkout');

Route::view('/registration', 'registration')->name('registration');
Route::post('/register-process', [AuthController::class, 'registerProcess'])->name('register.process');

Route::view('/login', 'login')->name('login');
Route::post('/login-process', [AuthController::class, 'loginProcess'])->name('login.process');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/test-schema', [HomepageController::class, 'testSchema'])->name('test.schema');