<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class GreetingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function sayHello(Request $request, $name)
    {
        /**
         * Document, [Basic Controllers]
         */
        return (new Response('Hello, '.$name.' '. $request->input('what'), 201))
            ->header('Content-Type', 'text/plain');
    }
}
