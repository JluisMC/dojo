<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Person;
use Validator;


class AddressController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function create($id){
        $p = Person::findOrFail($id);
        return view('admin/address/create')->with('p', $p);
    }

    public function store(Request $request){
        $rules = [
            'zone'             => 'required|max:50',
            'district'         => 'required|max:50',
            'street_avenue1'   => 'required|max:50',
            'street_avenue2'   => 'required|max:50',
            'description'      => 'required|max:200',
        ];

        $message = [
            'zone.required'             => 'El campo zona es requerido',
            'zone.max'                  => 'El campo zona puede contener maximo 50 caracteres',
            'district.required'         => 'El campo barrio es requerido',
            'district.max'              => 'El campo barrio puede contener maximo 50 caracteres',
            'street_avenue1.required'   => 'El campo calle/avenida 1 es requerido',
            'street_avenue1.max'        => 'El campo calle/avenida 1 puede tener maximo 50 caracteres',
            'street_avenue2.required'   => 'El campo calle/avenida 2 es requerido',
            'street_avenue2.max'        => 'El campo calle/avenida 2 puede tener maximo 50 caracteres',
            'description.required'      => 'El campo descripción es requerido',
            'description.max'           => 'El campo descripción puede contener maximo 200 caracteres',
        ];

        $validator = Validator::make($request->all(),$rules,$message);

        if($validator->fails()){
            return back()->withErrors($validator)
            ->with('message', 'Se ha producido un error.')
            ->with('typealert', 'danger')->withInput();
        }
        else{
            $address = new Address();
            $address -> zone                    = e($request->input('zone'));
            $address -> district                = e($request->input('district'));
            $address -> street_avenue1          = e($request->input('street_avenue1'));
            $address -> street_avenue2          = e($request->input('street_avenue2'));
            $address -> description             = e($request->input('description'));

            if($address -> save()){
                $person_id = $request->person_id;
                $p = Person::findOrFail($person_id);
                $p -> address_id = $address->id;
                $p -> save();
                return redirect()->route('userCreate', $person_id);
            };
        }
    }
}
