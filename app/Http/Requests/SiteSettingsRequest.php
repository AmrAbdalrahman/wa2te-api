<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteSettingsRequest extends FormRequest
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
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'email' => 'required',
            'fb' => 'required',
            'twitter' => 'required',
            'instgram' => 'required',
            'linkedin' => 'required',
            'keywords' => 'required',
            'vision_en' => 'required',
            'mission_en' => 'required',
            'vision_ar' => 'required',
            'mission_ar' => 'required',
        ];
    }
}
