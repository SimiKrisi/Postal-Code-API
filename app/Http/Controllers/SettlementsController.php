<?php

namespace App\Http\Controllers;
use App\Models\PostalCode;

use App\Http\Requests\SettlementRequest;

class SettlementsController extends Controller
{
    public function index(){
        $settlements = PostalCode::with('county')->get();
        return response()->json(['settlements'=>$settlements]);
    }

    public function store(SettlementRequest $request){
        $settlement = PostalCode::create($request->all());
        return response()->json(['message' => 'Settlement created successfully', 'settlement' => $settlement], 201);
    }
    public function storeWhere(SettlementRequest $request, $c_id, ){
        $settlement = PostalCode::create($request->code()->name());
        $settlement->county_id($c_id);
        return response()->json(['message' => 'Settlement created successfully', 'settlement' => $settlement], 201);
    }
    
    public function update(SettlementRequest $request, $id){
        $settlement = PostalCode::findOrFail($id);
        $settlement->update($request->all());
        return response()->json(['message' => 'Settlement updated successfully', 'settlement' => $settlement]);
    }
    public function destroy($id){
        $settlement = PostalCode::findOrFail($id);
        $settlement->delete();
        return response()->json(['message' => 'Settlement deleted successfully']);
    }
}
