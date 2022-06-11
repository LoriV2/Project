<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class superbaza extends Controller
{
    public function Baza()
    {
        $messages = DB::select('SELECT * FROM Chat');
        return view('chat', ['messages' => $messages]);
    }
}
