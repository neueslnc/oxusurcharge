<?php

namespace App\Http\Requests\Criteria;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateCriteriaOnUser extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "user_id" => ['required'],
            "data" => ['required'],
            "increase" => ['required'],
            "criteria_id" => ['required'],
            "status" => ['required'],
            "type" => ['required'],
            "position" => ['required']
        ];
    }
}
