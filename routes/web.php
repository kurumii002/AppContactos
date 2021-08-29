<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;
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
    return view('auth.login');
});

/*Route::get('/contacto', function () {
    return view('contacto.index');
});

//accede a la clase ContactoController y al metodo create
Route::get('/contacto/create', [ContactoController::class, 'create']);
*/

//accede automaticamente a los metodos del controlador
Route::resource('contacto', ContactoController::class)->middleware('auth'); //que respeta la autenticacion
Auth::routes(['reset'=>false]);

Route::get('/home', [ContactoController::class, 'index'])->name('home');

//cuando el usuario de logee, se va a ContactoController (index)
Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [ContactoController::class, 'index'])->name('home');
});