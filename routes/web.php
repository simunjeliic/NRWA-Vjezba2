<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CountryLanguageController;
 
Route::resource('city', CityController::class);
Route::resource('country', CountryController::class);
Route::resource('admin', AdminUserController::class);
Route::resource('countrylanguage', CountryLanguageController::class);
Route::post('addrole/{id}', [AdminUserController::class, 'addrole'])->name('addrole');
Route::post('destroyrole/{id}', [AdminUserController::class, 'destroyrole'])->name('destroyrole');
Route::get('deleterole/{id}', [AdminUserController::class, 'deleterole'])->name('deleterole');
Route::get('users/createUser', [AdminUserController::class, 'createuser'])->name('users.createuser');
Route::post('users/storeUser', [AdminUserController::class, 'storeuser'])->name('admin.storeuser');
Route::get('users/editUser/{id}', [AdminUserController::class, 'edituser'])->name('admin.edituser');
Route::post('users/updateUser/{id}', [AdminUserController::class, 'updateuser'])->name('admin.updateuser');
Route::delete('users/{id}', [AdminUserController::class, 'deleteuser'])->name('admin.deleteuser');
Route::get('/action', [CityController::class, 'action'])->name('action');
Route::get('/search', [CountryController::class, 'search'])->name('search');
Route::get('/lsearch', [CountryLanguageController::class, 'lsearch'])->name('lsearch');

Route::get('/', function () {
    return view('welcome');
});