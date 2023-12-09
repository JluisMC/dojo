<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;

class LoginController extends Controller
{
    public function create(){
        return view('login/create');
    }
    
    public function store(Request $request){
        $rules = [
            'email' =>  'required',
            'password'  =>  'required'
        ];

        $message = [
            'email.required'    =>  'Ingrese su correo electrónico.',
            'password.required' =>  'Ingrese su contraseña'
        ];

        $validator = Validator::make($request->all(),$rules,$message);

        if($validator->fails()){
            return back()->withErrors($validator)
            ->with('message', 'Se ha producido un error.')
            ->with('typealert', 'danger');
        }

        if(Auth::attempt(
            ['email' => $request->input('email'),
            'password' => $request->input('password')], true))
            {
                return redirect()->route('dashboard');
            }
        else{
            return back()
            ->with('message','Correo electrónico o Contraseña errónea !!!')
            ->with('typealert','danger')->withInput();
        }
    }

    public function destroy(){
        Auth::logout();
        return redirect()->route('loginCreate');
    }   
}
