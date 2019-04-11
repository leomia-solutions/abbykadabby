<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController as BaseController;

class HelloWorldController extends BaseController
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
        return $this->dataResponse(['message' => 'Hello World!']);
    }
}
