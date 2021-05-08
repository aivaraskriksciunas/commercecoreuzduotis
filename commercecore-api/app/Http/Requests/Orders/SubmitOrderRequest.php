<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubmitOrderRequest extends FormRequest
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
            'product_id' => 'exists:products,id',
            'card_number' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                    if ( strlen( "$value" ) !== 16 ) {
                        $fail( 'Card number must be exactly 16 digits.');
                    }
                },
            ],
            'card_security_code' => 'required|numeric',
            'expiration_month'  => 'required|numeric|min:1|max:12',
            'expiration_year'   => 'required|numeric',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'country' => 'required',
            'state' => 'sometimes',
            'city' => 'sometimes',
            'postcode' => 'required',
            'warranty' => 'required|boolean'
        ];
    }
}
