<?php

namespace App\Http\Controllers;

class HelloWorldController extends Controller
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

    public function hello()
    {
    	return 'Hello World!';
    }
}
