<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        $projects = Project::orderByDesc('id')->paginate(8);
        return view('admin.projects.index', compact('projects','types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $technologies = Technology::all();
        $types = Type::all();
        return view('admin.projects.create',compact('types','technologies'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        //dd($request);
        $val_data_form = $request->validated();
        $val_data_form['slug'] = Project::generateSlug($val_data_form["title"]);
        //dd($val_data_form);
        if ($request->hasFile('cover')) {
            $image_path = Storage::put('uploads',$request->cover);
            //dd($image_path );
            $val_data_form['cover'] = $image_path;
        }
        $new_project = Project::create($val_data_form);

                    // Attach the checked tags
        if ($request->has('technologies')) {
            $new_project->technologies()->attach($request->technologies);
        }
            //dd($new_project);
        return to_route('admin.projects.index')->with('message', 'projects add successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.show', compact("project","types"));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $technologies = Technology::all();
        $types = Type::all();
        return view('admin.projects.edit', compact("project","types","technologies"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //dd($request);

        $val_data_form = $request->validated();

        $val_data_form['slug'] = Project::generateSlug($val_data_form["title"]);
        //dd($val_data_form);
        //$project->update($val_data_form);

        if ($request->hasFile('cover')) {
            Storage::delete($project->cover);
            $image_path = Storage::put('uploads',$request->cover);
            $val_data_form['cover'] = $image_path;
        }
        $project ->update($val_data_form);


        if ($request->has('technologies')) {
            $project ->technologies()->sync($request->technologies);
        }


        return to_route('admin.projects.index')->with('message', 'projects add successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return to_route('admin.projects.index')->with('message', 'projects is delete');
    }
}
