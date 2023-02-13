<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RandomController extends Controller
{
    public function index()
    {
        /* get quotes from api("http://type.fit/api/quotes") */
        $data = Http::get('http://type.fit/api/quotes');
        return json_decode($data);
    }
}
