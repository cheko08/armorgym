<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateMiembrosRequest extends Request
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
            'nombre' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required|min:7',
            'email' => 'email',
            'sucursal' => 'required',
            'membresia' =>'required',
        ];
    }
}
