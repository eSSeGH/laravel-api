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
        // ui va la logica che gestisce le autorizzazioni per creare un nuovo progetto, ad esempio non 
        // può creare un progetto se non è registrato sul sito ed altro
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
            'title' => 'required|max:150|unique:projects,title',
            'description' => 'nullable|string',
            'client_name' => 'required|regex:/Sig\.r?a? [A-Z][.]*/',
            'client_tel' => 'required|regex:/3[34][0-9]{8}/',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'exists:technologies,id'
        ];
    }
}
