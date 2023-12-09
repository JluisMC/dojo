<?php

namespace App\Exports;

use App\Models\Person;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ClientExport implements FromView,ShouldAutoSize
{
    public function view(): View
    {
        return view('admin/client/export', [
            'people' => Person::where('type',1)->get()
        ]);
    }
}
