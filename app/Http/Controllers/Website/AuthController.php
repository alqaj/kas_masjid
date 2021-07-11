<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Website\LoginRequest;
use Auth;

class AuthController extends Controller
{
    /**
     * Get login page
     */
    public function showLoginPage()
    {
        if (auth()->user()) {
            return redirect('/');
        }

        return view('website.auth.login');
    }

    /**
     * Authenticate user
     */
    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->only('npk', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('website.kas');
        }

        return redirect()->back()->withErrors(['unauthenticate' => 'NPK atau password salah']);
    }

    /**
     * Logout
     */
    public function logout()
    {
        Auth::logout();

        return redirect()->route('website.auth.login');
    }

}
