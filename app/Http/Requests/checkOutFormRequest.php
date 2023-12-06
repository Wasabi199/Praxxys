<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class checkOutFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->usertype == 2;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'products'=>'required|array',
            'products.*'=>'required|array',
            'payment_method'=>'required|string',
            'total'=>'required|numeric'
        ];


    }
    public function messages()
    {
        return[
            'products.required'=>'Please select atlease 1 item to Checkout',
            'products.array'=>'Invalid Type',
            'total.required'=>'Total value is required',
            'total.numeric'=>'Total type is invalid'
        ];
    }
}
