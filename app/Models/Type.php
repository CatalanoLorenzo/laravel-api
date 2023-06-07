<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['name','cover','slug']; 

    public static function generateSlug($title)
    {
        return Str::slug($title,'-');
    }
    /**
     * una funzione che determina il tipo di relazione tra Type e Project
     */
    public function projects()
    {
        //un Modello Type può avere molti modelli Project
        return $this->hasMany(Project::class);
    }
   
}