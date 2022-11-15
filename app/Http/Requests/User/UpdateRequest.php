<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\Hash;

class UpdateRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required',
        ];
    }

    public function data()
    {
        return [
            'name' => $this->input('name'),
            'email' => $this->input('email'),
            'password' => Hash::make($this->input('password')),
        ];
    }
}