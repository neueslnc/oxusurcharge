<?php

namespace App\Http\Controllers\SuperAdmin\Bid;

use App\Exports\StatementExport;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use PDF as DomPdf;
use Illuminate\Http\Request;
use App\Models\StatementModel;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bid\Statement\StatementRequestCreate;


class StatementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $today = Carbon::now();
        return view('super.bid.statement.index', [
            'statements' => StatementModel::with('teacher')
                ->select('statements.*',DB::raw('DATE_FORMAT(date, "%Y-%m-%d") AS date, DAY(date) AS day'))
                ->where('status', '=', $request->status)
                ->where('unfulfilled','=',$request->unfulfilled)
                ->orderBy('date','desc')
                ->whereMonth('created_at', $today->month)
                ->get(),
            "status" => $request->status,
            'unfulfilled'=>$request->unfulfilled
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
    public function store(StatementRequestCreate $request)
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
        $announcement = StatementModel::where('id', '=', $id)->first();

        $data = [
            'date' => $announcement->date_format(),
            'pair' => $announcement->pair,
            'location' => $announcement->location,
            'subject' => $announcement->subject,
            'teacher' => $announcement->teacher->full_name,
            'departament' => $announcement->teacher->departament->name,
            'role' => $announcement->teacher->role,
            'group' => $announcement->group,
            'group_name' => $announcement->group_name,
            'theme' => $announcement->theme
        ];

        $pdf = DomPdf::loadView('template_pdf.statement', $data);

        return $pdf->stream();
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

    public function get_count_active_statement_counts()
    {
        return response()->json(['statement_count' => StatementModel::where('status', '=', 0)->count() ]);
    }

    public function update_statement_status(Request $request, $id)
    {
        StatementModel::where('id', '=', $id)->update(['status' => $request->status]);

        return redirect()->route('superadmin.statement.index', ['status' => 0,'unfulfilled'=>0]);
    }
    public function update_statement_unfulfilled($id,$unfulfulled){

        StatementModel::where('id', '=', $id)->update(['unfulfilled' => $unfulfulled]);

        return redirect()->route('superadmin.statement.index', ['status' => 0]);
    }
    public function   month_filter(Request $request)
    {


     $messages=StatementModel::with(['teacher'])->where('status','=',$request->input('status'))->where('unfulfilled','=',$request->input('unfulfilled'))->whereMonth('created_at',$request->input('month_filter'))->get();

        return response()->json([
            'messages' => $messages,

        ]);
    }

    public function export(Request $request)
    {
        $statement_export = new StatementExport($request->input('month'));

        return Excel::download($statement_export, 'statement.xlsx');
    }
}
