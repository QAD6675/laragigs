<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class usersController extends Controller
{
    public function login(){
        return view('auth.login',[

        ]);
    }
    public function register(){
        return view('auth.register',[

        ]);
    }

    public function signUp(Request $request){
        $formFields= $request->validate([
            "name" =>'required',
            'password'=>'required|confirmed|min:8',
            'email'=>['required','email',Rule::unique("users")],
        ]);

        $formFields['password']= bcrypt($formFields['password']);

        $user=User::create($formFields);
        auth()->login($user);

        Session::flash('success','welcome to laragigs');
        return redirect('/');
    }
    public function logOut(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success','you have been logged out');
    }
    public function signIn(Request $request){
        $formFields= $request->validate([
            'password'=>'required|min:8',
            'email'=>['required','email'],
        ]);

        $formFields['password'];

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();
            Session::flash('success','welcome to laragigs');
            return redirect('/');
        }
        return back()->withErrors(['email'=>'invalid credentials'])->onlyInput('email');
    }
}
