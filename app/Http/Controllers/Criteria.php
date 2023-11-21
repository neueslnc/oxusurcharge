<?php

namespace App\Http\Controllers;

use App\Http\Requests\Criteria\CreateUpdateCriteriaOnUser;
use App\Models\ArchiveCriteriaModel;
use App\Models\Criteria as ModelsCriteria;
use App\Models\Departament;
use App\Models\User;
use App\Models\UserOnCriteria;
use Database\Seeders\ArchiveCriteriaSeed;
use Illuminate\Http\Request;

class Criteria extends Controller
{
    public function set_data(CreateUpdateCriteriaOnUser $request)
    {

        if ($request->type == "checkbox") {

            $data = $request->all();

            $criteria = ModelsCriteria::where("id", "=", $data['criteria_id'])->first();

            if (ModelsCriteria::where("id", "=", $data['criteria_id'])->first()->rules['rules']['checkbox']['limit'] == 1 ) {

                if(!UserOnCriteria::where('user_id', '=', $request->user_id)->where('criteria_id', '=', $request->criteria_id)->first()){

                    $new = UserOnCriteria::create($data);

                }else{

                    $new = UserOnCriteria::where('user_id', '=', $request->user_id)->where('criteria_id', '=', $request->criteria_id)->first()->update([
                        'status' => $request->status
                    ]);
                }

            }else{

                if(!UserOnCriteria::where('user_id', '=', $request->user_id)->where('criteria_id', '=', $request->criteria_id)->first()){

                    $data['states'] = [
                        "checkbox" => [
                            "position" => [

                            ],
                        ]
                    ];

                    for ($i=0; $i < ModelsCriteria::where("id", "=", $data['criteria_id'])->first()->rules['rules']['checkbox']['limit']; $i++) {

                        if($i == intval($data['position'])){

                            array_push(
                                $data['states']['checkbox']['position'],
                                [
                                    "id" => intval($data['position']),
                                    "included" => 1
                                ]
                            );
                        }else{

                            array_push(
                                $data['states']['checkbox']['position'],
                                [
                                    "id" => $i,
                                    "included" => 0
                                ]
                            );
                        }

                    }

                    if ($criteria->rules['rules']['checkbox']['all_checkbox']){

                        foreach ($data['states']['checkbox']['position'] as $item_2) {

                            if($item_2['included'] == 0){

                                $data['status'] = 0;

                                break;
                            }else {
                                $data['status'] = 1;
                            }
                        }

                    }else{

                        foreach ($data['states']['checkbox']['position'] as $item_2) {

                            if($item_2['included'] == 1){

                                $data['status'] = 1;

                                break;
                            }else {
                                $data['status'] = 0;
                            }
                        }
                    }

                    UserOnCriteria::create($data);

                }else{

                    $item = UserOnCriteria::where('user_id', '=', $request->user_id)->where('criteria_id', '=', $request->criteria_id)->first();

                    $new_item = ['checkbox' => [
                        "position" => [

                        ]
                    ]];

                    foreach ($item['states']['checkbox']['position'] as $item_1) {

                        if ($item_1['id'] == intval($data['position'])) {

                            array_push(
                                $new_item['checkbox']['position'],
                                [
                                    'id' => $item_1['id'],
                                    'included' => intval($data['status'])
                                ]
                            );
                        }else{

                            array_push(
                                $new_item['checkbox']['position'],
                                [
                                    'id' => $item_1['id'],
                                    'included' => $item_1['included']
                                ]
                            );
                        }
                    }

                    $item->states = $new_item;

                    if ($criteria->rules['rules']['checkbox']['all_checkbox']) {

                        foreach ($item['states']['checkbox']['position'] as $item_2) {

                            if ($item_2['included'] == 0) {

                                $item->status = 0;

                                break;
                            } else {
                                $item->status = 1;
                            }
                        }

                    }else{

                        foreach ($item['states']['checkbox']['position'] as $item_2) {

                            if ($item_2['included'] == 1) {

                                $item->status = 1;

                                break;
                            } else {
                                $item->status = 0;
                            }
                        }

                    }
                    $item->save();
                }
            }

        }

        User::where('id', '=', $request->user_id)->first()->update([
            'percent' => User::where("id", "=", $request->user_id)->first()->get_percent_teacher()
        ]);

        return response()->json([
            'user_id' => $request->user_id,
            'users' => User::where("level_id", "=", 3)->get(),
            'percent' => User::where("id", "=", $request->user_id)->first()->get_percent_teacher(),
        ]);
    }

    public function report_archive_criterias(){
        return view('criteria.report_achvive', [
            'criterias' => ModelsCriteria::all(),
            'teachers' => User::where("level_id", "=", 3)->get()
        ]);
    }

    public function report_archive_criteria($criteria_id, $month_year = null)
    {

        $date_from = $month_year ? date("Y-m-d", strtotime("first day of {$month_year}")) : date("Y-m-d", strtotime("first day of -1 month"));

        $date_to = $month_year ? date("Y-m-d", strtotime("last day of {$month_year}")) : date("Y-m-d", strtotime("last day of -1 month"));

        // dd(ArchiveCriteriaModel::where('id', '=', $criteria_id)->first());

        // dd(User::where("level_id", "=", 3)->get()[0]->on_criteria_active($criteria_id));

        return view('criteria.report_achive_criteria', [
            'criteria' => ModelsCriteria::where('id', '=', $criteria_id)->first(),
            'teachers' => User::with('on_criteria_active')->where("level_id", "=", 3)->get(),
            'date_from' => $date_from,
            'departamets' => Departament::all(),
            'date_to' => $date_to
        ]);
    }
}
