<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Models\NotificationUserModel;

class Profile extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->user_id);
        $notification=NotificationUserModel::where('id','=',$request->notification_id)->update(['status'=>1]);
        return redirect()->route('profiles.show',['profile'=>$request->user_id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::withCount(
            'announcement', 'announcement_accept', 'announcement_reject','announcement_unfulfilled',
            'statement', 'statement_accept', 'statement_reject','statement_unfulfilled',
            'articles','articles_accept','articles_reject'
        )->where("id", "=", $id)->first();
            $notifications=NotificationUserModel::where('recipient_id','=',$id)->where('status','=',0)->get();
        return view("super.employee.show", [
            'criterias' => Criteria::all(),
            'user' => $user,
            'notifications'=>$notifications,
            'user_id'=>$id,
        ]);
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
}
