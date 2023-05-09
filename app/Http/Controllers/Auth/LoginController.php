<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use View;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::user() || Auth::viaRemember()) {
            return redirect()->route('admin.home.index');
        }
        $metaTitle = 'Login';
        return View::make('pages.auth.login', compact('metaTitle'));

    }

    public function loginAction(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'), ($request->remember == 'on') ? true : false)) {
            return redirect()->route('admin.home.index');
        }
        return redirect()->route('auth.login')->with('failure', 'Your email or password is incorrect');
    }
}
