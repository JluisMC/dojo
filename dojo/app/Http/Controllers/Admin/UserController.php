<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Role;
use App\Models\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('permissions');
        $this->middleware('isadmin');
    }

    public function index(Request $request){
        $filter = $request->get('filter');
        $type = $request->get('type');
        $searchUser = $request->get('searchUser');
        if($filter || $type || $searchUser):
            if($filter == 0):
                $people = Person::where('status',1)->where('type',2)->orderBy('id','DESC')
                ->search($type, $searchUser)->paginate(10);
            else:
                $people = Person::where('status',0)->where('type',2)->where('subscription',2)->orderBy('id','DESC')
                ->search($type, $searchUser)->paginate(10);
            endif;
        else:
            $people = Person::where('status',1)->where('type',2)->orderBy('id','DESC')
            ->search($type, $searchUser)->paginate(10);
        endif;
        return view('admin/user/index')->with('people', $people);
    }

    public function create($id){
        $person = Person::findOrFail($id);
        $role = Role::where('status',1)->get();
        return view('admin/user/create')
            ->with('person', $person)
            ->with('role', $role);
    }

    public function store(Request $request){
        $rules = [
            'person_id' => 'required|unique:App\User,person_id',
            'email' => 'required|email|unique:App\User,email',
            'role_id' => 'required',
            'password' => 'required|min:8|',
            'cpassword' => 'required|min:8|same:password',
        ];

        $message = [
            'person_id.unique' => 'La Persona ya tiene un Usuario creado',
            'email.required' => 'El campo de correo electrónico es requerido.',
            'email.email' => 'El formato de su correo electrónico es inválido.',
            'email.unique' => 'Ya existe un usuario registrado con este correo electrónico.',
            'role_id.required' => 'El campo de rol es requerido.',
            'password.required' => 'El campo contraseña es requerido.',
            'password.min' => 'La contraseña debe contener al menos 8 caracteres.',
            'cpassword.required' => 'El campo confirmar contraseña es requerido.',
            'cpassword.min' => 'La confirmacion de contraseña debe contener al menos 8 caracteres.',
            'cpassword.same' => 'Las contraseñas no coinciden',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails()):
            return back()->withErrors($validator)
                ->with('message','Se ha producido un error !!!')
                ->with('typealert','danger');
        else:
            $user = new User;
            $user -> person_id = e($request->input('person_id'));
            $user -> email = e($request->input('email'));
            $user -> role_id = e($request->input('role_id'));
            $user -> password = Hash::make($request->input('password'));
            if($user->save()):
                return redirect()->route('person_user_change_subscription', $user->person_id)
                    ->with('message', 'Se ha registrado con éxito, ahora puede asignarle los permisos.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function show($id){
        $user = User::find($id);
        return view('admin/user/show')->with('user', $user);
    }

    public function edit($id){
        $user = User::findOrFail($id);
        $role = Role::where('status',1)->where('id', '!=',$user->role_id)->get();
        return view('admin/user/edit')
            ->with('user', $user)
            ->with('role', $role);
    }

    public function update(Request $request, $id){
        $rules = [
            'email'=>'required',
            'password'=>'required',
            'role_id'=>'required',
        ];

        $message = [
            'email.required' => 'El campo "Usuario" es requerido.',
            'password.required' => 'El campo "Contraseña" es requerido.',
            'role_id.required' => 'El campo "Rol" es requerido.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails()):
            return back()->withErrors($validator)
                ->with('message','Se ha producido un error !!!')
                ->with('typealert','danger');
        else:
            $user = User::find($id);
            $user->fill($request->all());
            if($user->save()):
                return redirect()->route('user_permissions', $user->id)
                ->with('message', 'El usuario se modificó, proceda asignar los permisos.')
                ->with('typealert', 'success');
            endif;
        endif;
    }

    public function resetPassword(Request $request,$id){
        $rules = [
            'password'=>'required',
            'cpassword' => 'required|min:8|same:password',
            'role_id'=>'required',
        ];

        $message = [
            'password.required' => 'El campo "Contraseña" es requerido.',
            'cpassword.required' => 'El campo confirmar contraseña es requerido.',
            'cpassword.min' => 'La confirmacion de contraseña debe contener al menos 8 caracteres.',
            'cpassword.same' => 'Las contraseñas no coinciden',
            'role_id.required' => 'El campo "Rol" es requerido.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails()):
            return back()->withErrors($validator)
                ->with('message','Se ha producido un error !!!')
                ->with('typealert','danger');
        else:
            $user = User::find($id);
            $user->fill($request->all());
            $user -> password = Hash::make($request->input('password'));
            if($user->save()):
                return redirect()->route('user_edit', $user->id)
                ->with('message', 'La contraseña se reseteo con éxito.')
                ->with('typealert', 'success');
            endif;
        endif;
    }

    public function destroy($id){
        $user = User::find($id);
        $user->update(['status'=>'0']);
        $person = Person::find($user->person_id);
        $person->update(['status'=>'0']);
            $user->save();
            return redirect()->route('user_index', $user->id)
            ->with('message', 'El usuario fue Desactivado !!!')
            ->with('typealert', 'success');
    }

    public function restore($id){
        $user = User::find($id);
        $user->update(['status'=>'1']);
        $person = Person::find($user->person_id);
        $person->update(['status'=>'1']);
            $user->save();
            return redirect()->route('user_edit', $user->id)
            ->with('message', 'El usuario fue Activado !!!')
            ->with('typealert', 'success');
    }

    public function permissions($id){
        $person = Person::findOrFail($id);
        return view('admin/user/user_permissions')->with('person',$person);
    }

    public function permissionsSave(Request $request, $id){
        $user = User::findOrFail($id);
        $user_permissions_save = verify_permission_value($request->input('user_permissions'));
        $role_store = verify_permission_value($request->input('role_create'));
        $role_update = verify_permission_value($request->input('role_edit'));
        $user_store = verify_permission_value($request->input('user_create'));
        $user_update = verify_permission_value($request->input('user_edit'));
        $user_reset_password = verify_permission_value($request->input('user_edit'));
        $person_user_create = verify_permission_value($request->input('user_create'));
        $person_user_change_subscription = verify_permission_value($request->input('user_create'));
        $person_user_store = verify_permission_value($request->input('user_create'));
        $person_user_update= verify_permission_value($request->input('user_edit'));
        $person_change_subscription= verify_permission_value($request->input('client_create'));
        $client_store = verify_permission_value($request->input('client_create'));
        $client_update = verify_permission_value($request->input('client_edit'));
        $person_client_create = verify_permission_value($request->input('client_create'));
        $person_client_store = verify_permission_value($request->input('client_create'));
        $person_client_update = verify_permission_value($request->input('client_edit'));
        $permissions = [
            'user_permissions_save' => $user_permissions_save,
            'dashboard_index' => $request->input('dashboard_index'),
            'dashboard_small_stats' => $request->input('dashboard_small_stats'),
            'user_permissions' => $request->input('user_permissions'),
            'role_index' => $request->input('role_index'),
            'role_create' => $request->input('role_create'),
            'role_store' => $role_store,
            'role_edit' => $request->input('role_edit'),
            'role_update' => $role_update,
            'role_destroy' => $request->input('role_destroy'),
            'user_index' => $request->input('user_index'),
            'user_create' => $request->input('user_create'),
            'person_user_change_subscription' => $person_user_change_subscription,
            'user_store' => $user_store,
            'user_destroy' => $request->input('user_destroy'),
            'person_user_create' => $person_user_create,
            'person_user_store' => $person_user_store,
            'user_show' => $request->input('user_show'),
            'user_edit' => $request->input('user_edit'),
            'user_reset_password' => $user_reset_password,
            'person_user_update' => $person_user_update,
            'user_update' => $user_update,
            'client_index' => $request->input('client_index'),
            'person_change_subscription' => $person_change_subscription,
            'client_create' => $request->input('client_create'),
            'client_store' => $client_store,
            'person_client_create' => $person_client_create,
            'person_client_store' => $person_client_store,
            'client_show' => $request->input('client_show'),
            'client_edit' => $request->input('client_edit'),
            'client_update' => $client_update,
            'person_client_update' => $person_client_update,
            'client_export' => $request->input('client_export'),
            'client_destroy' => $request->input('client_destroy'),
        ];
        $permissions = json_encode($permissions);
        $user->permissions = $permissions;
        if($user->save()):
            return back()
                ->with('message','Los permisos del usuario: '."$user->email".' se actualizaron con éxito.')
                ->with('typealert','success');
        endif;
    }
}
