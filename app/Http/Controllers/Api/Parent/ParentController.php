<?php

namespace App\Http\Controllers\Api\Parent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParentModel;
class ParentController extends Controller
{
    //
 public function parents(){
     return response()->json(ParentModel::get());
 }
 public function parentByID($id){
     return response()->json(ParentModel::find($id),200);
 }
public function create(Request $request)
{
  $newParent=  ParentModel::create($request->all());
  return response()->json($newParent , 201);
}
public function parentUpdate(Request $request,ParentModel $parent)
{
    $parent->update($request->all());
    return response()->json($parent,200);
}

}
