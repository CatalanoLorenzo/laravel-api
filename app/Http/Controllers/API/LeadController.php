<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\NewLead;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class LeadController extends Controller
{
    public function store(Request $request)
    { $data =$request->all();
        //API EMAIL
        //controllo dei dati inseriti
        //dd($request);
        //validazione dei dati
        $validator = FacadesValidator::make($data ,[
            'name' => 'required|max:255',
            'email' => 'require|email|max:255',
            'message' => 'required',
        ]);
        //controllare la validazione e nel caso dare un messaggio di errore
        if ($validator->fails()) {
            return response()->json([
                'succes' => false,
                'errors' => $validator->errors()
            ]);
        }
        //salviamo i dati
        $newLead = new Lead();
        $newLead->fill($data);
        $newLead->save();
        //inviamo la email
        Mail
        ::to('lorenzocatalano1995@outlook.it')->send(new NewLead($newLead));
        //retituiamo un response->success
        return response()->json([
            'succes' => true
        ]);
    }
}
