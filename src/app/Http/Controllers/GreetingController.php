<?php

namespace App\Http\Controllers;

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


    public function sayHello($name)
    {
        /**
         * Document, [Basic Controllers]
         */
        echo 'Hello, '.$name;
    }
}
