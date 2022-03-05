<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'invoice_id'    => 'required',
            'name'          => 'required',
            'quantity'      => 'required',
            'price'         => 'required',
        ];
    }

    public function messages()
    {
        return [
            'invoice_id.required'   => 'El campo Factura es requerido',
            'name.required'         => 'El campo Nombre es requerido',
            'quantity.required'     => 'El campo Cantidad es requerido',
            'price.required'        => 'El campo Precio es requerido',
        ];
    }
}
