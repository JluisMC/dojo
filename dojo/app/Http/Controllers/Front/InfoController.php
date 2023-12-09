<?php

namespace App\Http\Controllers\Front;

use App\Models\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class InfoController extends Controller
{
    public function index(){
        return view('front/index');
    }

    public function searchClient(Request $request){
        $rules = [
            'searchClient' => 'required',
            'searchClient' => 'min:5',
        ];

        $message = [
            'searchClient.required' => 'Por favor introduce tu codigo.',
            'searchClient.min' => 'Su codigo debe contener al menos 5 digitos.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails()):
            return back()->withErrors($validator)
                ->with('message', 'ALERTA !!!')
                ->with('typealert','danger');
        else:
            $type = "number_document";
            $searchClient = $request->get('searchClient');
            $person = Person::where('type',1)->search($type, $searchClient)->count();
            if($person == 0):
                return back()
                ->with('message', 'El codigo ingresado no existe.')
                ->with('typealert','danger');
            else:
                $person = Person::where('type',1)->search($type, $searchClient)->first();
                return view('front/show')->with('person', $person);
            endif;
        endif;
    }
}
