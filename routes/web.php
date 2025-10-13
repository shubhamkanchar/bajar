<?php

use App\Http\Controllers\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController as ControllersAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OnboardingController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [ControllersAuthController::class, 'login'])->name('login');
Route::get('/signup', [ControllersAuthController::class, 'signup'])->name('signup');
Route::get('/blog', [HomeController::class, 'blog'])->name('blogs');
Route::get('/blogs/{slug}', [HomeController::class, 'blogShow'])->name('blog');
Route::get('page/{slug}', [HomeController::class, 'page'])->name('page');

Route::middleware('auth')->group(function () {
    Route::get('/on-boarding', [OnboardingController::class, 'index'])->name('onboarding');
    Route::get('/business-profile', [ProfileController::class, 'businessProfile'])->name('business.profile');
    Route::get('/business-edit/{uuid}', [ProfileController::class, 'businessEdit'])->name('business.edit');
    Route::get('/service-profile', [ProfileController::class, 'serviceProfile'])->name('service.profile');
    Route::get('/user-profile', [ProfileController::class, 'userProfile'])->name('user.profile');
    Route::get('/user-edit/{uuid}', [ProfileController::class, 'userEdit'])->name('user.edit');
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');   
});

Route::get('/profile/{uuid}', [ProfileController::class, 'viewBusiness'])->name('view-shop');
Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin/dashboard/{tab?}', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::get('/refresh-csrf', function () {
    return response()->json(['token' => csrf_token()]);
})->name('refresh-csrf');
