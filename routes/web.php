<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

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

Route::redirect('/', '/login');


Route::middleware('isGuest')->group( function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authanticate']);
    Route::get('/register', [RegisterController::class, 'index']);
    Route::post('/register', [RegisterController::class, 'store']);
});


Route::get('/logout', [LoginController::class, 'logout']);


Route::middleware('isLogin')->group( function () {
    Route::get('/dashboard', [LoginController::class, 'dashboard']);
    Route::get('/create', [LoginController::class, 'create']);
    Route::get('/data', [LoginController::class, 'datagaming'])->name('datagaming');
    Route::post('/data', [LoginController::class, 'store']);
    /*
    path yang ada {} artinya path dinamis. path dinamis merupakan path
    datanya diisi dari database. path dinamis ini nantinya akan berubah-ubah
    tergantung data yang diberikan. apabila dalam route-nya ada path dinamis maka 
    nantinya data path dinamis ini dapat diakses oleh controller melalui parameter di
    function nya
    dalam satu route boleh lebih dari satu path dinamis
    */
    Route::get('/edit/{id}', [LoginController::class, 'edit'])->name('edit');
    /* 
        method route buat update data itu pake patch/put
    */
    Route::patch('/update/{id}', [LoginController::class, 'update'])->name('update');
    /* 
        method route buat delete data di database itu pake delete
    */
    Route::delete('/destroy/{id}', [LoginController::class, 'destroy'])->name('destroy');
    // Untuk mengubah on-progress ke completed
    Route::patch('/completed/{id}', [LoginController::class, 'updateToCompleted'])->name('updateCompleted');
});




// Route::middleware('isLogin')->group(function () {
//     Route::get('/dashboard', function() {
//         return view('dashboard.dashboard');
//     });
// });