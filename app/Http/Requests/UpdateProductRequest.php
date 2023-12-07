<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->usertype == 1;
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
            'id'=>'required|exists:products,id',
            'name'=>'required|string',
            'price'=>'required|numeric',
            'category'=>'required|numeric',
            'description'=>'required|string',
            'date'=>'required|string',
            'files.*'=>'file|mimes:jpg,png,jpeg,pdf',
        ];
    }
}
