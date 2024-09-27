<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BlogController;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\LocaleController;
use App\Models\Room;
use App\Http\Controllers\MongoDBTestController;
use App\Http\Controllers\TaskController;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\BookingsExportController;
use App\Http\Controllers\RoomExportController;
use App\Http\Controllers\BlogExportController;
use App\Http\Controllers\UsersImportController;
use App\Http\Controllers\CustomAuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [AdminController::class, 'index'])->name('home');


Route::get('/home', [AdminController::class, 'index'])->name('home');
Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
// Route to show the admin profile


// Route to handle the profile update
// In web.php
Route::post('/profile/update', [AdminController::class, 'updateProfile'])->name('admin.update_profile');
// In routes/web.php
// Route for displaying the form
// Route for displaying the form
// Admin routes for managing rooms
// Admin routes


Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('home.blog_details');


// Route for showing the 'Add Blog' form
Route::get('/add_blog/create', [BlogController::class, 'create'])->name('admin.create_blog');
// Ensure this route points to the correct method
Route::post('/add_blog/store', [BlogController::class, 'store'])->name('admin.store_blog');


// web.php
// In web.php
Route::get('/blog/{id}/comment', function ($id) {
    return redirect()->route('home.blog_details', ['id' => $id]);
});
Route::post('/blog/{id}/comment', [BlogController::class, 'storeComment'])->name('blog.comment.store');

Route::redirect('/blog.html', '/blog', 301);

