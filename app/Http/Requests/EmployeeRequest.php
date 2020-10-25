<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'nullable|max:100',
            'password' => 'nullable|max:100|min:6',
            'gender' => 'required|in:F,M',
            'birth_place' => 'nullable|max:100',
            'birth_date' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg',
            'address' => 'required',
            'nip' => 'nullable',
            'nik' => 'nullable',
            'phone' => 'required|max:16',
            'decission_number' => 'nullable',
            'position_id' => 'required',
            'last_diploma' => 'required',
            'last_diploma_year' => 'required',
            'description' => 'nullable',
            'state' => 'required',
            'role_id' => 'nullable',
        ];
    }
}
