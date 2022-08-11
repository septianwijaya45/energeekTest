<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    function data(Request $request){
        $search = $request->search;

        if($search == ''){
            $skills = Skill::orderby('name','asc')->select('id','name')->get();
         }else{
            $skills = Skill::orderby('name','asc')->select('id','name')->where('name', 'like', '%' .$search . '%')->limit(5)->get();
         }
   
         $response = array();
         foreach($skills as $skill){
            $response[] = array(
                 "id"=>$skill->id,
                 "text"=>$skill->name
            );
         }
         return response()->json($response); 
    }
}
