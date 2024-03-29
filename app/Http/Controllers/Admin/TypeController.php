<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $singletype = ''; 
        $types = Type::all();
        return view('admin.types.index', compact('types','singletype'));
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
     * @param  \App\Http\Requests\StoreTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTypeRequest $request)
    {
        //dd($request);
        $val_data_form = $request->validated();
        $val_data_form['slug'] = Type::generateSlug($val_data_form["name"]);
        dd($val_data_form);
        if ($request->hasFile('cover')) {
            $image_path = Storage::put('uploads',$request->cover);
            //dd($image_path );
            $val_data_form['cover'] = $image_path;
        }
        dd($val_data_form);
        Type::create($val_data_form);
        return to_route('admin.types.index')->with('message', 'type add successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        $singletype = $type;
        $types = Type::all();
        //dd($singletype);
        return view('admin.types.index', compact("singletype",'types'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTypeRequest  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        //dd($request);
        $val_data_form = $request->validated();
        $val_data_form['slug'] = Type::generateSlug($val_data_form["name"]);
        //dd($val_data_form);
        if ($request->hasFile('cover')) {
            Storage::delete($type->cover);
            $image_path = Storage::put('uploads',$request->cover);
            $val_data_form['cover'] = $image_path;
        }
        $type->update($val_data_form);
        return to_route('admin.types.index')->with('message', 'type add successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        if ($type->cover) {
           Storage::delete($type->cover);
        }
        $type->delete();
        return to_route('admin.types.index')->with('message', 'types is delete');
    }
}
