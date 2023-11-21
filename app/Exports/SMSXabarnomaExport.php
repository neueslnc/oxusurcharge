<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use App\Models\PlayMobileModel;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class SMSXabarnomaExport implements FromView
{

    protected $month_id;
    public function __construct($month_id=null){

        $this->month_id = $month_id;
    }

    public function view(): View
    {

        if (empty($this->month_id)){
            $today = Carbon::now();
            $messages=PlayMobileModel::whereMonth('created_at', $today->month)->get();
            return view('exports.sms_messages',compact('messages'));
          
        }else{
           

            $month = $this->month_id;
            // $today = Carbon::now();
            $messages=PlayMobileModel::whereMonth('created_at', $month)->get();
            return view('exports.sms_messages',compact('messages'));
        }
       
           
           
    }


}
