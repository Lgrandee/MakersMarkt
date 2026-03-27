<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    Auth\RegisterController,
    Auth\LoginController,
    ProfileController,
    ProductController,
    OrderController,
    ReviewController,
    NotificationController,
    ReportController,
    ModeratorController,
    StatisticsController
};

// Public routes
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Authentication
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Authenticated routes (all roles)
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::put('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
});

// Buyer specific routes
Route::middleware(['auth', 'role:koper'])->prefix('buyer')->group(function () {
    Route::post('/order/{product}', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/reviews/create/{order}', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews/{order}', [ReviewController::class, 'store'])->name('reviews.store');
    Route::post('/report/{product}', [ReportController::class, 'store'])->name('reports.store');
});

// Maker specific routes
Route::middleware(['auth', 'role:maker'])->prefix('maker')->group(function () {
    Route::get('/products', [ProductController::class, 'makerIndex'])->name('maker.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('maker.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('maker.products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('maker.products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('maker.products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('maker.products.destroy');
    Route::get('/orders', [OrderController::class, 'makerOrders'])->name('maker.orders.index');
    Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('maker.orders.updateStatus');
});

// Moderator specific routes
Route::middleware(['auth', 'role:moderator'])->prefix('moderator')->group(function () {
    Route::get('/products', [ModeratorController::class, 'products'])->name('moderator.products');
    Route::post('/products/{product}/approve', [ModeratorController::class, 'approveProduct'])->name('moderator.approve');
    Route::post('/products/{product}/reject', [ModeratorController::class, 'rejectProduct'])->name('moderator.reject');
    Route::delete('/products/{product}', [ModeratorController::class, 'deleteProduct'])->name('moderator.delete.product');
    Route::get('/users', [ModeratorController::class, 'users'])->name('moderator.users');
    Route::delete('/users/{user}', [ModeratorController::class, 'deleteUser'])->name('moderator.delete.user');
    Route::get('/reports', [ModeratorController::class, 'reports'])->name('moderator.reports');
    Route::get('/search', [ModeratorController::class, 'search'])->name('moderator.search');
    Route::get('/statistics', [StatisticsController::class, 'dashboard'])->name('moderator.statistics');
});
