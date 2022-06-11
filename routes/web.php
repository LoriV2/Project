<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use app\Events\ChatEvent;
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
    return ('welcome');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/pliki', function () {
        return view('pliki');
    })->name('pliki');
});
Route::middleware([])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

    Route::get('/chat', function () {
        return view('chat');
    })->name('chat');
});
Route::post('send', function (Request $request) {
    $request->validate([
        'name' => 'required',
        'message' => 'required'
    ]);

    $message = [
        'name' => $request->name,
        'message' => $request->message,
    ];

    ChatEvent::dispatch($message);
});
