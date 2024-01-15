<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GeoCoderSolid\ResultProcessor;

class TestController extends Controller
{

    public function index(Request $request, ResultProcessor $placesOutput)
    {
        dump($placesOutput->perform());
        dump($placesOutput->perform());
    }
}
