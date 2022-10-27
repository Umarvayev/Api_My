<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Volcano;

class VolcanoController extends Controller
{
   public function index(){
    return Volcano::paginate(20);
   }
  
    public function store(Request $request){
        $volcano = Volcano::create($request->all());
        $data = "Successfully stored the data";
        return response()->json($data, 200);
    }

    public function show($id){
        $volcano = Volcano::findorfail($id);

        $data = array();
        $data['name']= $volcano->name; 
        $data['country']= $volcano->country; 
        $data['height']= $volcano->height; 

        return response()->json($data, 200);
    }

    public function update(Request $request, $id){
        $volcano = Volcano::findorfail($id);

        $volcano->name = $request->name;
        $volcano->country = $request->country;
        $volcano->height = $request->height;

        $volcano->save();
        
        $data = "Successfully Updated the record";
        return response()->json($data, 200);
    }

    public function destroy($id){
        $volcano = Volcano::findorfail($id);

        $volcano->delete();

        $data = "Successfully delete the record";
        return response()->json($data, 200);
    }
}
