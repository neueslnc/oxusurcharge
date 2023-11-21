<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserRequestCreate;
use App\Models\Departament;
use App\Models\User;
use App\Models\UserLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index', ['users' => User::paginate(7)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create', ['user_levels' => UserLevel::all(), 'departaments' => Departament::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequestCreate $request)
    {
        $request['password'] = Hash::make($request['password']);
        
        User::create($request->all());

        return redirect()->route('emloyees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::find($id);
    
        return view('user.edit', ['user_levels' => UserLevel::all(), 'departaments' => Departament::all()],compact('user'));
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
        $number = "$request->number_phone";
        
        User::where('id','=',$id)->update(['full_name'=>$request->full_name,
        'level_id'=>$request->level_id,'departament_id'=>$request->departament_id,'number_phone'=>$number]);
        return redirect()->route('emloyees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    //  dd($id);
     $user=User::where('id','=',$id)->delete();
    //  $user=User::where('id','=',7)->restore();

     session()->flash('success',"Xodim o'chirildi !");
     return redirect()->route('emloyees.index');
    }


}
