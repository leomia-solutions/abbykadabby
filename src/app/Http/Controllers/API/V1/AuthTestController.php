<?php

namespace App\Http\Controllers\Api\V1;

class AuthTestController extends Controller
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

    public function gate()
    {
    	return 'Authenticated!';
    }
}
