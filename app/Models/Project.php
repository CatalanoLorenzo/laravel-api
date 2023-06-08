<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Project extends Model
{
    
    use HasFactory;
    protected $fillable = ['title','content','cover','slug','link','source','type_id','technology_id'];
    public static function generateSlug($title)
    {
        return Str::slug($title,'-');
    }
    /**
     * Get the type that owns the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
  /**
   * The roles that belong to the Project
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function technologies(): BelongsToMany
  {
      return $this->belongsToMany(Technology::class);
  }
}
