<?php

namespace App\Exports;

use App\Models\StatementModel;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class StatementExport implements FromView
{
    protected $month;
    public function __construct($month=null){

        $this->month = $month;
    }

    /**
     * @return \Illuminate\Support\Collection
     */

    public function view(): View
    {
        $month = null;

        if (empty($this->month)){

            $days = date('t', time());

            $month = date('m');
        }else{
            $days = date('t', mktime(0, 0, 0, $this->month, 1, date('Y')));

            $month = $this->month;
        }

        $teachers = User::with('departament')->where("level_id", "=", 3)->get();

        return view('exports.statement', compact('days', 'teachers', 'month'));
    }
}
