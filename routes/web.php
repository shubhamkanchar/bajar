<?php

use App\Http\Controllers\LogoutController;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\ProductReview;
use App\Livewire\Admin\ProductSeller;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Otp;
use App\Livewire\Auth\Signup;
use App\Livewire\Business\Edit;
use App\Livewire\Business\Profile;
use App\Livewire\Home\Welcome;
use App\Livewire\Onboarding as LivewireOnboarding;
use App\Livewire\Service\Edit as ServiceEdit;
use App\Livewire\Service\Profile as ServiceProfile;
use App\Livewire\User\Edit as UserEdit;
use App\Livewire\User\Profile as UserProfile;
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

Route::get('/', Welcome::class)->name('home');
Route::get('/login', Login::class)->name('login');
Route::get('/signup', Signup::class)->name('signup');

Route::middleware('auth')->group(function () {
    Route::get('/on-boarding', LivewireOnboarding::class)->name('onboarding');
    Route::get('/business-profile', Profile::class)->name('business.profile');
    Route::get('/business-edit/{uuid}', Edit::class)->name('business.edit');
    Route::get('/service-profile', ServiceProfile::class)->name('service.profile');
    Route::get('/service-edit/{uuid}', ServiceEdit::class)->name('service.edit');
    Route::get('/user-profile', UserProfile::class)->name('user.profile');
    Route::get('/user-edit', UserEdit::class)->name('user.edit');
    Route::get('/admin/dashboard/{tab?}', Dashboard::class)->name('admin.dashboard');
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});

Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin/dashboard/{tab?}', Dashboard::class)->name('admin.dashboard');
});

Route::get('/auth/redirect/google', function () {
    return Socialite::driver('google')->redirect();
});
