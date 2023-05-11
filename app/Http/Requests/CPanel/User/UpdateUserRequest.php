<?php

namespace App\Http\Requests\CPanel\User;

use App\Enum\User\UserStatus;
use App\Enum\User\UserType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateUserRequest extends FormRequest
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
            'name'=>'required|alpha_dash:ascii|unique:users,name,'.$this->id,
            'phone'=>'required|numeric|unique:users,phone,'.$this->id, 
            'type'=>['required' , new Enum(UserType::class)], 
            'status'=>['required' , new Enum(UserStatus::class)]
        ];        
        if($this->password !=null ) $rules['password'] = ['sometimes','min:4','confirmed','regex:/^[a-zA-Z0-9!@#$%^&*()_+-=|]+$/']; 
        return $rules; 
    }
    public function messages(){
        return [
            'name.required'=>'اسم المستخدم مطلوب', 
            'name.alpha_dash'=>'الاسم - حروف انجليزية فقط',
            'name.unique'=>'الاسم مسجل بالفعل', 
            'password.required'=>'كلمة المرور مطلوبة', 
            'password.confirmed'=>'تأكيد كلمة المرور غير متطابق', 
            'password.min'=>'كلمة المرور لا تقل عن 8 احرف', 
            'password.regex'=>'كلمة المرور تحتوى على رموز غير مسموحة',
            'phone.required'=>'التليفون مطلوب',
            'phone.numeric'=> 'التليفون- ارقام فقط',
            'phone.unique'=>'التليفون مسجل مسبقاً',
            'type.required'=>'نوع المستخدم مطلوب',
            'type'=>'نوع المستخدم غير معروف',
            'status.required'=>'حالة المستخدم مطلوبة',
            'status'=>'حالة المستخدم غير معروفة'
        ];
    }
}
