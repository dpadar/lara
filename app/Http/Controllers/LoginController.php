<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request) {

		$credentials = $request->only('username', 'password');

		if (Auth::attempt($credentials, true)) {
			$request->session()->regenerate();

			return redirect()->intended();
		}

		return back()->withErrors([
			'username' => 'The provided credentials do not match our records.'
		]);
	}
}
