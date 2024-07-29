<?php

namespace App\Http\Requests\Company\Policy;

use Illuminate\Foundation\Http\FormRequest;

class CarInsurancePolicyRequest extends FormRequest
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
            'car_type' => 'required|string|max:255',
            'car_model' => 'required|string|max:255',
            'car_power' => 'required|integer|min:0',
            'car_number_of_seats' => 'required|integer|min:1',
            'car_year_of_manufacturing' => 'required|integer|digits:4',
            'car_plate_number' => 'required|string|max:255|unique:vehicles,plate_number',
            'car_chassis_number' => 'required|string|max:255|unique:vehicles,chassis_number',
            'car_color' => 'required|string|max:255',
            'car_governorate' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'car_type.required' => 'نوع السيارة مطلوب',
            'car_type.string' => 'نوع السيارة يجب أن يكون نص',
            'car_type.max' => 'نوع السيارة يجب ألا يزيد عن 255 حرفًا',

            'car_model.required' => 'موديل السيارة مطلوب',
            'car_model.string' => 'موديل السيارة يجب أن يكون نص',
            'car_model.max' => 'موديل السيارة يجب ألا يزيد عن 255 حرفًا',

            'car_power.required' => 'قوة السيارة مطلوبة',
            'car_power.integer' => 'قوة السيارة يجب أن تكون رقم صحيح',
            'car_power.min' => 'قوة السيارة يجب أن تكون قيمة موجبة',

            'car_number_of_seats.required' => 'عدد مقاعد السيارة مطلوب',
            'car_number_of_seats.integer' => 'عدد مقاعد السيارة يجب أن يكون رقم صحيح',
            'car_number_of_seats.min' => 'عدد مقاعد السيارة يجب أن يكون 1 على الأقل',

            'car_year_of_manufacturing.required' => 'سنة تصنيع السيارة مطلوبة',
            'car_year_of_manufacturing.integer' => 'سنة تصنيع السيارة يجب أن تكون رقم صحيح',
            'car_year_of_manufacturing.digits' => 'سنة تصنيع السيارة يجب أن تكون 4 أرقام',

            'car_plate_number.required' => 'رقم لوحة السيارة مطلوب',
            'car_plate_number.string' => 'رقم لوحة السيارة يجب أن يكون نص',
            'car_plate_number.max' => 'رقم لوحة السيارة يجب ألا يزيد عن 255 حرفًا',
            'car_plate_number.unique' => 'رقم لوحة السيارة موجود بالفعل',

            'car_chassis_number.required' => 'رقم هيكل السيارة مطلوب',
            'car_chassis_number.string' => 'رقم هيكل السيارة يجب أن يكون نص',
            'car_chassis_number.max' => 'رقم هيكل السيارة يجب ألا يزيد عن 255 حرفًا',
            'car_chassis_number.unique' => 'رقم هيكل السيارة موجود بالفعل',

            'car_color.required' => 'لون السيارة مطلوب',
            'car_color.string' => 'لون السيارة يجب أن يكون نص',
            'car_color.max' => 'لون السيارة يجب ألا يزيد عن 255 حرفًا',

            'car_governorate.required' => 'المحافظة مطلوبة',
            'car_governorate.string' => 'المحافظة يجب أن تكون نص',
            'car_governorate.max' => 'المحافظة يجب ألا تزيد عن 255 حرفًا',
        ];
    }

}
