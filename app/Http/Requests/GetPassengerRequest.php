<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetPassengerRequest extends FormRequest
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
            'cpf' => 'required_without:ticket|nullable|cpf',
            'ticket' => 'required_without:cpf'
        ];
    }

    public function messages()
    {
        return [
            'cpf.required' => 'CPF é um campo obrigatório',
            'ticket.required' => 'Ticket é um campo obrigatório'
        ];
    }

    public function validate($data)
    {
        $subject = $data;
        $search = str_split('.-');
        $trimmed = str_replace($search, '', $subject);
        return $trimmed;    
    }
}
