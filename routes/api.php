<?php

use App\Http\Controllers\API\CandidateController;
use App\Http\Controllers\API\JobController;
use App\Http\Controllers\API\SkillController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'  => 'Candidate'], function(){
    Route::get('/Get-Data', [CandidateController::class, 'index']);
    Route::post('/Simpan-Data', [CandidateController::class, 'store'])->name('storeCandidate');
});

Route::group(['prefix' => 'Jabatan'], function(){
    Route::post('/', [JobController::class, 'data'])->name('getJob');
});

Route::group(['prefix' => 'Skill'], function(){
    Route::post('/', [SkillController::class, 'data'])->name('getSkill');
});
