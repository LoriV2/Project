<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Event;
use App\Http\Requests;
use Illuminate\Http\Request;
use app\Events;
use App\Events\ChatEvent;
use App\Http\Controllers;
use App\Http\Controllers\superbaza;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'

])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/pliki', function () {
        $user = auth()->id();
        $files = DB::table('files')->where('user','=',$user)->get();
        return view('pliki', ['files' => $files]);
    })->name('pliki');

    Route::post('/createfile', function (Request $request) {
        $user = auth()->id();
        $request->file;
        $file_name = time() . '.' . $request->file->extension();
        $data = array('user' => $user, 'file_name' => $file_name);
        DB::table('files')->insert($data);
        Storage::disk('s3')->put('pliki/' . $user, $request->file);
        return view('dashboard');
    });
});
Route::middleware([])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');
});
Route::get('/chat', function () {
    return view('chat');
});
Route::post('/sendnonverified', function (Request $request) {
    $user_name = $request->input('user_name');
    $verified = 1;
    $message = request()->message;
    event(new ChatEvent($message));
    $data = array('user_name' => $user_name, 'message' => $message, 'zweryfikowany' => $verified);
    DB::table('chat')->insert($data);
    $messages = DB::select('SELECT * FROM Chat');
    return view('chatroom', ['messages' => $messages]);
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(
    function () {
        Route::post('/sendverified', function () {
            $user_name = auth()->user()->name;
            $verified = 2;
            $message = request()->message;
            event(new ChatEvent($message));
            $data = array('user_name' => $user_name, 'message' => $message, 'zweryfikowany' => $verified);
            DB::table('chat')->insert($data);
            $messages = DB::select('SELECT * FROM Chat');
            return view('chatroom', ['messages' => $messages]);
        });
    }

);
Route::get('/chatroom', function () {
    $messages = DB::select('SELECT * FROM chat');
    return view('chatroom', ['messages' => $messages]);
});

Route::post('/startroomchat', function () {
    $data = array('user_name' => 'Start', 'message' => 'Nikt jescze nic nie napisał!', 'zweryfikowany' => 2);
    DB::table('chat')->insert($data);
    return view('chat');
});
