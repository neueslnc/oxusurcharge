<?php

namespace App\Exports;

use App\Models\Criteria;
use App\Models\Departament;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class UstamaExport implements FromView
{
    public function view(): View
    {
        $teachers=User::where("level_id", "=", 3)->get();
        $criterias=Criteria::all();
        return view('exports.teacher',compact('teachers','criterias'));
           
           
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return User::all();
    // }
}
