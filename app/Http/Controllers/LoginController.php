<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('login');
    }

    public function proseslogin(Request $request){
        
      if(Auth::attempt($request->only('email', 'password'))){

        return redirect('/');

      }else{

      return redirect('/login')->with('Login', 'Login Gagal');;

      }

    }

    public function logout(){
        
   Auth::logout();
   return redirect('/login')->with('Logout', 'Logout Berhasil');

    }


}
