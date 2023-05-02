<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
            // le regole per l'update sono diverse: infatti bisognerà controllare che il tiolo del progetto
            // sia unico ma escludendo il nome del post che stia modificando perchè è ovvio che c'è già
            'title' => ['required',
                'max:150',
                Rule::unique('projects','title')->ignore($this->project)
            ],
            'description' => 'nullable|string',
            'client_name' => 'required|regex:/Sig\.r?a? [A-Z][.]*/',
            'client_tel' => 'required|regex:/3[34][0-9]{8}/',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'exists:technologies,id'
        ];
    }
}
