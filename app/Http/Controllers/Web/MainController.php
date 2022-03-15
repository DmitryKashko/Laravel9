<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    public function index() {

        $user_id = Auth::user()->id;

        $projects = DB::table('projects')->join('project_user_role as pur', 'projects.id', '=', 'pur.project_id' )->where('user_id', '=', $user_id)->pluck('project_id')->all();

        $projects = Project::whereIn('id', $projects)->get();


        /*$file =Storage::download('file.jpg');*/

        return view('welcome', compact('projects'));
    }

    public function show($id) {

        $blocks = Block::where('project_id', $id)->paginate(5);
        $users = DB::table('users')->join('project_user_role as pur', 'users.id', '=', 'pur.user_id' )->where('project_id', '=', $id)->pluck('user_id')->all();
        $users = User::whereIn('id', $users)->paginate(5);

        global $project;

        foreach ($blocks as $block) {
            $files = explode(", ", $block->file);
            $project = $block->project_id;
            foreach ($files as $file) {
                $file_path[] = response()->download('uploads/' . $file);
            }

            $block->file = $file_path;

            /*dd($file_path[0]->getFile()->getPathname());*/
            /*return $file_path[0]->setPublic();*/
            $file_path = [];

            /*return $file_path[0]->setPublic();
            dd($file_path[0]->getfile());*/


            /*$file_path = response()->download('uploads/' . $file);
            dd($file_path->getFile()->getFilename());*/

            /*$file_path = public_path('uploads/'.$block->file);
            response()->download($file_path);*/

            /*return $file_path;
            dd(response()->download('uploads/'.$files[0]));*/
        }

        return view('show', compact('blocks', 'users', 'project'));
    }
}
