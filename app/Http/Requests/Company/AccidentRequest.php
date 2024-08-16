<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class AccidentRequest extends FormRequest
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
            'email_user' => 'required|email|exists:users,email',
            'policy_number' => 'required|exists:policies,policy_number',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'string',
        ];
    }

    public function messages(): array
    {
        return [
            'email_user.required' => 'البريد الإلكتروني مطلوب.',
            'email_user.email' => 'يجب أن يكون البريد الإلكتروني صحيح.',
            'email_user.exists' => 'البريد الإلكتروني غير موجود في جدول المستخدمين.',

            'policy_number.required' => 'رقم الوثيقة مطلوب.',
            'policy_number.exists' => 'رقم الوثيقة غير موجود في جدول الوثائق.',

            'date.required' => 'التاريخ مطلوب.',
            'date.date' => 'يجب أن يكون التاريخ صحيح.',

            'location.required' => 'الموقع مطلوب.',
            'location.string' => 'يجب أن يكون الموقع نصًا.',
            'location.max' => 'يجب ألا يزيد الموقع عن 255 حرفًا.',

            'description.string' => 'يجب أن يكون الوصف نصًا.'
        ];
    }
}
