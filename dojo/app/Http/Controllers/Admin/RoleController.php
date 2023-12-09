<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('permissions');
        $this->middleware('isadmin');
    }

    public function index(Request $request){
        $filter = $request->get('filter');
        $type = $request->get('type');
        $searchClient = $request->get('searchClient');
        if($filter || $type || $searchClient):
            if($filter == 0):
                $role = Role::where('status',1)->orderBy('id','DESC')
                ->search($type, $searchClient)->paginate(10);
            else:
                $role = Role::where('status',0)->orderBy('id','DESC')
                ->search($type, $searchClient)->paginate(10);
            endif;
        else:
            $role = Role::where('status',1)->orderBy('id','DESC')
            ->search($type, $searchClient)->paginate(10);
        endif;
        return view('admin/role/index')->with('role', $role);
    }

    public function create(){
        return view('admin/role/create');
    }

    public function store(Request $request){
        $rules = [
            'name'=>'required',
            'description'=>'required',
        ];

        $message = [
            'name.required' => 'El campo "Apellido Paterno" es requerido.',
            'description.required' => 'El campo "Apellido Materno" es requerido.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails()):
            return back()->withErrors($validator)
                ->with('message','Se ha producido un error !!!')
                ->with('typealert','danger');
        else:
            $role = new Role;
            $role -> name = e($request->input('name'));
            $role -> description = e($request->input('description'));

            if($role->save()):
                return redirect()->route('role_index')
                ->with('message', 'Los datos se guardaron con éxito')
                ->with('typealert', 'success');
            endif;
        endif;
    }

    public function edit($id){
        $role = Role::find($id);
        return view('admin/role/edit')->with('role', $role);
    }

    public function update(Request $request, $id){
        $rules = [
            'name'=>'required',
            'description'=>'required',
        ];

        $message = [
            'name.required' => 'El campo "Apellido Paterno" es requerido.',
            'description.required' => 'El campo "Apellido Materno" es requerido.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails()):
            return back()->withErrors($validator)
                ->with('message','Se ha producido un error !!!')
                ->with('typealert','danger');
        else:
            $role = Role::find($id);
            $role->fill($request->all());

            if($role->save()):
                return redirect()->route('role_index')
                    ->with('message', 'Los datos se modificaron con éxito.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function destroy($id){
        $role = Role::find($id);
        $role->update(['status'=>'0']);
        $role->save();
        return redirect()->route('role_index')
            ->with('message', 'El rol ha sido eliminado de la lista.')
            ->with('typealert', 'success');;
    }

    public function restore($id){
        $role = Role::find($id);
        $role->update(['status'=>'1']);
        $role->save();
        return redirect()->route('role_index')
            ->with('message', 'El rol ha sido restaurado.')
            ->with('typealert', 'success');;
    }
}
