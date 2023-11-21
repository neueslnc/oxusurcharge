<?php

namespace App\Http\Requests\Bid\Statement;

use Illuminate\Foundation\Http\FormRequest;

class StatementRequestCreate extends FormRequest
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
            'theme' => ['required'],
            'pair' => ['required'],
            'description' => ['nullable'],
            'location' => ['required'],
            'subject' => ['required'],
            'group' => ['required'],
            'group_name' => ['required'],
            'date' => ['required', 'date', 'after_or_equal:' . date('Y-m-d', strtotime("+1 day"))]
        ];
    }
}
