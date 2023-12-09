<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Validator;

class RoleController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $roles = Role::where('status','1')->get();
        return view('admin/roles/index')->with('roles', $roles);
    }

    public function create(){
        return view('admin/roles/create');
    }

    public function store(Request $request){
        $rules = [
            'name'          => 'required|max:50',
            'description'   => 'required|max:200'
        ];
        $message = [
            'name.required' => 'El campo nombre es requerido.',
            'name.max' => 'El nombre debe contener maximo 50 caracteres.',
            'description.required' => 'El campo descripción es requerido.',
            'description.max' => 'La descripción debe contener maximo 200 caracteres.',
        ];

        $validator = Validator::make($request->all(),$rules,$message);

        if($validator->fails()){
            return back()->withErrors($validator)
            ->with('message', 'Se ha producido un error.')
            ->with('typealert', 'danger');
        }
        else{
            $rol = new Role();
            $rol -> name = e($request->input('name'));
            $rol -> description = e($request->input('description'));

            if($rol -> save()){
                return redirect()->route('permissionsEdit', $rol->id)
                ->with('message', 'El rol ha sido creado exitosamente.')
                ->with('typealert', 'success');
            }
            else{
                return redirect()->route('permissionsEdit', $rol->id)
                ->with('message', 'Se ha producido un error.')
                ->with('typealert', 'danger');
            }
        }
    }

    public function edit($id){
        $rol = Role::findOrFail($id);
        return view('admin/roles/edit')->with('rol', $rol);
    }

    public function update(Request $request, $id){
        $rules = [
            'name'          => 'required|max:50',
            'description'   => 'required|max:200'
        ];
        $message = [
            'name.required' => 'El campo nombre es requerido.',
            'name.max' => 'El nombre debe contener maximo 50 caracteres.',
            'description.required' => 'El campo descripción es requerido.',
            'description.max' => 'La descripción debe contener maximo 200 caracteres.',
        ];

        $validator = Validator::make($request->all(),$rules,$message);

        if($validator->fails()){
            return back()->withErrors($validator)
            ->with('message','Se ha producido un error.')
            ->with('typealert', 'danger');
        }
        else{
            $rol = Role::findOrFail($id);
            $rol->fill($request->all());
            if($rol->save()){
                return redirect()->route('rolEdit', $rol->id)
                ->with('message', 'El rol ha sido actualizado exitosamente.')
                ->with('typealert', 'success');
            }
            else{
                return redirect()->route('rolEdit', $rol->id)
                ->with('message', 'Se ha producido un error.')
                ->with('typealert', 'danger');
            }
        }
    }

    public function editPermissions($id){
        $rol = Role::findOrFail($id);
        return view('admin/roles/roles_permissions')->with('rol', $rol);
    }

    public function updatePermissions(Request $request, $id){
        $rol = Role::findOrFail($id);
        $permissions = [
            'dashboard'         => $request->input('dashboard'),

            'userIndex'         => $request->input('userIndex'),
            'userCreate'        => $request->input('userCreate'),
            'userEdit'          => $request->input('userEdit'),

            'rolesIndex'        => $request->input('rolesIndex'),
            'rolesCreate'       => $request->input('rolesCreate'),
            'permissionsEdit'   => $request->input('permissionsEdit'),
        ];
        
        $permissions = json_encode($permissions);
    
        $rol -> permissions = $permissions;
        $rol -> save();
        return back()->with('message', 'Permisos actualizados exitosamente.')->with('typealert', 'success');
    }
}
