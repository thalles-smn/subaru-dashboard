<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
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
            'title'=>'required|min:5',
            'text'=>'required|min:30',
            'photo'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'Um titulo é obrigatório',
            'title.min'=>'O titulo precisa de pelo menos 5 caracteres',
            'text.required'=>'A noticia precisa de um texto',
            'text.min'=>'A noticia deve possuir pelo 30 caracteres',
            'photo.required'=>'É necessário uma foto'
        ];
    }
}
