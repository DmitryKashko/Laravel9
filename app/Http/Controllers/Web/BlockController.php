<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlockRequest;
use App\Models\Block;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        /*$blocks = Block::paginate(5);*/
        /*$user_id = Auth::user()->id;
        $blocks = Block::whereRelation('users', 'user_id', $user_id)->paginate(5);*/
        $user_id = Auth::user()->id;
        $projects = DB::table('projects')->join('project_user_role as pur', 'projects.id', '=', 'pur.project_id' )->where('user_id', '=', $user_id)->where('role_id', '!=', '1')->pluck('project_id')->all();

        $blocks = Block::whereIn('project_id', $projects)->paginate(5);


        /*dd($blocks);*/
        return view('blocks.index', compact('blocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::pluck('title', 'id')->all();
        return view('blocks.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BlockRequest $request)
    {
        $data = $request->validated();
        /*dd($data['file']);*/
        if($request->hasFile('file')) {
            $folder = date('Y-m-d');
            $images = $data['file'];
            unset($data['file']);
            foreach ($images as $key => $file){
                $files[] = $file->store("file/{$folder}",'public');
            }

            $data['file'] = implode(", ", $files);
        }
        /*dd($data);*/
        Block::create($data);

        return redirect()->route('blocks.index')->with('success', 'Блок добавлен');

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
        $block = Block::find($id);

        return view('blocks.edit', compact('block'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BlockRequest $request, $id)
    {

        $block = Block::find($id);
        /*dd($block);*/
        $data = $request->validated();
        if($request->hasFile('file')) {
            Storage::delete($block->file);
            $folder = date('Y-m-d');
            $data['file'] = $request->file('file')->store("file/{$folder}",'public');
        }

        $block->update($data);
        return redirect()->route('blocks.index')->with('success', 'Изменения сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $block = Block::find($id);
        $block->delete();

        return redirect()->route('blocks.index')->with('success', 'Блок удален');
    }
}
