<?php

namespace App\Http\Requests\Company\Policy;

use Illuminate\Foundation\Http\FormRequest;

class OrangeCarInsuranceRequest extends FormRequest
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
            'car_engine_number' => 'required|string|max:255',                       // |unique:vehicles,engine_number
            'car_chassis_number' => 'required|string|max:255',                      // |unique:vehicles,chassis_number
            'car_plate_number' => 'required|string|max:255',                        // |unique:vehicles,plate_number
            'car_year_of_manufacturing' => 'required|integer|digits:4',
            'car_type' => 'required|string|max:255',
            'car_nationality' => 'required|string|max:255',
            'insurance_period' => 'required|integer|min:1',
            'start_date' => 'required|date|after_or_equal:today',
            'available_car_id' => 'required|exists:available_cars,id',
            'country_visited_id' => 'required|exists:orange_visited_countries,id',
        ];
    }

    public function messages(): array
    {
        return [
            'car_engine_number.required' => 'حقل رقم محرك السيارة مطلوب.',
            'car_engine_number.string' => 'يجب أن يكون رقم محرك السيارة نصاً صالحاً.',
            'car_engine_number.max' => 'لا يجوز أن يتجاوز رقم محرك السيارة 255 حرفاً.',
            // 'car_engine_number.unique' => 'رقم محرك السيارة موجود بالفعل.',

            'car_chassis_number.required' => 'رقم هيكل السيارة مطلوب',
            'car_chassis_number.string' => 'رقم هيكل السيارة يجب أن يكون نص',
            'car_chassis_number.max' => 'رقم هيكل السيارة يجب ألا يزيد عن 255 حرفًا',
            // 'car_chassis_number.unique' => 'رقم هيكل السيارة موجود بالفعل',

            'car_plate_number.required' => 'رقم لوحة السيارة مطلوب',
            'car_plate_number.string' => 'رقم لوحة السيارة يجب أن يكون نص',
            'car_plate_number.max' => 'رقم لوحة السيارة يجب ألا يزيد عن 255 حرفًا',
            // 'car_plate_number.unique' => 'رقم لوحة السيارة موجود بالفعل',

            'car_year_of_manufacturing.required' => 'سنة تصنيع السيارة مطلوبة',
            'car_year_of_manufacturing.integer' => 'سنة تصنيع السيارة يجب أن تكون رقم صحيح',
            'car_year_of_manufacturing.digits' => 'سنة تصنيع السيارة يجب أن تكون 4 أرقام',

            'car_type.required' => 'نوع السيارة مطلوب',
            'car_type.string' => 'نوع السيارة يجب أن يكون نص',
            'car_type.max' => 'نوع السيارة يجب ألا يزيد عن 255 حرفًا',

            'car_nationality.required' => 'حقل جنسية السيارة مطلوب.',
            'car_nationality.string' => 'يجب أن تكون جنسية السيارة نصاً صالحاً.',
            'car_nationality.max' => 'لا يجوز أن تتجاوز جنسية السيارة 255 حرفاً.',

            'insurance_period.required' => 'فترة التأمين مطلوبة.',
            'insurance_period.integer' => 'يجب أن تكون فترة التأمين عددًا صحيحًا.',
            'insurance_period.min' => 'يجب أن تكون فترة التأمين أكبر من 0.',

            'start_date.required' => 'حقل تاريخ البدء مطلوب.',
            'start_date.date' => 'يجب أن يكون تاريخ البدء تاريخًا صالحًا.',
            'start_date.after_or_equal' => 'يجب أن يكون تاريخ البدء اليوم أو تاريخًا مستقبليًا.',

            'available_car_id.required' => 'حقل رقم السيارة المتاحة مطلوب.',
            'available_car_id.exists' => 'رقم السيارة المتاحة غير موجود.',

            'country_visited_id.required' => 'حقل رقم البلد الذي تمت زيارته مطلوب.',
            'country_visited_id.exists' => 'رقم البلد الذي تمت زيارته غير موجود.',
        ];
    }
}
