<?php

use App\Models\Cafe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CafeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RewardClaimController;
use App\Http\Controllers\RecommendationController;

Route::get('/recommendations/{userId}', [RecommendationController::class, 'recommendCafes']);

// Landing Page
Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::middleware(['auth'])->group(function () {

    // View all events
    Route::get('/events', [EventController::class, 'index'])->name('events.index');

    // View all events for the cafe
    Route::get('/cafes/{cafe}/events/manage', [EventController::class, 'manage'])->name('events.manage');

    // Create a new event
    Route::get('/cafes/{cafe}/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/cafes/{cafe}/events', [EventController::class, 'store'])->name('events.store');

    // Edit an event
    Route::get('/cafes/{cafe}/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/cafes/{cafe}/events/{event}', [EventController::class, 'update'])->name('events.update');

    // Delete an event
    Route::delete('/cafes/{cafe}/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

    // Show an individual event
    Route::get('/cafes/{cafe}/events/{event}', [EventController::class, 'show'])->name('events.show');
});


Route::middleware('auth')->group(function () {
    Route::get('/rewards', [RewardClaimController::class, 'index'])->name('rewards.index');
    Route::get('/rewards/{reward}', [RewardClaimController::class, 'show'])->name('rewards.show');
    Route::post('/rewards/{reward}/claim', [RewardClaimController::class, 'claim'])->name('rewards.claim');
    Route::get('/my-rewards', [RewardClaimController::class, 'userRewards'])->name('rewards.user');
});

Route::middleware('auth')->group(function () {
    Route::get('/cafes/{cafe}/rewards/create', [RewardController::class, 'create'])->name('rewards.create');
    Route::post('/rewards', [RewardController::class, 'store'])->name('rewards.store');
    Route::get('/rewards/{reward}/edit', [RewardController::class, 'edit'])->name('rewards.edit');
    Route::put('/rewards/{reward}', [RewardController::class, 'update'])->name('rewards.update');
    Route::delete('/rewards/{reward}', [RewardController::class, 'destroy'])->name('rewards.destroy');
    Route::get('/cafes/{cafe}/rewards/manage', [RewardController::class, 'manage'])->name('rewards.manage');
});


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
    Route::get('/cafes/{cafe}/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');

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

    // Manage reservation
    Route::get('/cafes/{cafe}/reservations', [ReservationController::class, 'manage'])->name('reservations.manage');

    //Update status
    Route::put('/reservations/{reservation}/status', [ReservationController::class, 'updateStatus'])->name('reservations.updateStatus');


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

    // Upload Form Page
    Route::get('/cafe_listings/{cafe}/upload-documents', [CafeController::class, 'showDocumentUploadForm'])->name('cafes.uploadDocuments');

    // Submit Document
    Route::post('/cafe_listings/{cafe}/submit-documents', [CafeController::class, 'storeDocuments'])->name('cafes.submitDocuments');

    // View Document
    Route::get('/cafe_listings/{cafe}/documents', [CafeController::class, 'showDocuments'])->name('cafes.showDocuments');

    //Update Documents
    Route::post('/cafes/{cafe}/update-documents', [CafeController::class, 'updateDocuments'])->name('cafes.updateDocuments');

    //Show Edit Page
    Route::get('/cafes/{cafe_id}/edit-document/{document}', [CafeController::class, 'editDocuments'])->name('cafes.editDocuments');  
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

    // Show Change Password Form
    Route::get('/owner_change_password', [UserController::class, 'owner_showChangePasswordForm'])->name('owner.passwordForm');

    // Show Owner Details
    Route::get('/owner_show', [UserController::class, 'owner_show'])->name('owner.show');

    // Show Feedback for Cafe
    Route::get('/owner/cafe/{cafe}/feedbacks', [FeedbackController::class, 'ownerFeedbacks'])->name('owner.feedback');
});

// Admin Routes
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/cafes', [AdminController::class, 'showPendingCafes'])->name('admin.dashboard');
    Route::put('/admin/cafes/{id}/status', [AdminController::class, 'updateCafeStatus'])->name('admin.updateStatus');
});

