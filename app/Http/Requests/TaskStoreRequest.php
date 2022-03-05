<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
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
            'name'          => 'required',
            'description'   => 'required',
            'end_date'      => 'required',
            'user_id'       => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'El campo Nombre es requerido',
            'description.required'  => 'El campo Descripción es requerido',
            'end_date.required'     => 'El campo Fecha es requerido',
            'user_id.required'      => 'El campo Usuario es requerido',
        ];
    }
}
