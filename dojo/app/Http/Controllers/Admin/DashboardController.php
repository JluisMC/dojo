<?php

namespace App\Http\Controllers\Admin;

use App\Models\Person;
use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('permissions');
        $this->middleware('isadmin');
    }

    public function index(){
        $registrados = Person::where('type',1)->count();
        $activos = Person::where('status',1)->where('type',1)->count();
        $boxeo = Client::where('status',1)->where('discipline','Boxeo')->count();
        $kick_boxing = Client::where('status',1)->where('discipline','Kick Boxing')->count();
        return view('admin/dashboard')
            ->with('registrados', $registrados)
            ->with('activos', $activos)
            ->with('boxeo', $boxeo)
            ->with('kick_boxing', $kick_boxing);
    }
}
