<?php

namespace App\Http\Requests\CPanel\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
             'name'=>'required|unique:customers,name,'.$this->id, 
             'phone'=>'required|numeric|unique:customers,phone,'.$this->id, 
         ];
     }
     public function messages(){
         return [
             'name.required'=>'اسم العميل مطلوب',
             'name.unique'=>'اسم العميل مسجل بالفعل',
             'phone.numeric'=>'التليفون - ارقام فقط',
             'phone.required'=>'التليفون مطلوب',
             'phone.unique'=>'التليفون مسجل مسبقاً'
         ]; 
     }
}
