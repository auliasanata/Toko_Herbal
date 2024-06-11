<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/obat';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the post login redirect path based on user's role.
     *
     * @return string
     */
    protected function redirectTo()
    {
        if (auth()->check()) {
            if (auth()->user()->level === 'admin') {
                return '/obat';
            } elseif (auth()->user()->level === 'pembeli') {
                return '/home';
            }
        }

        return '/'; // Default redirect path
    }
}
