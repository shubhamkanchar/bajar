<?php

use App\Http\Controllers\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController as ControllersAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\BusinessController;
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
Route::get('/profile/{uuid}', [ProfileController::class, 'viewBusiness'])->name('view-shop');
Route::post('/send-otp', [ControllersAuthController::class, 'sendOtp'])->name('send.otp');
Route::post('/register', [ControllersAuthController::class, 'register'])->name('register');
Route::post('/verify-otp', [ControllersAuthController::class, 'verifyOtp'])->name('verify.otp');

Route::middleware('auth')->group(function () {
    Route::get('/on-boarding', [OnboardingController::class, 'index'])->name('onboarding');
    Route::post('/onboarding/validate', [OnboardingController::class, 'validateStep'])->name('onboarding.validate');
    Route::post('/onboarding/save', [OnboardingController::class, 'save'])->name('onboarding.save');
    Route::post('/wishlist/remove', [ProfileController::class, 'removeWishlist'])->name('wishlist.remove');
    Route::post('/wishlist/toggle', [ProfileController::class, 'toggleWishlist'])->name('wishlist.toggle');
    Route::post('/review/submit', [ProfileController::class, 'submitReview'])->name('review.submit');
    Route::post('/profile/send-otp', [ProfileController::class, 'sendOtp'])->name('profile.send-otp');
    Route::post('/profile/verify-otp', [ProfileController::class, 'verifyOtp'])->name('profile.verify-otp');
    Route::post('/profile/business-update/{uuid}', [ProfileController::class, 'updateBusiness'])->name('business.update'); 
    
    // Business Dashboard
    Route::get('/business-profile', [BusinessController::class, 'index'])->name('business.profile');
    Route::post('/business/product/save', [BusinessController::class, 'saveProduct'])->name('business.product.save');
    Route::post('/business/product/delete/{id}', [BusinessController::class, 'deleteProduct'])->name('business.product.delete');
    Route::get('/business/product/{id}', [BusinessController::class, 'getProduct'])->name('business.product.get');

    Route::get('/business-edit/{uuid}', [ProfileController::class, 'businessEdit'])->name('business.edit');
    Route::get('/service-profile', [ProfileController::class, 'serviceProfile'])->name('service.profile');
    Route::get('/user-profile', [ProfileController::class, 'userProfile'])->name('user.profile');
    Route::post('/business-edit/{uuid}', [ProfileController::class, 'updateBusiness'])->name('business.update'); // Update
    Route::get('/user-edit/{uuid}', [ProfileController::class, 'userEdit'])->name('user.edit');
    Route::post('/user-edit/{uuid}', [ProfileController::class, 'updateUser'])->name('user.update'); // Update
    Route::post('/user/set-reviewer/{uuid}', [ProfileController::class, 'setReviewer'])->name('user.setReviewer');
    Route::post('/user/delete/{uuid}', [ProfileController::class, 'deleteUser'])->name('user.delete');
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');   
    Route::post('/subscription/create', [App\Http\Controllers\SubscriptionController::class, 'store'])->name('subscription.create');
    Route::post('/subscription/verify', [App\Http\Controllers\SubscriptionController::class, 'verify'])->name('subscription.verify');
    Route::get('/test-subscription', function() {
        return view('test-subscription');
    })->name('test.subscription');
});

Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin/dashboard/{tab?}', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::get('/refresh-csrf', function () {
    return response()->json(['token' => csrf_token()]);
})->name('refresh-csrf');
