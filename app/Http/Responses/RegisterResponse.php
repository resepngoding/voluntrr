<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as ContractsRegisterResponse;

class RegisterResponse implements ContractsRegisterResponse
{

    public function toResponse($request)
    {
        if (auth()->user()->role == 'user') {
            if (auth()->user()->display_name) {
                return redirect()->intended();
            } else {
                return redirect()->route('register-step2.create');
            }
        }
        return redirect()->intended(config('fortify.home'));
    }
}
