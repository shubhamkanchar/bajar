<?php

use App\Livewire\Admin\Dashboard;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Otp;
use App\Livewire\Auth\Signup;
use App\Livewire\Business\Edit;
use App\Livewire\Business\Profile;
use App\Livewire\Home\Welcome;
use App\Livewire\Onboarding as LivewireOnboarding;
use App\Livewire\Service\Edit as ServiceEdit;
use App\Livewire\Service\Profile as ServiceProfile;
use Illuminate\Support\Facades\Route;

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
    Route::get('/service-profile', ServiceProfile::class);
    Route::get('/service-edit/{uuid}', ServiceEdit::class)->name('service.edit');
    Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
});
