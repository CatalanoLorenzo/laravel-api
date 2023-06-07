<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    
    use HasFactory;
    protected $fillable = ['title','content','cover','slug','link','source'];
    public static function generateSlug($title)
    {
        return Str::slug($title,'-');
    }

    /**
     * funzione che determina l'appartenenza di un modello Ptoject ad un unico  modello Type
     */
    public function types():BelongsTo
    {
        //un Modello Project può appartenere solo un modello Type
        return $this->belongsTo(Type::class);
    }
}
