<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bid\BidRequestCreate;
use App\Models\BidModel;
use Illuminate\Http\Request;

class BidController extends Controller
{
    public function view_bid($status)
    {
        return view('bid.index', ['bids' => BidModel::with('user')->where('status', '=', $status)->get(), "status" => $status]);    
    }

    public function create() 
    {
        return view("bid.create");
    } 

    public function store( BidRequestCreate $request )
    {

        $data = $request->all();

        $data['user_id'] = $request->user()->id;

        BidModel::create($data);

        return redirect()->route('view_bid', ['status' => 0]);
    }

    public function get_count_active_bids() 
    {
        return response()->json(['bid_count' => BidModel::where('status', '=', 0)->count() ]);
    }

    public function update_status(Request $request, $id)
    {
        BidModel::where('id', '=', $id)->update(['status' => $request->status]);

        return redirect()->route('view_bid', ['status' => 0]);

    }
}
