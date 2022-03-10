<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index() {

        $user_id = Auth::user()->id;

        $projects = DB::table('projects')->join('project_user_role as pur', 'projects.id', '=', 'pur.project_id' )->where('user_id', '=', $user_id)->pluck('project_id')->all();

        $projects = Project::whereIn('id', $projects)->get();



        return view('welcome', compact('projects'));
    }

    public function show($id) {

        $blocks = Block::where('project_id', $id)->paginate(5);
        $users = DB::table('users')->join('project_user_role as pur', 'users.id', '=', 'pur.user_id' )->where('project_id', '=', $id)->pluck('user_id')->all();
        $users = User::whereIn('id', $users)->paginate(5);
        return view('show', compact('blocks', 'users'));
    }
}
