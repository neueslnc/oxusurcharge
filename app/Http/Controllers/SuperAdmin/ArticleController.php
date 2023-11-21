<?php

namespace App\Http\Controllers\SuperAdmin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\ArticleModel;
use Illuminate\Http\Request;
use App\Models\UserOnCriteria;
use App\Models\AnnouncementModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\Article\ArticleRequestCreate;
use App\Models\Criteria;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $today = Carbon::now();
        $article = ArticleModel::with('teacher')->where('status', '=', $request->status)->orderBy('created_at', 'desc')->whereMonth('created_at', $today->month)->paginate(15);
        $article->appends(['status' => $request->status]);

        return view('super.article.index', [
            'articles' => $article,
            "status" => $request->status
        ]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequestCreate $request)
    {

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

    public function get_count_active_article_counts() 
    {
        return response()->json(['article_count' => ArticleModel::where('status', '=', 0)->count() ]);
    }

    public function update_article_status(Request $request, $id)
    {
        ArticleModel::where('id', '=', $id)->update(['status' => $request->status]);
        $article=ArticleModel::where('id', '=', $id)->first();
    
        $criter_id=Criteria::where('name','=',"Maqola, monografiya, o‘quv qo'llanma, darsliklar")->first()->id;
        if($criter_id!=null && $request->status==1){

            $percent=User::where('id','=',$article->user_id)->first()->percent;
            $percent=$percent+5;
           
            $check=UserOnCriteria::where('user_id','=',$article->user_id)->where('criteria_id','=',$criter_id)->first();
           
            if ($check==null) {
             
               UserOnCriteria::create(['user_id'=>$article->user_id,'data'=>'5','increase'=>'positive','criteria_id'=>$criter_id,'status'=>1]);
            
               User::where('id','=',$article->user_id)->update(['percent'=>$percent]);
            } else {
                if ($check->status != 1) {
                    
                    UserOnCriteria::where('id','=',$check->id)->update(['status'=>1 ]);
                    User::where('id','=',$article->user_id)->update(['percent'=>$percent]);
                } 
            }
        }
       
        
        return redirect()->route('superadmin.article.index', ['status' => 0]);
    }
    
    public function   article_month_filter(Request $request)
    {


     $messages=ArticleModel::with(['teacher'])->where('status','=',$request->input('status'))->whereMonth('created_at',$request->input('month_filter'))->get();
     foreach ($messages as $key => $message) {
        
        $message['date_create']=$message->date_create();
       
      }
        return response()->json([
            'messages' => $messages,

        ]);
    }
}
