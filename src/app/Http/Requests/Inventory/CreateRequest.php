<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'description'    => 'required',
            'quantity'       => 'integer',
            'weight'         => 'required|numeric|min:0',
            'weight_units'   => 'required|in:lb,kg',
            'price'          => 'required|numeric|min:0',
            'price_units'    => 'required|in:ea,lb,kg',
        ];
    }
}
