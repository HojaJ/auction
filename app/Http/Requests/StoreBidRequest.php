<?php

namespace App\Http\Requests;


use App\Rules\BalanceMoreThenUserBids;
use App\Rules\GreaterThanMaxBid;
use Illuminate\Foundation\Http\FormRequest;

class StoreBidRequest extends FormRequest
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
            'lot' => [
                'required',
                'numeric',
                'integer',
            ],
            'bid' => [
                'required',
                'numeric',
                'integer',
                'min:1',
                new GreaterThanMaxBid($this->lot),
                new BalanceMoreThenUserBids
            ]
        ];
    }
}
