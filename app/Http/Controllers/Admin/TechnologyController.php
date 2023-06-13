<?php

namespace App\Http\Controllers\Admin;

use App\Models\Technology;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $singletechnology = ''; 
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies','singletechnology'));
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
     * @param  \App\Http\Requests\StoreTechnologyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTechnologyRequest $request)
    {
        //dd($request);
        $val_data_form = $request->validated();
        $val_data_form['slug'] = Technology::generateSlug($val_data_form["name"]);
        //dd($val_data_form);
        if ($request->hasFile('cover')) {
            $image_path = Storage::put('uploads',$request->cover);
            //dd($image_path );
            $val_data_form['cover'] = $image_path;
        }
        Technology::create($val_data_form);
        return to_route('admin.technologies.index')->with('message', 'type add successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        $singletechnology = $technology;
        $technologies = Technology::all();
        //dd($singletechnology);
        return view('admin.technologies.index', compact("singletechnology",'technologies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTechnologyRequest  $request
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        //dd($request);
        $val_data_form = $request->validated();
        //dd($val_data_form);
        if ($request->hasFile('cover')) {
            Storage::delete($technology->cover);
            $image_path = Storage::put('uploads',$request->cover);
            $val_data_form['cover'] = $image_path;
        }
        $val_data_form['slug'] = Technology::generateSlug($val_data_form["name"]);
        $technology->update($val_data_form);
        return to_route('admin.technologies.index')->with('message', 'type add successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        if ($technology->cover) {
            Storage::delete($technology->cover);
         }
        //dd($technology);
        $technology->delete();
        return to_route("admin.technologies.index")->with("message", "Technology successfully deleted");
    }
}
