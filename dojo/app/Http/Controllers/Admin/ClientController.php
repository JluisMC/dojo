<?php

namespace App\Http\Controllers\Admin;

use App\Models\Person;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Exports\ClientExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
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
                $people = Person::where('status',1)->where('type',1)->orderBy('id','DESC')
                ->search($type, $searchClient)->paginate(8);
            else:
                $people = Person::where('status',0)->where('type',1)->where('subscription',1)->orderBy('id','DESC')
                ->search($type, $searchClient)->paginate(8);
            endif;
        else:
            $people = Person::where('status',1)->where('type',1)->orderBy('id','DESC')
            ->paginate(8);
        endif;
        return view('admin/client/index')->with('people', $people);
    }

    public function export(){
        return Excel::download(new ClientExport, 'client.xlsx');
    }

    public function create($id){
        $person = Person::findOrFail($id);
        return view('admin/client/create')->with('person', $person);
    }

    public function store(Request $request){
        $rules = [
            'type_client' => 'required',
            'scholarship' => 'required',
            'discipline'=>'required',
            'start'=>'required',
            'finish'=>'required',
        ];

        $message = [
            'type_client.required' => 'El campo "Tipo cliente" es requerido.',
            'scholarship.required' => 'El campo "Becado" es requerido.',
            'discipline.required' => 'El campo "Apellido Paterno" es requerido.',
            'start.required' => 'El campo "Apellido Materno" es requerido.',
            'finish.required' => 'El campo "Fecha de Nacimiento" es requerido.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails()):
            return back()->withErrors($validator)
                ->with('message','Se ha producido un error !!!')
                ->with('typealert','danger');
        else:
            $client = new Client;
            $client -> person_id = e($request->input('person_id'));
            $client -> type_client = e($request->input('type_client'));
            $client -> scholarship = e($request->input('scholarship'));
            $client -> discipline = e($request->input('discipline'));
            $client -> start = e($request->input('start'));
            $client -> finish = e($request->input('finish'));

            // $date_today = date('Y-m-d');
            // if($client -> start <  $date_today):
            //     return back()
            //         ->with('message','La fecha de inicio: '.$client -> start.' es incorrecta !!!')
            //         ->with('typealert','danger');
            // else:
            //     if($client -> finish <  $date_today):
            //         return back()
            //             ->with('message','La fecha fin: '.$client -> finish.' es incorrecta !!!')
            //             ->with('typealert','danger');
            // else:
            //     endif;
            // endif;
            if($client->save()):
                return redirect()->route('person_change_subscription', $client -> person_id)
                ->with('message', 'Los datos se guardaron con éxito')
                ->with('typealert', 'success');
            endif;
        endif;
    }

    public function show($id){
        $client = Client::findOrFail($id);
        return view('admin/client/show')->with('client', $client);
    }

    public function edit($id){
        $client = Client::findOrFail($id);
        $person = Person::where('status',1)->where('type',1)->get();
        return view('admin/client/edit')
            ->with('client', $client)
            ->with('person', $person);
    }

    public function update(Request $request, $id){
        $rules = [
            'type_client' => 'required',
            'scholarship' => 'required',
            'discipline'=>'required',
            'start'=>'required',
            'finish'=>'required',
        ];

        $message = [
            'type_client.required' => 'El campo "Tipo cliente" es requerido.',
            'scholarship.required' => 'El campo "Becado" es requerido.',
            'discipline.required' => 'El campo "Apellido Paterno" es requerido.',
            'start.required' => 'El campo "Apellido Materno" es requerido.',
            'finish.required' => 'El campo "Fecha de Nacimiento" es requerido.',
        ];


        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails()):
            return back()->withErrors($validator)
                ->with('message','Se ha producido un error !!!')
                ->with('typealert','danger');
        else:
            $client = Client::find($id);
            $client->fill($request->all());

            // $date_today = date('Y-m-d');
            // if($client -> start <  $date_today):
            //     return back()
            //         ->with('message','La fecha de inicio: '.$client -> start.' es incorrecta !!!')
            //         ->with('typealert','danger');
            // else:
            //     if($client -> finish <  $date_today):
            //         return back()
            //             ->with('message','La fecha fin: '.$client -> finish.' es incorrecta !!!')
            //             ->with('typealert','danger');
            // else:
            //     endif;
            // endif;

            if($client->save()):
                return redirect()->route('client_edit', $client->id)
                ->with('message', 'La suscripción se modificó con éxito.')
                ->with('typealert', 'success');
            endif;
        endif;
    }

    public function destroy($id){
        $client = Client::find($id);
        $client->update(['status'=>'0']);
        $person = Person::find($client->person_id);
        $person->update(['status'=>'0']);
        $client->save();
        return redirect()->route('client_index', $client->id)
        ->with('message', 'El/La luchador(a) '.$client->person->name.' '. $client->person->last_name.' fue Desactivado(a) !!!')
        ->with('typealert', 'success');
    }

    public function restore($id){
        $client = Client::find($id);
        $client->update(['status'=>'1']);
        $person = Person::find($client->person_id);
        $person->update(['status'=>'1']);
        $client->save();
        return redirect()->route('client_edit', $client->id)
        ->with('message', 'El/La luchador(a) '.$client->person->name.' '. $client->person->last_name.' fue Activado(a) !!!')
        ->with('typealert', 'success');
    }
}
