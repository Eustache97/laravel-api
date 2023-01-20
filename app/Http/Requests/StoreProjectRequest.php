<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'type_id' => ['nullable', 'exists:types,id'],
            'title' => ['required', 'min:3', 'max:150', 'unique:projects'],
            'cover_image' => ['nullable', 'image', 'max:550'],
            'description' => ['nullable'],
            'technologies' => ['exists:technologies,id']
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Il titolo è richiesto',
            'title.min' => 'La lunghezza minima del titolo è di 3 caratteri',
            'title.max' => 'La lunghezza massima del titolo è di :max caratteri',
            'title.unique' => 'Questo titolo è già assegnato a un altro elemento'
        ];
    }
}
