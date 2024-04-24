<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminLoginController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(request $request)
    {
        $Validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|'
        ]);

        if ($Validator->passes()) {
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' =>
            $request->password], $request->get('remember'))) {

                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('admin.login')->with('error', 'Either email/Password is incorrect');
            }
        } else {
            return redirect()->route('admin.login')
                ->withErrors($Validator)
                ->withInput($request->only('email'));
        }
    }
}
