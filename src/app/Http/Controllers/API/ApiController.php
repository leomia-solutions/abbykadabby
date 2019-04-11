<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
	/**
	 * @param array $rules
	 */
	protected function validate($rules)
	{

	}

	/**
	 * @param array $data
	 *
	 * @return \Illuminate\Http\Response
	 */
	protected function dataResponse($data) {
		return response()->json(
			[
				'data' => $data,
			]);
	}
}
