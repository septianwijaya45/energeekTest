<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\SkillSet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidate = Candidate::all();

        return response()->json($candidate);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job'       => 'required',
            'name'       => 'required',
            'phone'     => 'required|unique:candidates|numeric',
            'email'     => 'required|unique:candidates',
            'year'      => 'required',
            'skill_set' => 'required'
        ], [
            'job.required'              => 'Jabatan Harus Diisi!',
            'name.required'             => 'Nama Harus Diisi!',
            'phone.required'            => 'Telepon Harus Diisi!',
            'phone.unique'              => 'Telepon Sudah Tersedia!',
            'phone.numeric'             => 'Telepon Harus Berupa Angka!',
            'email.required'            => 'Email Harus Diisi!',
            'email.unique'              => 'Email yang anda masukkan sudah pernah melamar dijabatan tersebut, silahkan memilih jabatan yang lain',
            'year.required'             => 'Tahun Lahir Harus Diisi!',
            'skill_set.required'        => 'Skill Set Harus Diisi!'
        ]);

        if($validator->fails()){
            return [
                'status'    => false,
                'messages'  => $validator->messages()
            ];
        }

        
        $countSkill = count($request->skill_set);
        

        $candidate = new Candidate();
        $candidate->job_id    = $request->job;
        $candidate->name      = $request->name;
        $candidate->email     = $request->email;
        $candidate->phone     = $request->phone;
        $candidate->year      = $request->year;
        $candidate->created_by      = Auth::user()->id;
        $candidate->updated_by      = Auth::user()->id;
        $candidate->created_at      = Carbon::now();
        $candidate->updated_at      = Carbon::now();
        $candidate->save();


        for ($i=0; $i <= $countSkill-1; $i++) { 
            $skill = new SkillSet();
            $skill->candidate_id = $candidate->id;
            $skill->skill_id = $request->skill_set[$i];
            $skill->save();
        }

        return response()->json([
            'candidate' => $candidate,
            'skill'     => $skill
        ]);
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
}
