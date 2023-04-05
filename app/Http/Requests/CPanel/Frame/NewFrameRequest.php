<?php

namespace App\Http\Requests\CPanel\Frame;

use Illuminate\Foundation\Http\FormRequest;

class NewFrameRequest extends FormRequest
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
        $this->session()->flash('lastInputs', $this->all()); 
        return [
            'name'=>'required|unique:frames'
        ];
    }
    public function messages(){
        return [
            'name.required'=>'نوع الفريم مطلوب',
            'name.unique'=>'نوع الفريم مسجل بالفعل'
        ]; 
    }
}
