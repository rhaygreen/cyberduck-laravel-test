<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_product' => 'required|numeric|exists:products,id',
            'quantity' => 'required|numeric|min:0|max:9999|decimal:0,6',
            'unit_cost' => 'required|numeric|min:0|max:9999|decimal:0,6',
        ];
    }
}
