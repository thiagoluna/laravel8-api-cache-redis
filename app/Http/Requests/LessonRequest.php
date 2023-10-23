<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
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
        $uuid = $this->module ?? '';

        return [
            'module' => ['required', 'exists:modules,uuid'],
            'name' => ['required', 'min:3', 'max:255', "unique:lessons,name,{$uuid},uuid"],
            'video' => ['nullable', 'min:3', 'max:255', "unique:lessons,video,{$uuid},uuid"],
            'description' => ['required', 'min:3', 'max:9999'],
        ];
    }
}
