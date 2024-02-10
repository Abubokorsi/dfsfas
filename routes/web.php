<?php
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\WelcomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Routing\RouteAction;
use Illuminate\Support\Facades\Route;
use Monolog\Handler\RotatingFileHandler;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

// frontend
Route::get('/', [HomeController::class, 'Home'])->name('home');
Route::post('bookings', [HomeController::class, 'booking'])->name('bookings.booking');

// admin route
Route::group(['prefix'=> 'admin', 'middleware'=>'verified','auth'], function(){
Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::resource('slider', SliderController::class);
Route::resource('category', CategoryController::class);
Route::resource('item', ItemController::class);
Route::resource('welcome', WelcomeController::class);
Route::resource('booking', BookingController::class);
Route::post('confirm{id}', [BookingController::class, 'confirm']);
Route::post('complet{id}', [BookingController::class, 'completed']);
});


Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
