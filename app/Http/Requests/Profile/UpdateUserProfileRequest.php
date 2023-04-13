<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
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
        $rules = [
            'phone'=>'required|numeric|unique:users,phone,'.$this->id, 
        ]; 
        if ($this->oldPassword != null ){
            $rules['oldPassword']='current_password';
            $rules['password'] = ['required','min:8','confirmed','regex:/^[a-zA-Z0-9!@#$%^&*()_+-=|]+$/']; 
        }        
        return $rules; 
    }
    public function messages(){
        return [
            'oldPassword.current_password'=>'كلمة المرور القديمة غير صحيحة' ,
            'password.required'=>'كلمة المرور الجديدة مطلوبة', 
            'password.confirmed'=>'تأكيد كلمة المرور غير متطابق', 
            'password.min'=>'كلمة المرور لا تقل عن 8 احرف', 
            'password.regex'=>'كلمة المرور تحتوى على رموز غير مسموحة',
            'phone.required'=>'التليفون مطلوب',
            'phone.numeric'=> 'التليفون- ارقام فقط',
            'phone.unique'=>'التليفون مسجل مسبقاً',
        ];
    }
}
