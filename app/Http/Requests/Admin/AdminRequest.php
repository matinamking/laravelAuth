<?php

namespace App\Http\Requests\Admin;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = auth()->user();

        $access = [
            'admin.store' => Gate::allows('create', $user),
            'admin.update' => Gate::allows('update', $user),
        ];

        return $access[Route::currentRouteName()] ?? false;
    }
    public function rules(): array
    {
        return [
            'name'=>['required', 'string','min:3'],
            'email'=>['required', 'email'],
            'password'=>['required',Password::min(8)
            ->numbers()
            ->symbols()
            ]
        ];
    }

//    public function passedValidation()
//    {
//        $this->merge([
//            'password' => Hash::make($this->password)
//        ]);
//    }
}
