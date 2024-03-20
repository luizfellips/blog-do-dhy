<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Noticia extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function getRouteKeyName()
    {
        return 'titulo';
    }

    protected $fillable = [
        'titulo',
        'slug',
        'subtitulo',
        'corpo',
        'imagem',
        'legenda_imagem',
        'author_id',
        'is_featured'
    ];

    public function scopeFilter($query, array $filters){
        return $query->when($filters['tag'] ?? false, function ($query, $tag) {
            $query->whereHas('tags', function ($query) use ($tag) {
                $query->where('name', 'like', '%' . $tag . '%');
            });
            
        })->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('titulo', 'like', '%' . $search . '%');
        });
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
