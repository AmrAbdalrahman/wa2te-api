<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
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
            'img' => 'required',
            'title_en' => 'required',
            'desc_en' => 'required',
            'desc_ar' => 'required',
            'title_ar' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ];
    }
}
