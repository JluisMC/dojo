<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Client;
use App\Models\Person;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('permissions');
        $this->middleware('isadmin');
    }

    public function index(Request $request){
        $client = Client::all();
        $filter = $request->get('filter');
        $type = $request->get('type');
        $searchPerson = $request->get('searchPerson');
        if($filter || $type || $searchPerson):
            if($filter == 0):
                $people = Person::where('status',1)->where('type',1)->orderBy('id','DESC')
                ->search($type, $searchPerson)->paginate(7);
            else:
                $people = Person::where('status',0)->where('type',1)->orderBy('id','DESC')
                ->search($type, $searchPerson)->paginate(7);
            endif;
        else:
            $people = Person::where('status',1)->where('type',1)->orderBy('id','DESC')
            ->paginate(7);
        endif;
        return view('admin/person/index')->with('people', $people)->with('client', $client);
    }

    public function createPersonUser(){
        return view('admin/person/createPersonUser');
    }

    public function storePersonUser(Request $request){
        $rules = [
            'name'=>'required',
            'last_name'=>'required',
            'number_document' => 'required|min:5',
            'phone' => 'required',
        ];

        $message = [
            'name.required' => 'El campo "Nombre" es requerido.',
            'last_name.required' => 'El campo "Apellido Paterno" es requerido.',
            'number_document.required' => 'El campo "Cédula de Identidad" es requerido.',
            'number_document.min' => 'La cédula de identidad debe contener al menos 5 caracteres.',
            'phone.required' => 'El campo "Teléfono" es requerido',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails()):
            return back()->withErrors($validator)
                ->with('message','Se ha producido un error !!!')
                ->with('typealert','danger');
        else:
            $customers = Person::where('number_document' , $request->input('number_document'))
                ->where('type' , $request->input('type'))->count();
            if($customers == 1):
                return back()
                ->with('message','Ya existe un registro con esa Cédula de identidad.')
                ->with('typealert','danger');
            else:
                $path = '/'.date('y-m-d');
                $fileExt = trim($request->file('avatar')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('avatar')->getClientOriginalName()));
                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $final_file = $upload_path.'/'.$path.'/'.$filename;

                $person = new Person;
                $person -> name = e($request->input('name'));
                $person -> last_name = e($request->input('last_name'));
                $person -> number_document = e($request->input('number_document'));
                $person -> fileImage = date('y-m-d');
                $person -> avatar = $filename;
                $person -> phone = e($request->input('phone'));
                $person -> type = e($request->input('type'));
                if($person->save()):
                    if($request->hasFile(('avatar'))):
                        $fl = $request->avatar->storeAs($path, $filename, 'uploads');
                        $img = Image::make($final_file);
                        $img->fit(256, 256, function($constraint){
                            $constraint->upsize();
                        });
                        $img->save($upload_path.'/'.$path.'/t_'.$filename);
                    endif;
                    return redirect()->route('user_create',$person->id);
                endif;
            endif;
        endif;
    }

    public function createPersonClient(){
        return view('admin/person/createPersonClient');
    }

    public function storePersonClient(Request $request){
        $rules = [
            'name'=>'required',
            'last_name'=>'required',
            'number_document' => 'required|min:5',
            'phone' => 'required',
        ];

        $message = [
            'name.required' => 'El campo "Nombre" es requerido.',
            'last_name.required' => 'El campo "Apellido Paterno" es requerido.',
            'number_document.required' => 'El campo "Cédula de Identidad" es requerido.',
            'number_document.min' => 'La cédula de identidad debe contener al menos 5 caracteres.',
            'phone.required' => 'El campo "Teléfono" es requerido',
        ];
        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails()):
            return back()->withErrors($validator)
                ->with('message','Se ha producido un error !!!')
                ->with('typealert','danger');
        else:
            $customers = Person::where('number_document' , $request->input('number_document'))
                ->where('type' , $request->input('type'))->count();
            if($customers == 1):
                return back()
                ->with('message','Ya existe un registro con esa Cédula de identidad.')
                ->with('typealert','danger');
            else:
                $path = '/'.date('y-m-d');
                $fileExt = trim($request->file('avatar')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('avatar')->getClientOriginalName()));
                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $final_file = $upload_path.'/'.$path.'/'.$filename;

                $person = new Person;
                $person -> name = e($request->input('name'));
                $person -> last_name = e($request->input('last_name'));
                $person -> number_document = e($request->input('number_document'));
                $person -> fileImage = date('y-m-d');
                $person -> avatar = $filename;
                $person -> phone = e($request->input('phone'));
                $person -> type = e($request->input('type'));

                if($person->save()):
                    if($request->hasFile(('avatar'))):
                        $fl = $request->avatar->storeAs($path, $filename, 'uploads');
                        $img = Image::make($final_file);
                        $img->fit(256, 256, function($constraint){
                            $constraint->upsize();
                        });
                        $img->save($upload_path.'/'.$path.'/t_'.$filename);
                    endif;
                    return redirect()->route('client_create', $person->id);
                endif;
            endif;
        endif;
    }

    public function updatePersonClient(Request $request, $id){
        $rules = [
            'name'=>'required',
            'last_name'=>'required',
            'number_document' => 'required|min:5',
            'phone' => 'required',
        ];

        $message = [
            'name.required' => 'El campo "Nombre" es requerido.',
            'last_name.required' => 'El campo "Apellido Paterno" es requerido.',
            'number_document.required' => 'El campo "Cédula de Identidad" es requerido.',
            'number_document.min' => 'La cédula de identidad debe contener al menos 5 caracteres.',
            'phone.required' => 'El campo "Teléfono" es requerido',
        ];
        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails()):
            return back()->withErrors($validator)
                ->with('message','Se ha producido un error !!!')
                ->with('typealert','danger');
        else:
            $person = Person::find($id);
            $ipp = $person -> fileImage;
            $ip = $person -> avatar;
            $person->fill($request->all());

            if($request->hasFile(('avatar'))):
                $path = '/'.date('y-m-d');
                $fileExt = trim($request->file('avatar')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('avatar')->getClientOriginalName()));
                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $final_file = $upload_path.'/'.$path.'/'.$filename;
                $person -> fileImage = date('y-m-d');
                $person -> avatar = $filename;
            endif;
            if($person->save()):
                if($request->hasFile('avatar')):
                    $fl = $request->avatar->storeAs($path, $filename, 'uploads');
                    $img = Image::make($final_file);
                    $img->fit(256, 256, function($constraint){
                        $constraint->upsize();
                    });
                    $img->save($upload_path.'/'.$path.'/t_'.$filename);
                    if($ipp || $ip != Null):
                        unlink($upload_path.'/'.$ipp.'/'.$ip);
                        unlink($upload_path.'/'.$ipp.'/t_'.$ip);
                    endif;
                endif;
                return redirect()->route('client_edit', $person->client->id)
                ->with('message', 'Los datos de: '."$person->name $person->last_name.".' Se modificó con éxito')
                ->with('typealert', 'success');
            endif;
        endif;
    }

    public function updatePersonUser(Request $request, $id){
        $rules = [
            'name'=>'required',
            'last_name'=>'required',
            'number_document' => 'required|min:5',
            'phone' => 'required',
        ];

        $message = [
            'name.required' => 'El campo "Nombre" es requerido.',
            'last_name.required' => 'El campo "Apellido Paterno" es requerido.',
            'number_document.required' => 'El campo "Cédula de Identidad" es requerido.',
            'number_document.min' => 'La cédula de identidad debe contener al menos 5 caracteres.',
            'phone.required' => 'El campo "Teléfono" es requerido',
        ];
        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails()):
            return back()->withErrors($validator)
                ->with('message','Se ha producido un error !!!')
                ->with('typealert','danger');
        else:
            $person = Person::find($id);
            $ipp = $person -> fileImage;
            $ip = $person -> avatar;
            $person->fill($request->all());

            if($request->hasFile('avatar')):
                $path = '/'.date('y-m-d');
                $fileExt = trim($request->file('avatar')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('avatar')->getClientOriginalName()));
                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $final_file = $upload_path.'/'.$path.'/'.$filename;
                $person -> fileImage = date('y-m-d');
                $person -> avatar = $filename;
            endif;
            if($person->save()):
                if($request->hasFile(('avatar'))):
                    $fl = $request->avatar->storeAs($path, $filename, 'uploads');
                    $img = Image::make($final_file);
                    $img->fit(256, 256, function($constraint){
                        $constraint->upsize();
                    });
                    $img->save($upload_path.'/'.$path.'/t_'.$filename);
                    if($ipp || $ip != Null):
                        unlink($upload_path.'/'.$ipp.'/'.$ip);
                        unlink($upload_path.'/'.$ipp.'/t_'.$ip);
                    endif;
                endif;
                return redirect()->route('user_edit', $person->user->id)
                ->with('message', 'Los datos de: '."$person->name $person->last_name.".' Se modificó con éxito')
                ->with('typealert', 'success');
            endif;
        endif;
    }

    public function change_subscription($id){
        $person = Person::find($id);
        $person->update(['subscription'=>'1']);
        $person->save();
        return redirect()->route('client_index');
    }

    public function change_user_subscription($id){
        $person = Person::find($id);
        $person->update(['subscription'=>'2']);
        $person->save();
        return redirect()->route('user_permissions', $person->id);
    }
}
