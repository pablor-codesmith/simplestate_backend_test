<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use SimpleState\Models\Operation;

class TransactionFilterRequest extends FormRequest
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
            'user_id' => ['sometimes','nullable',Rule::exists(User::class,'id')],
            'created_at' => ['sometimes','nullable','date_format:Y-m-d'],
            'operation_id' => ['sometimes','nullable',Rule::exists(Operation::class,'id')]
        ];
    }
}
