<?php

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest {
	protected function failedValidation(Validator $validator) { 
		abort(422);
	}
}