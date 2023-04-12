<?php

namespace App\Http\Requests\CPanel\Frame;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFrameRequest extends FormRequest
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
            'name'=>'required|unique:frames,name,'.$this->id
        ];
    }
    public function messages(){
        return [
            'name.required'=>'نوع الفريم مطلوب',
            'name.unique'=>'نوع الفريم مسجل بالفعل'
        ]; 
    }
}
