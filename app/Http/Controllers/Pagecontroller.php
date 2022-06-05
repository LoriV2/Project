<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pagecontroller extends Controller
{
    public function show($slug){
        $pages=[
'about' => 'hehhe',
'jusz' => 'jak to jest byc skrybom'
        ];
        return $pages[$slug];
    }
}
