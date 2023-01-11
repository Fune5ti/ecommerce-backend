<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PurchaseCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'client.name' => 'required|max:255',
            'client.email' => 'required|email',
            'client.phone' => 'required',
            'client.address' => 'required',
            'client.city' => 'required',
            'client.zip' => 'required',
            'client.country' => 'required',
            'client.cpf' => 'required',
            'products' => 'required|array',
            'products.*.id' => [
                'required',
                Rule::exists('products', 'id'),
            ],
            'products.*.quantity' => 'required|numeric|min:1',
        ];
    }

    public function failedValidation(Validator $validator)

    {

        throw new HttpResponseException(response()->json([

            'success'   => false,

            'message'   => 'Validation errors',

            'data'      => $validator->errors()

        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }



    public function messages()

    {

        return [

            'client.name' => 'Client name is required',
            'client.email' => 'Client email is required',
            'client.phone' => 'Client phone is required',
            'client.address' => 'Client address is required',
            'client.city' => 'Client city is required',
            'client.zip' => 'Client zip is required',
            'client.country' => 'Client country is required',
            'client.cpf' => 'Client cpf is required',
            'products' => 'Purchase must include at least one item, and the item must exist',

        ];
    }
}
