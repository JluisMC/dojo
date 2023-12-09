<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Role;
use App\Models\User;
use Validator;
use Hash;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $users = User::where('status','1')->get();
        return view('admin/user/index')->with('users', $users);
    }

    public function create($id){
        $person = Person::findOrFail($id);
        $rol = Role::where('status', '1')->get();
        $data = ['person' => $person, 'rol' => $rol];
        return view('admin/user/create')->with($data);
    }

    public function store(Request $request){
        $rule = [
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:8|max:20',
            'cpassword' => 'required|min:8|max:20|same:password',
            'rol'       => 'required'
        ];

        $message = [
            'email.required'        => 'Su Correo electrónico es requerido.',
            'email.email'           => 'El formato de su correo electrónico es inválido.',
            'email.unique'          => 'Ya existe un usuario registrado con este correo electrónico.',
            'password.required'     => 'Por favor ingrese una contraseña.',
            'password.min'          => 'La contraseña debe tener al menos 8 caracteres.',
            'password.max'          => 'La contraseña debe tener un máximo de 20 caracteres',
            'cpassword.required'    => 'Es necesario confirmar la contraseña.',
            'cpassword.min'         => 'La confirmación de la contraseña debe tener al menos 8 caracteres.',
            'password.max'          => 'La confirmación de la contraseña debe tener un máximo de 20 caracteres',
            'cpassword.same'        => 'Las contraseñas ingresadas no coinciden.',
            'rol.required'          => 'Seleccione un rol para el usuario.'
        ];

        $validator = Validator::make($request->all(),$rule,$message);

        if($validator->fails()){
            return back()->withErrors($validator)
            ->with('message', 'Se ha producido un error.')
            ->with('typealert', 'danger')->withInput();
        }
        else{
            $user = new User();
            $user -> person_id  = e($request->input('person_id'));
            $user -> email      = e($request->input('email'));
            $user -> password   = Hash::make($request->input('password'));
            $user -> rol        = $request -> input('rol');
            $user -> save();

            $rol_id = $request->input('rol');
            $role = Role::findOrFail($rol_id);
            $user->role()->attach($role);

            return redirect()->route('userIndex')
            ->with('message', 'El usuario ha sido creado exitosamente.')
            ->with('typealert', 'success');
        }
    }

    public function edit($id){
        $user   = User::find($id);
        $rol    = Role::where('status','1')->where('id', '!=',$user->role_id)->get();
        dd($rol);
        $data   = ['user' => $user, 'rol' => $rol];
        return view('admin/user/edit')->with($data);
    }

    public function update(Request $request, $id){
        $rules = [
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8|max:20',
            'role_id'=>'required',
        ];

        $message = [
            'email.required'    => 'El campo "Usuario" es requerido.',
            'email.email'       => 'El formato de su correo electrónico es inválido.',
            'email.unique'      => 'Ya existe un usuario registrado con este correo electrónico.',
            'password.required' => 'El campo "Contraseña" es requerido.',
            'password.min'      => 'La contraseña debe tener al menos 8 caracteres.',
            'password.max'      => 'La contraseña debe tener un máximo de 20 caracteres',
            'role_id.required'  => 'El campo "Rol" es requerido.',
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
            else:
                return redirect()->back()
                    ->with('message', 'Error al modificar el usuario. Inténtalo de nuevo.')
                    ->with('typealert', 'danger');
            endif;
        endif;
    }
}
