<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(LoginRequest $request)
    {
        
    }
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(LoginRequest $request)
    {
        $input = $request->validated();

        if (Auth::attempt($input)) {
            $request->session()->regenerate();

            if(auth()->user()->is_admin == true) {
                return redirect('/admin/dashboard');
               }

               else {

                $request->session()->invalidate();
                
                $request->session()->regenerateToken();
                return redirect('/')->with(
                    'deny', 'You cant access this page');
               }
        }

        return back()->withErrors([
            'status' => 'Please check your login information.',
        ])->withInput();
    }
    
    /**
    * Log the user out of the application.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return back();
    }
}
