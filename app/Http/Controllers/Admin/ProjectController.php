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
        //prendo tutti gli elementi dalla tabella project in ordine descrescente per un max 
        //di 8 elementi a pagina e l'inserisco nella variabile
        $projects = Project::orderByDesc('id')->paginate(8);

        //mostro la pagina admin/projectS/index e gli passo la variabile
        return view('admin.projects.index', compact('projects')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //prendo tutti gli elementi dalla tabella technologi e l'inserisco nella variabile technologies
        $technologies = Technology::all();

        //prendo tutti gli elementi dalla tabella type e l'inserisco nella variabile types
        $types = Type::all();

        //mostro la pagina admin/project/create e gli passo le due variabili
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        #dd($request);

        //prendo i dati validati dal form e li inserisco in una variabile
        $val_data_form = $request->validated();

        //prendo la kay 'slug' della variabile e tramite la funzione del modello gli inserisco il valore
        $val_data_form['slug'] = Project::generateSlug($val_data_form["title"]);

        #dd($val_data_form);

        //condizione : se nei file inviati dal form è presente cover 
        if ($request->hasFile('cover')) {

            //creo un percorso  usando la funzione put del modello storage  passandogli cover
            $image_path = Storage::put('uploads', $request->cover);
            
            #dd($image_path );

            //e inserisco il percorso generato nella key cover nella variabile
            $val_data_form['cover'] = $image_path;

        }
        +
        //creo  una nuova riga nel database come campi i dati della variabile
        $new_project = Project::create($val_data_form);

        //condizione : se nei dati inviati dal form è presente tenchnologies 
        if ($request->has('technologies')) {

            //nella riga creata aggiungo le technologies passate
            $new_project->technologies()->attach($request->technologies);
        }

        #dd($new_project);

        //reindirizzo alla pagina admin/projects/index e concateno un messaggio di avvenuto successo
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
    
        //mostro la pagina admin/project/show e gli passo la variabile 
        return view('admin.projects.show', compact("project"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //prendo tutti gli elementi dalla tabella technologi e l'inserisco nella variabile technologies
        $technologies = Technology::all();

        //prendo tutti gli elementi dalla tabella type e l'inserisco nella variabile types
        $types = Type::all();

        //mostro la pagina admin/project/edit e gli passo le tre variabili
        return view('admin.projects.edit', compact("project", "types", "technologies"));
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
        #dd($request);

        //prendo i dati validati dal form e li inserisco in una variabile
        $val_data_form = $request->validated();

        //prendo la kay 'slug' della variabile e tramite la funzione del modello gli inserisco il valore
        $val_data_form['slug'] = Project::generateSlug($val_data_form["title"]);
        
        #dd($val_data_form);

        //condizione : se nei file inviati dal form è presente cover 
        if ($request->hasFile('cover')) {

            //cancella dallo storage la vecchia immagine
            Storage::delete($project->cover);

            //creo un percoso con la funzione put del modello storage da cover
            $image_path = Storage::put('uploads', $request->cover);

            //inserisco il percorso creato  nella key cover nella variabile
            $val_data_form['cover'] = $image_path;
        }

        //aggiorno la riga corrispondente nel database con i dati della variabile 
        $project->update($val_data_form);

        //condizione: se nei dati passati dal  form ci sono delle technologies
        if ($request->has('technologies')) {

            //aggiorna la tabella pivo collegata 
            $project->technologies()->sync($request->technologies);
        }

        //reindirizzo alla pagina admin/projects/index e concateno un messaggio di avvenuto successo
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
        //condizione: se è presente un valore nella key cover
        if ($project->cover) {

            //elimina il file dalla cartella storage
            Storage::delete($project->cover);
         }

        //rimuove la riga corrispondente dalla tabella del database
        $project->delete();

        //reindirizzo alla pagina admin/projects/index e concateno un messaggio di avvenuto successo
        return to_route('admin.projects.index')->with('message', 'projects is delete');
    }
}