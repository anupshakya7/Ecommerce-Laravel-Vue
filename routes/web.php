<?php

use App\Http\Controllers\Auth\AuthController;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect('admin/dashboard');
});

Route::get('/login',function(){
    return view('auth.signin');
});

Route::get('/logout',function(){
    Auth::logout();
    return redirect('/login');
});

Route::post('/login_user',[AuthController::class,'loginUser']);
