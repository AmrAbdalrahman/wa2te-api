<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SingleRequest extends FormRequest
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
            'title_en' => 'required',
            'title_ar' => 'required',
            'desc_en' => 'required',
            'desc_ar' => 'required',
            'address_en' => 'required',
            'address_ar' => 'required',
            'phone' => 'required',
            'website' => 'required',
            'fb' => 'required',
            'twitter' => 'required',
            'square_img' => 'required',
            'rect_img' => 'required',
            'keywords' => 'required',
            'lat' => 'required',
            'lon' => 'required',
            'first_time' => 'required',
            'middle_time' => 'required',
            'last_time' => 'required',
        ];
    }
}
