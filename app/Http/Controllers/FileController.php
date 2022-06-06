<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
{
    public function create()
    {
        return view('uploadfile');
    }
    public function fileUpload()
    {
        Storage::disk('local')->put('example.txt', 'Contents');
    }
}
