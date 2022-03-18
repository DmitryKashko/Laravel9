<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$user_id = Auth::user()->id;
        $projects = DB::table('projects')->join('project_user_role as pur', 'projects.id', '=', 'pur.project_id' )->where('user_id', '=', $user_id)->pluck('project_id')->all();
        $projects = Project::whereIn('id', $projects)->get();*/
        dd();
        return UserResource::collection(User::all());
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

}
