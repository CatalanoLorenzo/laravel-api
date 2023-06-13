<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        //creo una variabile che contiene tutti i Project presenti nel database e ci angiungo 
        //le forignkay e le tabelle pilot collegata ordinandomelo in base  
        //all'id in ordine decrescente  con pagine di 4 elementi
        $projects = Project::with(['type', 'technologies'])->orderByDesc('id')->paginate(4);
        //$projects = Project::all();
        //mi ritorno in formato json un array con primo elemento un messaggio di avvenuto successo e come secondo il contenuto della variabile creata prima
       
        return response()->json([
            'success' => true,
            'projects' => $projects,
        ]);
    }
}
