<?php

namespace App\Http\Controllers\SuperAdmin\SMS;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Departament;
use Illuminate\Http\Request;
use App\Models\PlayMobileModel;
use Illuminate\Support\Facades\DB;
use App\Exports\SMSXabarnomaExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\PlayMobile\PlayMobileRequest;

class PlayMobileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $today = Carbon::now();
       
        $messages=PlayMobileModel::whereMonth('created_at', $today->month)->orderBy('created_at', 'DESC')->get();
        // dd( $messages);

        // {
        //     "rules": {
        //         "checkbox": {
        //             "limit": 3,
        //             "all_checkbox" : false,
        //             "included": true
        //         }
        //     }
        // }

        // {"rules":{"checkbox":{"included":true,"limit":3}}}

        // $messages=PlayMobileModel::with(['user_sender', 'user_taker'])->where("type_sms",'=',2)->whereHas('user_department_many', function ($query)use($id) {
        //     return $query->where('departament_id', '=',   $id);
        // })->get();
        // $messages_for=PlayMobileModel::get();
        // $messages_id=array();
        // foreach ($messages_for->unique('taker_id') as $key => $message) {
        //     $messages_id[]=$message->taker_id;
        // }
        // $teachers_for_taker_id=User::whereIn('id',$messages_id)->get();

        $teachers_for_taker_id=User::whereIn('id',  PlayMobileModel::distinct()->whereMonth('created_at', $today->month)->get(['taker_id']))->orderBy('full_name', 'ASC')->get();
      
        // dd($teachers_for_taker_id);
        $teachers=User::where('level_id','=',3)->orderBy('full_name', 'ASC')->get();
        $departaments=Departament::get();
        // dd($messages);
        return view('super.sms.index',compact('messages','id','teachers','departaments','teachers_for_taker_id'));
    }

    public function getAjaxData(Request $request)
    {
        $today = Carbon::now();
       
        $messages=PlayMobileModel::query()
            ->with(['user_sender','user_taker'])
            ->whereIn('taker_id', $request->user_id)
            ->where('sender_id','=',Auth::user()->id)
            ->whereMonth('created_at', $today->month)
            ->get();

        return response()
            ->json([
                'status' => true,
                'data' => $messages
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $users=User::where('level_id','=',2)
            ->Orwhere('level_id','=',3)
            ->orderBy('full_name','asc')
            ->get();
        return view('super.sms.create',compact('users','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function getHeader():array
    {
        $login=config('app.sms_login');
        $password=config('app.sms_password');
        return [
            'Authorization' => 'Basic '.base64_encode("$login:$password"),
            'Content-Type' => 'application/json'
        ];
    }
    public function store(PlayMobileRequest $request,$id)
    {
       $number_phone=User::find($request->user)->number_phone;
       if ( $number_phone==null) {

        session()->flash('warning',"Nomer Telefon topilmadi");
        return redirect()->route('superadmin.sms_message.index',['admin_id'=>$id]);
       }
        $statement = DB::select("SHOW TABLE STATUS LIKE 'play_mobile'");
        $nextId = $statement[0]->Auto_increment;


        $message_id="OXU"."000"."$nextId";


        $login=config('app.sms_login');
        $password=config('app.sms_password');
        $response = Http::withHeaders([
            'Authorization' => 'Basic '.base64_encode("$login:$password"),
            'Content-Type' => 'application/json'
        ])->post('https://send.smsxabar.uz/broker-api/send', [

              'messages'=>[
                "recipient"=>"$number_phone",
                "message-id"=>"$message_id",
              ],
              "sms"=>[
                "originator"=> "3700",
              "content"=>[
               "text"=> "$request->message_body"
              ]
              ]

        ]);

        if ($response->getStatusCode() >= 300) {
            PlayMobileModel::create(['sender_id'=>$id,'sms_body'=>$request->message_body,'taker_id'=>$request->user,'message_id'=>$message_id,'status_sms'=>0,'type_sms'=>$request->sms_filter]);
            session()->flash('warning',"Xabar jo'natilmadi");
            return redirect()->route('superadmin.sms_message.index',['admin_id'=>$id]);
         } else {
            PlayMobileModel::create(['sender_id'=>$id,'sms_body'=>$request->message_body,'taker_id'=>$request->user,'message_id'=>$message_id,'status_sms'=>1,'type_sms'=>$request->sms_filter]);
                session()->flash('success',"Xabar jo'natildi");
                return redirect()->route('superadmin.sms_message.index',['admin_id'=>$id]);
         }
        }

        // $client = new Client();

        // $body = '{
        //     "messages": [
        //       {
        //         "recipient": "' . 998998917785 . '",
        //         "message-id": "oxu0001' . 1 . '",
        //         "sms": {
        //           "originator": "3700",
        //           "content": {
        //             "text": "Security code:' . 777 . '"
        //           }
        //         }
        //       }
        //     ]
        // }';
        // try {
        //     $request = new GuzlRequest('POST', 'https://send.smsxabar.uz/broker-api/send', $this->getHeader(), $body);
        //     $client->sendAsync($request)->wait();

        //     return true;
        // } catch (\Throwable $th) {
        //     return false;
        // }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function get_sms_filter(Request $request)
    {


       if ($request->input('sms_filter')<3) {
        $messages=PlayMobileModel::with(['user_sender', 'user_taker'])->whereMonth('created_at',$request->input('month_filter'))->where('type_sms','=', $request->input('sms_filter'))->get();
       } else {
        $messages=PlayMobileModel::with(['user_sender', 'user_taker'])->whereMonth('created_at',$request->input('month_filter'))->get();
       }


        return response()->json([
            'messages' => $messages,

        ]);
    }

    

    public function get_sms_filter_by_departaments(Request $request)
    {

        // $messages=PlayMobileModel::where("type_sms",'=',2)->whereHas('user_department_many', function ($query) {
        // return $query->where('departament_id', '=', 2);
        // })->get();
        $departament_id=$request->input('departament_id');
       if ($request->input('sms_filter_for_kafedra')<3) {
        // $messages=PlayMobileModel::with(['user_sender', 'user_taker'])->where('','=',$request->input('departament_id'))->where('type_sms','=', $request->input('sms_filter'))->get();
         $messages=PlayMobileModel::with(['user_sender', 'user_taker'])->where("type_sms",'=',$request->input('sms_filter_for_kafedra'))->whereHas('user_department_many', function ($query) use($departament_id) {
            return $query->where('departament_id', '=', $departament_id);
        })->get();
       } else {
        $messages=PlayMobileModel::with(['user_sender', 'user_taker'])->whereHas('user_department_many', function ($query) use($departament_id) {
            return $query->where('departament_id', '=', $departament_id);
        })->get();
       }


        return response()->json([
            'messages' => $messages,

        ]);
    }
    public function get_sms_filter_by_teacher(Request $request)
    {

        $messages=PlayMobileModel::with(['user_sender', 'user_taker'])->where('taker_id','=',$request->input('teacher_id'))->get();


        return response()->json([
            'messages' => $messages,

        ]);
    }

    public function export(Request $request){

        $message_export = new SMSXabarnomaExport($request->input('month'));
        if ($request->month!=null) {
            return Excel::download($message_export, 'SMS_xabarnoma.xlsx');
        } else {
            return Excel::download(new SMSXabarnomaExport, 'SMS_xabarnoma.xlsx');
        }
        
       
    }

}
