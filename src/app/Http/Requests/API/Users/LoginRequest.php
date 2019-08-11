<?php

namespace App\Http\Requests\API\Users;

use App\Http\Requests\API\Request;

class LoginRequest extends Request
{
    /**
     * A logged-in user should not be permitted to make this request
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user() ? false : true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }
}
