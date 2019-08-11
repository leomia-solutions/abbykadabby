<?php

namespace App\Http\Requests\API\Inventory;

use App\Http\Requests\API\Request;

class ListRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description_contains' => 'nullable',
        ];
    }
}
