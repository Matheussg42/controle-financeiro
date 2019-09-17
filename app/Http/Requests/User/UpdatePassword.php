<?php

namespace App\Http\Requests\User;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePassword extends FormRequest
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
        $userId = auth()->user()->id;
        return [
            'newPassword' => 'required',
            'confirmeNewPassword' => 'required|same:newPassword',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->has('oldPassword') && !\Hash::check($this->oldPassword, auth()->user()->password)) {
                $validator->errors()->add('oldPassword', 'Senha Atual Invalida');
            }
        });

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'msg'   => 'Ops! Verifique os dados no formulario',
                'status' => false,
                'errors'    => $validator->errors(),
                'url'    => route('users.update')
            ], 403));
       }
    }
}
