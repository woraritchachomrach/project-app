<?php

use App\Http\Controllers\CarRequestController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\CarApprovalController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

//use App\Livewire\UserForm;

//Route::get('/dashboard', function () {
//    return view('dashboard');
//});
//Route::get('/user', function () {
//   return view('user');
//});
//Route::resource('users', UserController::class);
//Route::resource('user-profiles', UserProfileController::class)->only([
//   'index', 'create', 'store' , 
//]);
//Route::get('/users', UserForm::class)->name('users.create');


Route::get('/', function () {
    return view('auth.login');
});

//Route Admin เฉพาระหน้า admin
Route::middleware(['auth', 'role.admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
});

//Route Chief เฉพราะหน้า Chief
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); //ให้chiefไปหน้าdashboardก่อน
Route::middleware(['auth', 'role.chief'])->prefix('chief')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'chiefDashboard'])->name('chief.dashboard');
    
    // หน้ารายการคำขอรถ (รออนุมัติ)
    Route::get('/car-requests/pending', [CarApprovalController::class, 'pending'])->name('chief.car-requests.pending');
    // การอนุมัติ / ไม่อนุมัติ
    Route::post('/car-requests/{id}/approve', [CarApprovalController::class, 'Chiefapprove'])->name('chief.car-requests.approve');
    Route::post('/car-requests/{id}/reject', [CarApprovalController::class, 'Chiefreject'])->name('chief.car-requests.reject');
});

//Route User admin chief หน้าฟอร์มปกติ
Route::middleware(['auth'])->group(function () {
    Route::get('/car-requests/create', [CarRequestController::class, 'create'])->name('car-requests.create');
    Route::post('/car-requests', [CarRequestController::class, 'store'])->name('car-requests.store');
    Route::get('/car-requests/list', [CarRequestController::class, 'index'])->name('car-requests.list');
    Route::get('/user-dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
});

Route::get('/notifications/read/{id}', function ($id) {
    $notification = Auth::user()->notifications()->findOrFail($id);
    $notification->markAsRead();

    return redirect($notification->data['url'] ?? '/');
})->name('notifications.read');


//Route::get('/admin-dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

Route::resource('car-requests', CarRequestController::class);
Route::resource('user-profiles', UserProfileController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
