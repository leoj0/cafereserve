<?php

use App\Models\Cafe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CafeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ReservationController;



// Landing Page
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Feedback Routes
Route::middleware('auth')->group(function () {

    // Display all feedbacks for a specific cafe
    Route::get('/cafes/{cafe}/feedbacks', [FeedbackController::class, 'index'])->name('feedbacks.index');
    
    // Display the form to create feedback for a specific cafe
    Route::get('/feedback/create', [FeedbackController::class, 'create'])->name('feedback.create');

    // Store the feedback in the database
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

    // 
    Route::get('/user/feedbacks', [FeedbackController::class, 'userFeedbacks'])->name('feedback.user');

    //
    Route::get('/feedback/{feedback}/edit', [FeedbackController::class, 'edit'])->name('feedback.edit');

    //
    Route::delete('/feedback/{feedback}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');

    //
    Route::put('/feedback/{feedback}', [FeedbackController::class, 'update'])->name('feedback.update');
    
});

// Reservation Routes
Route::middleware('auth')->group(function () {
    // Display all reservations for a specific cafe
    Route::get('/cafes/{cafe}/reservations', [ReservationController::class, 'index'])->name('reservations.index');

    // Display a single reservation
    Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');

    // Display User's Reservation
    Route::get('/reservations', [ReservationController::class, 'userReservations'])->name('reservations.user');
    
    // Display all reservations for the owner to manage
    Route::get('/cafes/{cafe}/manage_reservations', [ReservationController::class, 'manage'])->name('reservations.manage');

    // Show the form to create a new reservation
    Route::post('/cafes/{cafe}/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');

    // Store a new reservation
    Route::post('/cafes/{cafe}/reservations', [ReservationController::class, 'store'])->name('reservations.store');

    // Show the form to edit an existing reservation
    Route::get('/cafes/{cafe}/reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');

    // Update an existing reservation
    Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');

    // Delete a reservation
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

    // Search cafe
    Route::get('/search-cafe', [ReservationController::class, 'search'])->name('reservations.search');

    // Reserve table page
    Route::get('/reservations/{cafe}/select-tables', [ReservationController::class, 'selectTablesPage'])->name('reservations.selectTablesPage');


});

// Table Routes
Route::middleware(['auth', 'role:Owner'])->group(function () {
    Route::get('/cafes/{cafe}/tables', [TableController::class, 'index'])->name('tables.index');

    Route::get('/cafes/{cafe}/tables/create', [TableController::class, 'create'])->name('tables.create');

    Route::post('/cafes/{cafe}/tables', [TableController::class, 'store'])->name('tables.store');

    Route::get('/cafes/{cafe}/tables/{table}/edit', [TableController::class, 'edit'])->name('tables.edit');

    Route::put('/cafes/{cafe}/tables/{table}', [TableController::class, 'update'])->name('tables.update');

    Route::delete('/cafes/{cafe}/tables/{table}', [TableController::class, 'destroy'])->name('tables.destroy');

    Route::get('/cafes/{cafe}/tables/manage', [TableController::class, 'manage'])->name('tables.manage');
});

// Cafe Routes
Route::middleware('auth')->group(function () {
    // Show Create Cafe Form
    Route::get('/cafe_listings/create', [CafeController::class, 'create'])->name('cafes.create');

    // Store Cafe Listing
    Route::post('/cafe_listings', [CafeController::class, 'store'])->name('cafes.store');

    // Show Edit Form
    Route::get('/cafe_listings/{cafe}/edit', [CafeController::class, 'edit'])->name('cafes.edit');

    // Update Cafe
    Route::put('/cafe_listings/{cafe}', [CafeController::class, 'update'])->name('cafes.update');

    // Delete Cafe
    Route::delete('/cafe_listings/{cafe}', [CafeController::class, 'destroy'])->name('cafes.destroy');

    // Show Single Cafe Listing for Owner
    Route::get('/cafe_listings/manage/{cafe}', [CafeController::class, 'manage'])->name('cafes.manage');

    // Show All Cafe Listing
    Route::get('/cafe_listings/index', [CafeController::class, 'index'])->name('cafes.index');

    // Show Single Cafe Listing
    Route::get('/cafe_listings/{cafe}', [CafeController::class, 'show'])->name('cafes.show');
    
});

// Menu Routes
Route::middleware('auth')->group(function () {
    // Show create form
    Route::get('/cafes/{cafe}/menus/create', [MenuController::class, 'create'])->name('menus.create');

    // Store Menu Item
    Route::post('/cafes/{cafe}/menus', [MenuController::class, 'store'])->name('menus.store');

    // Edit Menu Item
    Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');

    // Update Menu Item
    Route::put('/menus/{menu}', [MenuController::class, 'update'])->name('menus.update');

    // Delete Menu Item
    Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');
    
    // Show All item
    Route::get('/cafes/{cafe}/menus', [MenuController::class, 'index'])->name('menus.index');

    // Show Single Item
    Route::get('/menus/{menu}', [MenuController::class, 'show'])->name('menus.show');

    // Show All item for Owner
    Route::get('/cafes/{cafe}/menus/manage', [MenuController::class, 'manage'])->name('menus.manage');

    // Show Single Item for Owner
    Route::get('/cafes/{cafe}/menus/{menu}/manage', [MenuController::class, 'manage_single'])->name('menus.manage_single');
});

// User Registration Routes
Route::get('/register', [UserController::class, 'create'])->name('register.form');
Route::post('/register', [UserController::class, 'store'])->name('register.store');

// Authentication Routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/users/authenticate', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User Routess
Route::middleware('auth')->group(function () {
    // Show User Details
    Route::get('/show', [UserController::class, 'show'])->name('users.show');

    // Show User Edit Form
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

    // Update User Information
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

    // Show Change Password Form
    Route::get('/change_password', [UserController::class, 'showChangePasswordForm'])->name('change.password.form');

    // Update User Password
    Route::put('/users/{user}/change_password', [UserController::class, 'updatePassword'])->name('password.update');

    // Delete User
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('user.delete');
});

// Owner Routes (Requires Authentication and Owner Role)
Route::middleware(['auth', 'role:Owner'])->group(function () {
    // Owner Dashboard
    Route::get('/owners', [OwnerController::class, 'index'])->name('owners.index');

});

