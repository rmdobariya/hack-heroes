<?php

use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RecommendationController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubscribeController;
use App\Http\Controllers\Admin\SubscriptionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//dd(123);
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login-check', [LoginController::class, 'loginCheck'])->name('login-check');
Route::post('send-mail', [PasswordController::class, 'sendMail'])->name('send-mail');
Route::get('reset-password/{token}', [PasswordController::class, 'resetPassword'])->name('reset-password');
Route::post('reset-password-submit', [PasswordController::class, 'resetPasswordSubmit'])->name('reset-password-submit');
Route::group(['middleware' => ['auth:admin', 'adminCheck']], function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('my-profile', [ProfileController::class, 'index'])->name('my-profile');
    Route::post('updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('change-panel-mode/{id}', [HomeController::class, 'changePanelMode'])->name('change-panel-mode');
    Route::get('/change-password', [PasswordController::class, 'index'])->name('change-password');
    Route::post('update-password', [PasswordController::class, 'updatePassword'])->name('update-password');
    Route::resource('customer', CustomerController::class);
    Route::get('get-customer-list', [CustomerController::class, 'getCustomerList'])->name('get-customer-list');
    Route::get('customer/status/{id}/{status}', [CustomerController::class, 'changeStatus'])->name('customer.status.change');
    Route::post('multiple-user-delete', [CustomerController::class, 'multipleUserDelete'])->name('multiple-user-delete');
    Route::get('restore-customer/{id}', [CustomerController::class, 'restoreCustomer'])->name('restore-customer');
    Route::delete('customer-hard-delete/{id}', [CustomerController::class, 'hardDelete'])->name('customer-hard-delete');
    Route::get('getRow/{id}', [CustomerController::class, 'getRow'])->name('getRow');
    Route::resource('role', RoleController::class);
    Route::get('get-role-list', [RoleController::class, 'getRoleList'])->name('get-role-list');

    Route::resource('permission', PermissionController::class);
    Route::get('get-permission-list', [PermissionController::class, 'getPermissionList'])->name('get-permission-list');

    Route::resource('setting', SettingController::class);
    Route::post('general-setting-store', [SettingController::class, 'generalSettingStore'])->name('general-setting-store');
    Route::post('email-setting-store', [SettingController::class, 'emailSettingStore'])->name('email-setting-store');
    Route::post('app-setting-store', [SettingController::class, 'appSettingStore'])->name('app-setting-store');
    Route::post('contact-info-store', [SettingController::class, 'contactInfoStore'])->name('contact-info-store');
    Route::post('social-media-store', [SettingController::class, 'socialMediaStore'])->name('social-media-store');
    Route::post('footer-store', [SettingController::class, 'footerStore'])->name('footer-store');

//    Route::resource('page', PageController::class);
//    Route::get('get-page-list', [PageController::class, 'getPageList'])->name('get-page-list');
//    Route::get('page/status/{id}/{status}', [PageController::class, 'changeStatus'])->name('page.status.change');
//    Route::post('multiple-page-delete', [PageController::class, 'multiplePageDelete'])->name('multiple-page-delete');

    Route::resource('contact-us', ContactUsController::class);
    Route::get('get-contact-us-list', [ContactUsController::class, 'getContactUsList'])->name('get-contact-us-list');
    Route::get('contact-us/status/{id}/{status}', [ContactUsController::class, 'changeStatus'])->name('contact-us.status.change');
    Route::post('multiple-contact-us-delete', [ContactUsController::class, 'multipleContactUsDelete'])->name('multiple-contact-us-delete');

    Route::resource('recommendation', RecommendationController::class);
    Route::get('get-recommendation-list', [RecommendationController::class, 'getRecommendationList'])->name('get-recommendation-list');
    Route::get('recommendation/status/{id}/{status}', [RecommendationController::class, 'changeStatus'])->name('recommendation.status.change');
    Route::post('multiple-recommendation-delete', [RecommendationController::class, 'multipleRecommendationDelete'])->name('multiple-recommendation-delete');

    Route::resource('subscription', SubscriptionController::class);
    Route::get('get-subscription-list', [SubscriptionController::class, 'getSubscriptionList'])->name('get-subscription-list');
    Route::get('subscription/status/{id}/{status}', [SubscriptionController::class, 'changeStatus'])->name('subscription.status.change');
    Route::post('multiple-subscription-delete', [SubscriptionController::class, 'multipleSubscriptionDelete'])->name('multiple-subscription-delete');

    Route::resource('faq', FaqController::class);
    Route::get('get-faq-list', [FaqController::class, 'getFaqList'])->name('get-faq-list');
    Route::get('faq/status/{id}/{status}', [FaqController::class, 'changeStatus'])->name('faq.status.change');
    Route::post('multiple-faq-delete', [FaqController::class, 'multipleFaqDelete'])->name('multiple-faq-delete');
    Route::delete('faq-hard-delete/{id}', [FaqController::class, 'hardDelete'])->name('faq-hard-delete');
    Route::get('restore-faq/{id}', [FaqController::class, 'restoreFaq'])->name('restore-faq');

    Route::resource('plan', PlanController::class);
    Route::get('get-plan-list', [PlanController::class, 'getPlanList'])->name('get-plan-list');
    Route::get('plan/status/{id}/{status}', [PlanController::class, 'changeStatus'])->name('plan.status.change');
    Route::post('multiple-plan-delete', [PlanController::class, 'multiplePlanDelete'])->name('multiple-plan-delete');
    Route::delete('plan-hard-delete/{id}', [PlanController::class, 'hardDelete'])->name('plan-hard-delete');
    Route::get('restore-plan/{id}', [PlanController::class, 'restorePlan'])->name('restore-plan');

    Route::resource('subscribe', SubscribeController::class);
    Route::get('get-subscribe-list', [SubscribeController::class, 'getSubscribeList'])->name('get-subscribe-list');
    Route::post('multiple-subscribe-delete', [SubscribeController::class, 'multipleSubscribeDelete'])->name('multiple-subscribe-delete');
    Route::delete('subscribe-hard-delete/{id}', [SubscribeController::class, 'hardDelete'])->name('subscribe-hard-delete');
    Route::get('restore-subscribe/{id}', [SubscribeController::class, 'restoreSubscribe'])->name('restore-subscribe');
});
