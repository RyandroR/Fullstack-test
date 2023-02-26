<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function login_page()
    {
        return view('login_page', [
            "title" => "Login N Parking"
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => ['required','max:20']
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/');
        };
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    public function register_page()
    {
        return view('register_page', [
            "title" => "Login N Parking"
        ]);
    }


    public function register(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => ['required','max:20']
        ]);

        $credentials['password'] = bcrypt( $credentials['password']);

        User::create($credentials);
        return redirect('/login');
    }
}
