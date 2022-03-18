<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcessoGrupoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return ['usuario_sistema_id'=>'required',
        'grupo_id'=>'required',];
    }
}
