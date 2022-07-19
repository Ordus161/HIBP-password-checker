<?php

use Illuminate\Support\Facades\Route;
use App\Jobs\ProcessCheckPassword;
use App\Jobs\LastPwndChecker;
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

Route::get('/', function () {
    return view('welcome');
});


// Route::get('test/{id}', function ($id) {
    
//     dispatch(new ProcessCheckPassword($id));

// });


Route::get('test', function () {
    
        dispatch(new LastPwndChecker());
    
    });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
