<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Settings extends FormRequest
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
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required|numeric',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'fb' => 'required',
            'twitter' => 'required',
            'instgram' => 'required',
            'linkedin' => 'required',
            'keywords' => 'required',
            'vision_en' => 'required',
            'vision_ar' => 'required',
            'mission_en' => 'required',
            'mission_ar' => 'required',
        ];
    }
}
