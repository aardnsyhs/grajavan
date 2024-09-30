<?php

use App\Livewire\Auth\ForgotPasswordPage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\BookDetailPage;
use App\Livewire\BooksPage;
use App\Livewire\CancelPage;
use App\Livewire\CartPage;
use App\Livewire\CategoriesPage;
use App\Livewire\CheckoutPage;
use App\Livewire\HomePage;
use App\Livewire\MyOrderDetailPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\SuccessPage;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\InvoiceController;
use App\Livewire\ProductReviewModal;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

Route::get('/', HomePage::class)->name('home');
Route::get('/categories', CategoriesPage::class)->name('categories');
Route::get('/books', BooksPage::class)->name('books.index');
Route::get('/books/{book_id}', BookDetailPage::class)->name('books.show');
Route::get('/cart', CartPage::class)->name('cart');

Route::middleware('guest')->group(function () {
    Route::get('/login', LoginPage::class)->name('login');
    Route::get('/register', RegisterPage::class)->name('register');
    Route::get('/forgot', ForgotPasswordPage::class)->name('password.request');
    Route::get('/reset/{token}', ResetPasswordPage::class)->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

    Route::get('/checkout', CheckoutPage::class)->name('checkout');
    Route::get('/my-orders', MyOrdersPage::class)->name('my-orders.index');
    Route::get('/my-orders/{order_id}', MyOrderDetailPage::class)->name('my-orders.show');
    
    Route::post('/webhook/stripe', [CheckoutPage::class, 'handleStripeWebhook'])->name('stripe.webhook');
    Route::get('/stripe/success', [CheckoutPage::class, 'handleStripeSuccess'])->name('stripe.success');
    Route::get('/success', SuccessPage::class)->name('success');
    Route::get('/midtrans/callback', [CheckoutPage::class, 'handleMidtransCallback'])->name('midtrans.callback');
    Route::post('/midtrans/webhook', [CheckoutPage::class, 'handleMidtransWebhook'])->name('midtrans.webhook');

    Route::get('/cancel', CancelPage::class)->name('cancel');

    Route::get('/orders/{order}/pdf', [InvoiceController::class, 'generateInvoicePdf'])->name('orders.invoice.pdf');

    Livewire::component('product-review-modal', ProductReviewModal::class);
});
