<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteIdentityRequest extends FormRequest
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
            'sitelogo' => 'nullable|image|mimes:jpg,png,jpeg',
            'sitename' => 'required|max:50'
        ];
    }
}
