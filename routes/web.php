<?php

use App\Http\Controllers\Web\ContactUsController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\MatrixController;
use App\Http\Controllers\Web\PricingController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\RecommendationController;
use App\Http\Controllers\Web\ResetPasswordController;
use App\Http\Controllers\Web\SignUpController;
use App\Http\Controllers\Web\SubscriptionController;
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
Route::get('/payment-success', [SubscriptionController::class, 'paymentSuccess'])->name('payment-success');
Route::get('/payment-error', [SubscriptionController::class, 'paymentError'])->name('payment-error');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login-check', [LoginController::class, 'loginCheck'])->name('login-check');
Route::get('contact-us', [ContactUsController::class, 'index'])->name('contact-us');
Route::post('/get-in-touch', [ContactUsController::class, 'getInTouch'])->name('get-in-touch');
Route::get('/signup', [SignUpController::class, 'index'])->name('signup');
Route::post('/signup_2', [SignUpController::class, 'signUp2'])->name('signup_2');
Route::get('/add-child-info', [SignUpController::class, 'signUp2View'])->name('add-child-info');
Route::post('/signup_3', [SignUpController::class, 'signUp3'])->name('signup_3');
Route::get('/create-password', [SignUpController::class, 'signUp3View'])->name('create-password');
Route::post('/signup_4', [SignUpController::class, 'signUp4'])->name('signup_4');
Route::get('/create-plan', [SignUpController::class, 'signUp4View'])->name('create-plan');
Route::post('/signup_5', [SignUpController::class, 'signUp5'])->name('signup_5');
Route::get('/child-info', [SignUpController::class, 'signUp5View'])->name('child-info');
Route::post('/signup_6', [SignUpController::class, 'signUp6'])->name('signup_6');
Route::post('/signup_store', [SignUpController::class, 'signUpStore'])->name('signup_store');
Route::post('/skip_store', [SignUpController::class, 'skipStore'])->name('skip_store');
Route::get('/child-characteristics', [SignUpController::class, 'signUp6View'])->name('child-characteristics');
Route::get('forgetPassword', [ResetPasswordController::class, 'index'])->name('forgetPassword');
//Route::get('/checkout', [PricingController::class, 'checkout'])->name('checkout');
Route::post('/session', [PricingController::class, 'session'])->name('session');
Route::get('/success', [PricingController::class, 'success'])->name('success');
Route::post('send-mail', [ResetPasswordController::class, 'sendMail'])->name('send-mail');
Route::post('subscribe', [HomeController::class, 'subscribe'])->name('subscribe');
Route::get('getAttributeRow/{row}', [SignUpController::class, 'getAttributeRow'])->name('getAttributeRow');
Route::get('getAttributeRowForPlan/{row}', [SignUpController::class, 'getAttributeRowForPlan'])->name('getAttributeRowForPlan');
Route::get('forgot-password/{token}', [ResetPasswordController::class, 'forgotPassword'])->name('forgot-password');
Route::get('pricing', [PricingController::class, 'index'])->name('pricing');
Route::post('forgot-password-submit', [ResetPasswordController::class, 'forgotPasswordSubmit'])->name('forgot-password-submit');
Route::get('/subscription', [SubscriptionController::class, 'subscribe'])->name('subscription');
Route::post('/subscription', [SubscriptionController::class, 'processSubscription']);
Route::get('/cancel-subscription', [SubscriptionController::class, 'cancelSubscription'])->name('cancel-subscription');
Route::group(['middleware' => ['auth:web', 'webCheck']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/done/{child_id}/{id}', [DashboardController::class, 'done'])->name('done');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile');
    Route::post('update-profile-store', [ProfileController::class, 'updateProfileStore'])->name('update-profile-store');
    Route::get('matrix/{child_id}', [MatrixController::class, 'index'])->name('matrix');
    Route::get('getRisk/{id}/{child_id}', [MatrixController::class, 'getRisk'])->name('getRisk');
    Route::get('add-to-calendar/{title}/{desc}', [MatrixController::class, 'addToCalendar'])->name('add-to-calendar');
    Route::get('add-to-apple-calendar/{title}/{desc}', [MatrixController::class, 'addToAppleCalendar'])->name('add-to-apple-calendar');
    Route::get('add-to-microsoft-calendar/{title}/{desc}', [MatrixController::class, 'addToMicrosoftCalendar'])->name('add-to-microsoft-calendar');
    Route::get('getRiskWiseRecommendation/{risk}/{child_id}', [MatrixController::class, 'getRiskWiseRecommendation'])->name('getRiskWiseRecommendation');
    Route::get('recommendation/{id}/{child_id}', [RecommendationController::class, 'index'])->name('recommendation');
    Route::get('risk-change-event/{risk}/{child_id}', [MatrixController::class, 'riskChangeEvent'])->name('risk-change-event');


});
