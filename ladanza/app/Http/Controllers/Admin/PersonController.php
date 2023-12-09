<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Person;
use Validator;
use Config;
use Image;
use Str;


class PersonController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function createPersonUser(){
        return view('admin/person/createPersonUser');
    }

    public function storePersonUser(Request $request){
        $rules = [
            'name'              => 'required|max:50',
            'last_name'         => 'required|max:50',
            'number_document'   => 'required|min:5|max:11',
            'extension'         => 'required',
            'phone'             => 'required|max:8|min:8',
        ];

        $message = [
            'name.required'             => 'El campo nombre es requerido',
            'name.max'                  => 'El nombre puede contener maximo 50 caracteres',
            'last_name.required'        => 'El campo apellido es requerido',
            'last_name.max'             => 'El apellido puede contener maximo 50 caracteres',
            'number_document.required'  => 'El campo n° documento es requerido',
            'number_document.min'       => 'El campo n° documento debe tener minimo 5 digitos',
            'number_document.max'       => 'El campo n° documento puede tener maximo 11 digitos',
            'extension.required'        => 'Seleccione una extension',
            'phone.required'            => 'El campo telefono es requerido',
            'phone.max'                 => 'El campo telefono debe tener 8 digitos',
            'phone.min'                 => 'El campo telefono debe tener 8 digitos',
        ];

        $validator = Validator::make($request->all(),$rules,$message);

        if($validator->fails()){
            return back()->withErrors($validator)
            ->with('message', 'Se ha producido un error.')
            ->with('typealert', 'danger')->withInput();
        }
        else{
            $person = Person::where('number_document' , $request->input('number_document'))
                ->where('type_person' , $request->input('type_person'))->count();
            if($person == 1){
                return back()
                ->with('message','Ya existe un registro con esa Cédula de identidad.')
                ->with('typealert','danger')->withInput();
            }
            else{
                $path = '/'.date('y-m-d');
                $fileExt = trim($request->file('avatar')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('avatar')->getClientOriginalName()));
                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $final_file = $upload_path.'/'.$path.'/'.$filename;

                $p = new Person();
                $p -> name              = e($request -> input('name'));
                $p -> type_person       = e($request -> input('type_person'));
                $p -> last_name         = e($request -> input('last_name'));
                $p -> number_document   = e($request -> input('number_document'));
                $p -> extension         = e($request -> input('extension'));
                $p -> phone             = e($request -> input('phone'));

                $p -> file_image = date('y-m-d');
                $p -> avatar = $filename;

                if($p -> save()){
                    if($request->hasFile(('avatar'))){
                        $fl = $request->avatar->storeAs($path, $filename, 'uploads');
                        $img = Image::make($final_file);
                        $img->fit(256, 256, function($constraint){
                            $constraint->upsize();
                        });
                        $img->save($upload_path.'/'.$path.'/t_'.$filename);
                    }
                    return redirect()->route('addressCreate', $p->id);
                }
            }
        }
    }

    public function createPersonClient(){
        return view('admin/person/createPersonClient');
    }

    public function storePersonClient(Request $request){
        $rules = [
            'name'              => 'required|max:50',
            'last_name'         => 'required|max:50',
            'number_document'   => 'required|min:5|max:11',
            'extension'         => 'required',
            'phone'             => 'required|max:8|min:8',
        ];

        $message = [
            'name.required'             => 'El campo nombre es requerido',
            'name.max'                  => 'El nombre puede contener maximo 50 caracteres',
            'last_name.required'        => 'El campo apellido es requerido',
            'last_name.max'             => 'El apellido puede contener maximo 50 caracteres',
            'number_document.required'  => 'El campo n° documento es requerido',
            'number_document.min'       => 'El campo n° documento debe tener minimo 5 digitos',
            'number_document.max'       => 'El campo n° documento puede tener maximo 11 digitos',
            'extension.required'        => 'Seleccione una extension',
            'phone.required'            => 'El campo telefono es requerido',
            'phone.max'                 => 'El campo telefono debe tener 8 digitos',
            'phone.min'                 => 'El campo telefono debe tener 8 digitos',
        ];

        $validator = Validator::make($request->all(),$rules,$message);

        if($validator->fails()){
            return back()->withErrors($validator)
            ->with('message', 'Se ha producido un error.')
            ->with('typealert', 'danger')->withInput();
        }
        else{
            $person = Person::where('number_document' , $request->input('number_document'))
                ->where('type_person' , $request->input('type_person'))->count();
            if($person == 1){
                return back()
                ->with('message','Ya existe un registro con esa Cédula de identidad.')
                ->with('typealert','danger');
            }
            else{
                $path = '/'.date('y-m-d');
                $fileExt = trim($request->file('avatar')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('avatar')->getClientOriginalName()));
                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $final_file = $upload_path.'/'.$path.'/'.$filename;

                $p = new Person($request->all());
                $p -> file_image = date('y-m-d');
                $p -> avatar = $filename;

                if($p -> save()){
                    if($request->hasFile(('avatar'))){
                        $fl = $request->avatar->storeAs($path, $filename, 'uploads');
                        $img = Image::make($final_file);
                        $img->fit(256, 256, function($constraint){
                            $constraint->upsize();
                        });
                        $img->save($upload_path.'/'.$path.'/t_'.$filename);
                    }
                    return back()
                    ->with('message','Cliente creado.')
                    ->with('typealert','success');
                }
            }
        }
    }
}
