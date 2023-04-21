<?php

namespace App\Http\Requests\Order;

use App\Enum\Order\OrderTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateOrderRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'date'=>'required|date',
            'time'=>'required|date_format:H:i',
            'customer_id'=>'required|numeric',
            'work_type'=>['required' , new Enum(OrderTypes::class)],            
        ];
    }
}
