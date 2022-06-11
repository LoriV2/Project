<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Event;
use App\Http\Requests;
use Illuminate\Http\Request;
use app\Events;
use App\Events\ChatEvent;
use Illuminate\Support\Facades\DB;
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
Route::post('/sendnonverified', function (Request $request) {
    $user_name = $request->input('user_name');
    $verified = 1;
    $message = request()->message;
    event(new ChatEvent($message));
    $data=array('user_name'=>$user_name,'message'=>$message,'zweryfikowany'=>$verified);
    DB::table('chat')->insert($data);
    return view('chat');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(
    function () {
        Route::post('/sendverified', function () {
            $user_name = auth()->user();
            $verified = 2;
            $message = request()->message;
            event(new ChatEvent($message));
            $data=array('user_name'=>$user_name,'message'=>$message,'zweryfikowany'=>$verified);
            DB::table('chat')->insert($data);
            return view('chat');
        });
    }
);
