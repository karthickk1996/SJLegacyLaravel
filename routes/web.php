<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WillFormController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    /**
     * Verification Routes
     */
    Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify')->middleware(['signed']);
    Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
});

Route::group(['middleware' => ['role:user|admin', 'verified']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard.index');
    Route::get('willform/create', [WillFormController::class, 'show'])->name('willform.create');
    Route::post('willform', [WillFormController::class, 'store'])->name('willform.store');
    Route::get('form/single-will', [WillFormController::class, 'singleWillEdit'])->name('singleWill.form');
    Route::get('form/mirror-will', [WillFormController::class, 'mirrorWillEdit'])->name('mirrorWill.form');
    Route::post('form/update', [WillFormController::class, 'willFormUpdate'])->name('form.update');
    Route::resource('users', UsersController::class);
    Route::get('will/submissions', [WillFormController::class, 'submissions'])->name('willform.submissions');
    Route::get('profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('payment/form', [PaymentController::class, 'paymentForm']);
Route::post('payment/form', [PaymentController::class, 'paymentFormSubmit']);
