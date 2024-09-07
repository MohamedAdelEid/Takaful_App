<?php

namespace App\Http\Requests\Company\Policy;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class TravelerInsuranceRequest extends FormRequest
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
        $today = Carbon::today();

        return [
            'coverage_area_id' => 'required|exists:coverage_areas,id',
            'days' => 'required|integer|in:10,20,30,45,90,180,365',
            'start_date' => "required|date|after_or_equal:$today",
            'passport_number' => 'required|string|max:255',
            'name_in_passport' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:female,male',
            'dependents' => 'nullable|array',
            'dependents.*.passport_number' => 'required_with:dependents|string|max:255|distinct',
            'dependents.*.passport_name' => 'required_with:dependents|string|max:255',
            'dependents.*.date_of_birth' => 'required_with:dependents|date',
            'dependents.*.gender' => 'required_with:dependents|string|in:Male,Female',
            'image' =>  'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'coverage_area_id.required' => 'يرجى تحديد منطقة التغطية.',
            'coverage_area_id.exists' => 'منطقة التغطية المحددة غير موجودة.',
            'days.required' => 'يرجى تحديد عدد الأيام.',
            'days.integer' => 'عدد الأيام يجب أن يكون عددًا صحيحًا.',
            'days.in' => 'عدد الأيام خطأ',
            'start_date.required' => 'يرجى تحديد تاريخ البدء.',
            'start_date.date' => 'تاريخ البدء غير صحيح.',
            'start_date.after_or_equal' => 'تاريخ البدء يجب أن يكون اليوم أو بعده.',
            'passport_number.required' => 'يرجى إدخال رقم جواز السفر.',
            'passport_number.string' => 'رقم جواز السفر يجب أن يكون نصًا.',
            'passport_number.max' => 'رقم جواز السفر يجب ألا يتجاوز 255 حرفًا.',
            'name_in_passport.required' => 'يرجى إدخال الاسم في جواز السفر.',
            'name_in_passport.string' => 'الاسم في جواز السفر يجب أن يكون نصًا.',
            'name_in_passport.max' => 'الاسم في جواز السفر يجب ألا يتجاوز 255 حرفًا.',
            'date_of_birth.required' => 'يرجى تحديد تاريخ الميلاد.',
            'date_of_birth.date' => ' تاريخ الميلاد يجب ان يكون تاريخ.',
            'gender.required' => 'يرجى تحديد الجنس.',
            'gender.in' => 'الجنس يجب ان يكون ذكر او انثي.',
            'dependents.array' => 'الاعتماد يجب أن يكون مصفوفة.',
            'dependents.*.passport_number.required_with' => 'رقم جواز السفر للتابع مطلوب.',
            'dependents.*.passport_number.distinct' => 'لا يمكنك تكرار رقم جواز الشخص اكثر من مرة',
            'dependents.*.passport_name.required_with' => 'اسم جواز السفر للتابع مطلوب.',
            'dependents.*.date_of_birth.required_with' => 'تاريخ ميلاد التابع مطلوب.',
            'dependents.*.gender.required_with' => 'جنس التابع مطلوب.',
            'dependents.*.gender.in' => 'الجنس يجب أن يكون "Male" أو "Female".'
        ];
    }
}
