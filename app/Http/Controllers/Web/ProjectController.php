<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        /*$projects = Project::paginate(5);*/

        $user_id = Auth::user()->id;

        $projects = DB::table('projects')->join('project_user_role as pur', 'projects.id', '=', 'pur.project_id' )->where('user_id', '=', $user_id)->where('role_id', '!=', '1')->pluck('project_id')->all();

        $projects = Project::whereIn('id', $projects)->paginate(5);

        /*$projects = Project::paginate(10);*/

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::pluck('name', 'id')->all();
        $roles = Role::pluck('name', 'id')->all();
        foreach ($roles as $k => $v) {
            if ($v == 'Создатель') {
                unset($roles[$k]);
            }
        }
        /*dd($roles);*/
        return view('projects.create', compact('users','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {

        try {
            DB::beginTransaction();
            $data = $request->validated();
            /*dd($data);*/

            $project = Project::firstOrCreate([
                'title' => $data['title'],
                'description' => $data['description'],
            ]);

            $project->users()->attach($data['users1'], ['role_id' => $data['role1_id']]);
            $project->users()->attach($data['users2'], ['role_id' => $data['role2_id']]);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(404);
        }
        return redirect()->route('projects.index')->with('success', 'Проект добавлен');

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::pluck('name', 'id')->all();
        $roles = Role::pluck('name', 'id')->all();
        $project = Project::find($id);
        /*dd($projects);*/
        foreach ($roles as $k => $v) {
            if ($v == 'Создатель') {
                unset($roles[$k]);
            }
        }
        return view('projects.edit', compact('users', 'roles', 'project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::find($id);
        $project->users()->sync([]);
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $project->update([
                'title' => $data['title'],
                'description' => $data['description'],
            ]);
            $project->users()->attach($data['users1'], ['role_id' => $data['role1_id']]);
            $project->users()->attach($data['users2'], ['role_id' => $data['role2_id']]);
            /*$project = Project::create($request->all());
            $project->users()->sync($request->users);*/
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            /*dd($exception);*/
            abort(404);
        }

        return redirect()->route('projects.index')->with('success', 'Изменения сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->users()->sync([]);
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Проект удален');
    }
}
