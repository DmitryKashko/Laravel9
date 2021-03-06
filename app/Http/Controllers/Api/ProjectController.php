<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        /*return Project::all();
        return ProjectResource::collection(Project::get());*/

        $people = Project::all();
        return $people;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ProjectResource
     */
    public function store(ProjectRequest $request)
    {
        $created_project = Project::create($request->validated());

        return new ProjectResource($created_project);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return ProjectResource|Project|\Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        /*return new ProjectResource(Project::findOrFail($id));*/
        return $project;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return ProjectResource
     */
    public function update(ProjectRequest $request, Project $project)
    {
        /*dd($request);*/
        $data = $request->validated();
        $project->update($data);

        return new ProjectResource($project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        return Project::destroy($id);
    }
}
