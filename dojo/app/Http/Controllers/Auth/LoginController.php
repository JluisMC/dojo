<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['destroy']);
    }

    public function create(){
        return view('connect/login/create');
    }

    public function store(Request $request){
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8|'
        ];

        $message = [
            'email.required' => 'El campo de correo electrónico es requerido.',
            'email.email' => 'El formato de su correo electrónico es inválido.',
            'password.required' => 'El campo contraseña es requerido.',
            'password.min' => 'La contraseña debe contener al menos 8 caracteres.'
        ];

        $validator = Validator::make($request->all(), $rules, $message);
        if($validator->fails()):
            return back()->withErrors($validator)
                ->with('message','Se ha producido un error !!!')
                ->with('typealert','danger');
        else:
            if(Auth::attempt(
                ['email' => $request->input('email'),
                'password' => $request->input('password')], true)):
                if(Auth::user()->status == 0):
                    return redirect()->route('login_destroy', Auth::user()->status);
                else:
                    return redirect()->route('dashboard_index');
                endif;
            else:
                return back()
                ->with('message','Correo electrónico o Contraseña errónea !!!')
                ->with('typealert','danger');
            endif;
        endif;
    }

    public function destroy($id){
        $status = $id;
        Auth::logout();
        if($status == 0):
            return redirect()->route('login')
                ->with('message', 'Su usuario se encuentra suspendido')
                ->with('typealert', 'danger');
        else:
            return redirect()->route('login');
        endif;
    }
}
