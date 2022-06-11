<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuperBaza extends Controller
{
    public function Baza()
    {
        $messages = DB::select('SELECT * FROM messages');
        return view('chat', ['messages' => $messages]);
    }
}
