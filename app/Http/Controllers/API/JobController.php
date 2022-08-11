<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Skill;
use Illuminate\Http\Request;

class JobController extends Controller
{
    function data(Request $request){
        $search = $request->search;

        if($search == ''){
            $jobs = Job::orderby('name','asc')->select('id','name')->get();
         }else{
            $jobs = Job::orderby('name','asc')->select('id','name')->where('name', 'like', '%' .$search . '%')->limit(5)->get();
         }
   
         $response = array();
         foreach($jobs as $job){
            $response[] = array(
                 "id"=>$job->id,
                 "text"=>$job->name
            );
         }
         return response()->json($response); 
    }
}
