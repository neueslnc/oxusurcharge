<?php

namespace App\Http\Requests\Bid;

use Illuminate\Foundation\Http\FormRequest;

class BidRequestCreate extends FormRequest
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
            'time' => ['required'],
            'theme' => ['required'],
            'pair' => ['required'],
            'description' => ['required'],
            'location' => ['required'],
            'subject' => ['required'],
            'group' => ['required'],
            'group_name' => ['required'],
            'date' => ['required']
        ];
    }
}
