<?php

namespace App\Http\Controllers;
use App\Models\PostalCode;
use Illuminate\Http\Request;
use App\Http\Requests\CountyRequest;
use App\Models\County;
use PHPUnit\Framework\Constraint\Count;

class CountiesController extends Controller
{
    public function index(){
        $counties = County::all();
        return response()->json(['counties'=>$counties]);
    }
    public function store(CountyRequest $request){
        $county = County::create($request->all());
        return response()->json(['message' => 'County created successfully', 'county' => $county], 201);
    }

    public function update(CountyRequest $request, $id){
        $county = County::findOrFail($id);
        $county->update($request->all());
        return response()->json(['message' => 'County updated successfully', 'county' => $county]);
    }
    public function destroy($id){
        $county = County::findOrFail($id);
        $county->delete();
        return response()->json(['message' => 'County deleted successfully']);
    }
}
