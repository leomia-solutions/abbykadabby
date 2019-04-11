<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends BaseController
{
	/**
	 * Logs in a user or returns an error
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response;
	 */
	public function login(Request $request)
	{
		$this->validate($request, [
			'email' => 'required',
			'password' => 'required',
		]);
	}
}
