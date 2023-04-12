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
        return [
            'name'=>'required|unique:users,name,'.$this->id,
            'password'=>'sometimes|nullable|min:8|confirmed', 
            'phone'=>'required|numeric|unique:users,phone,'.$this->id, 
            'type'=>['required' , new Enum(UserType::class)], 
            'status'=>['required' , new Enum(UserStatus::class)]
        ];
    }
    public function messages(){
        return [
            'name.required'=>'اسم المستخدم مطلوب', 
            'name.unique'=>'الاسم مسجل بالفعل', 
            'password.required'=>'كلمة المرور مطلوبة', 
            'password.confirmed'=>'تأكيد كلمة المرور غير متطابق', 
            'password.min'=>'كلمة المرور لا تقل عن 8 احرف', 
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
