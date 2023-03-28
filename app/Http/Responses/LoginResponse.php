<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {

        if (auth()->user()->role == 'admin' ||  auth()->user()->role == 'superadmin') {
            return redirect()->route('admin.dashboard');;
        }

        if (auth()->user()->role == 'dataentry') {
            return redirect()->route('admin.donatur');;
        }
        if (auth()->user()->role == 'donatur') {

            // if (auth()->user()->display_name) {
            //     return redirect()->intended();
            // } else {
            //     return redirect()->route('register-step2.create');
            // }
            return redirect()->intended(config('fortify.home'));
        }
    }
}
