<?php

namespace App\Http\Requests\CPanel\Lens;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLensRequest extends FormRequest
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
            'name'=>'required|unique:lenses,name,'.$this->id
        ];
    }
    public function messages(){
        $this->session()->flash('lastInputs', $this->all()); 
        return [
            'name.required'=>'نوع العدسة مطلوب',
            'name.unique'=>'نوع العدسة مسجل بالفعل'
        ]; 
    }
}