// web.php
Route::get('/contact', function () {
    return view('home.contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Admin routes
// Route to display all blogs
Route::get('/show_blogs', [BlogController::class, 'showAdmin'])->name('admin.show_blogs');

// Route to show the form to edit a blog post
Route::get('/show_blogs/{id}/edit', [BlogController::class, 'edit'])->name('admin.edit_blog');

// Route to update a blog post
Route::put('/show_blogs/{id}', [BlogController::class, 'update'])->name('admin.update_blog');

// Route to show the confirmation for deleting a blog post
Route::get('/show_blogs/{id}/delete', [BlogController::class, 'confirmDelete'])->name('admin.confirm_delete');

// Route to delete a blog post
Route::delete('/show_blogs/{id}', [BlogController::class, 'destroy'])->name('admin.delete_blog');
// Route to show the form for adding a new blog
// Route to show the form for creating a new blog
Route::get('/add_blog/create', [BlogController::class, 'create'])->name('admin.add_blog');

// Route to store a new blog in the database
Route::post('/blog/{blog}/like', [BlogController::class, 'toggleLike'])->name('blog.toggleLike');


Route::get('/about', function () {
    return view('home.about'); // Replace 'about' with the actual view file name
})->name('about');







// In routes/web.php


// Route for General Settings
// Route for General Settings
Route::get('/general', function () {
    return view('admin.general'); // Adjusted to match the file location
})->name('admin.general');



Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
/*------------------------------------------------------------*/
Route::get('/index_room', [RoomController::class, 'adminIndex'])->name('admin.index_room');

// Route to show the form to create a new room
//Route::get('/add_room/create', [RoomController::class, 'create'])->name('admin.create_room');

// Ensure this route points to the correct method


// Route to store a newly created room

// Route to show the form to edit an existing room
Route::get('index_room/{id}/edit', [RoomController::class, 'edit'])->name('admin.edit_room');

// Route to update an existing room
Route::put('index_room/{id}', [RoomController::class, 'update'])->name('admin.update_room');

// Route to show the confirmation for deleting a room
Route::get('index_room/{id}/delete', [RoomController::class, 'confirmDelete'])->name('admin.confirm_delete');

// Route to delete a room
Route::delete('index_room/{id}', [RoomController::class, 'destroy'])->name('admin.delete_room');
Route::get('/add_room/create', [RoomController::class, 'create'])->name('admin.add_room');

Route::post('/add_room/store', [RoomController::class, 'store'])->name('admin.store_room');


Route::get('/bookings', [BookingController::class, 'showBookings'])->name('home.bookings');
Route::get('/bookings/{id}/payment', [BookingController::class, 'showPaymentPage'])->name('bookings.payment'); // Payment page
// Process payment and book the room

// In web.php


Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');

Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

// Route to show payment page for a specific booking
Route::get('/payment/{id}', [BookingController::class, 'showPaymentPage'])->name('payment.page');

// Route to create Stripe Checkout session
Route::post('/create-checkout-session', [BookingController::class, 'createCheckoutSession'])->name('create.checkout.session');

// Route to handle successful payment
Route::get('/payment-success', [BookingController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment-cancel', [BookingController::class, 'paymentCancel'])->name('payment.cancel');




Route::post('/bookings/cancel', [BookingController::class, 'cancelBooking'])->name('bookings.cancel');
// Show Users
Route::get('show_users', [AdminController::class, 'showUsers'])->name('admin.show_users');

// Route to show the form to add a new user
Route::get('add_user/add', [AdminController::class, 'addUser'])->name('admin.add_user');

// Route to store a new user
Route::post('add_user/store', [AdminController::class, 'storeUser'])->name('admin.store_user');

// Route to show the form to edit a user

// Route to update a user
// Route to show the form to edit a user
Route::get('edit_user/{id}', [AdminController::class, 'editUser'])->name('admin.edit_user');

// Route to update a user
Route::put('edit_user/{id}', [AdminController::class, 'updateUser'])->name('admin.update_user');

// Route to show confirmation for deleting a user
Route::get('delete_user/{id}', [AdminController::class, 'confirmDeleteUser'])->name('admin.confirm_delete_user');

// Route to delete a user
Route::delete('delete_user/{id}', [AdminController::class, 'deleteUser'])->name('admin.delete_user');
// Edit user form
//Route::get('/admin/users/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit_user');

// Update user
//Route::put('/admin/users/update/{id}', [AdminController::class, 'update'])->name('admin.update_user');

// Delete user
//Route::delete('show_users/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete_user');

Route::get('/show_bookings', [BookingController::class, 'adminIndex'])
    ->name('admin.show_bookings');

// Route for displaying all tasks or tasks filtered by status
// Route to show all tasks or filter tasks by status
// Display all tasks with optional status filter
Route::get('/tasks', [TaskController::class, 'index'])->name('admin.tasks');

// Route to show the create task form
Route::get('/tasks/create', [TaskController::class, 'create'])->name('admin.create');

// Route to store a new task
Route::post('/tasks', [TaskController::class, 'store'])->name('admin.store');



// Add route for showing room availability
Route::get('/room_availability', [RoomController::class, 'showAvailability'])->name('admin.room_availability');




Route::get('/export-users', function () {
    return Excel::download(new UsersExport, 'users.xlsx');
});


Route::get('/export-bookings', [BookingsExportController::class, 'exportBookings'])->name('export.bookings');
Route::get('/export-bookings-csv', [BookingsExportController::class, 'exportBookingsCsv'])->name('export.bookings.csv');
Route::get('/export-bookings-json', [BookingsExportController::class, 'exportBookingsJson'])->name('export.bookings.json');



// Route to handle room export
Route::get('/export-rooms', [RoomExportController::class, 'exportRooms'])->name('export.rooms');



// Route to handle blog export
// Route for Excel export
Route::get('/export-blogs', [BlogExportController::class, 'exportBlogs'])->name('export.blogs');

Route::get('/export-blogs-csv', [BlogExportController::class, 'exportBlogsCsv'])->name('export.blogs.csv');
Route::get('/export-blogs-json', [BlogExportController::class, 'exportBlogsJson'])->name('export.blogs.json');




Route::get('/export-rooms-csv', [RoomExportController::class, 'exportRoomsCsv'])->name('export.rooms.csv');
Route::get('/export-rooms-json', [RoomExportController::class, 'exportRoomsJson'])->name('export.rooms.json');


Route::get('/export-users-csv', [ExportController::class, 'exportUsersCsv'])->name('export.users.csv');

// Route to export users as JSON
Route::get('/export-users-json', [ExportController::class, 'exportUsersJson'])->name('export.users.json');
Route::get('/export-users', [ExportController::class, 'exportUsers']);



Route::post('/save-review', [RoomController::class, 'storeReview']);

Route::post('/login', [CustomAuthController::class, 'login']);
Route::post('/refresh', [CustomAuthController::class, 'refresh']);
Route::post('/logout', [CustomAuthController::class, 'logout'])->name('logout');



use App\Http\Controllers\PostController;

Route::resource('posts', PostController::class);



Route::get('/{any}', function () {
    return view('app'); // Ensure this view includes your React app
})->where('any', '.*');