<?php

use App\Http\Controllers\Web\ContactUsController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\MatrixController;
use App\Http\Controllers\Web\PricingController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\ResetPasswordController;
use App\Http\Controllers\Web\SignUpController;
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
Route::get('reset-password/{token}', [ResetPasswordController::class, 'index'])->name('reset-password');
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login-check', [LoginController::class, 'loginCheck'])->name('login-check');
Route::get('contact-us', [ContactUsController::class, 'index'])->name('contact-us');
Route::post('/get-in-touch', [ContactUsController::class, 'getInTouch'])->name('get-in-touch');
Route::get('/signup', [SignUpController::class, 'index'])->name('signup');
Route::post('/signup_2', [SignUpController::class, 'signUp2'])->name('signup_2');
Route::get('/signup_2_view', [SignUpController::class, 'signUp2View'])->name('signup_2_view');
Route::post('/signup_3', [SignUpController::class, 'signUp3'])->name('signup_3');
Route::get('/signup_3_view', [SignUpController::class, 'signUp3View'])->name('signup_3_view');
Route::post('/signup_4', [SignUpController::class, 'signUp4'])->name('signup_4');
Route::get('/signup_4_view', [SignUpController::class, 'signUp4View'])->name('signup_4_view');
Route::post('/signup_5', [SignUpController::class, 'signUp5'])->name('signup_5');
Route::get('/signup_5_view', [SignUpController::class, 'signUp5View'])->name('signup_5_view');
Route::post('/signup_6', [SignUpController::class, 'signUp6'])->name('signup_6');
Route::post('/signup_store', [SignUpController::class, 'signUpStore'])->name('signup_store');
Route::post('/skip_store', [SignUpController::class, 'skipStore'])->name('skip_store');
Route::get('/signup_6_view', [SignUpController::class, 'signUp6View'])->name('signup_6_view');
Route::get('forgetPassword', [ResetPasswordController::class, 'index'])->name('forgetPassword');
Route::get('/checkout', [PricingController::class, 'checkout'])->name('checkout');
Route::post('/session', [PricingController::class, 'session'])->name('session');
Route::get('/success', [PricingController::class, 'success'])->name('success');
Route::post('send-mail', [ResetPasswordController::class, 'sendMail'])->name('send-mail');
Route::post('subscribe', [HomeController::class, 'subscribe'])->name('subscribe');
Route::get('getAttributeRow/{row}', [SignUpController::class, 'getAttributeRow'])->name('getAttributeRow');
Route::get('getAttributeRowForPlan/{row}', [SignUpController::class, 'getAttributeRowForPlan'])->name('getAttributeRowForPlan');
Route::get('forgot-password/{token}', [ResetPasswordController::class, 'forgotPassword'])->name('forgot-password');
Route::get('pricing', [PricingController::class, 'index'])->name('pricing');
Route::post('forgot-password-submit', [ResetPasswordController::class, 'forgotPasswordSubmit'])->name('forgot-password-submit');

Route::group(['middleware' => ['auth:web', 'webCheck']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile');
    Route::post('update-profile-store', [ProfileController::class, 'updateProfileStore'])->name('update-profile-store');
    Route::get('matrix/{child_id}', [MatrixController::class, 'index'])->name('matrix');
    Route::get('getRisk/{id}/{child_id}', [MatrixController::class, 'getRisk'])->name('getRisk');
    Route::get('getRiskWiseRecommendation/{risk}/{child_id}', [MatrixController::class, 'getRiskWiseRecommendation'])->name('getRiskWiseRecommendation');
});
