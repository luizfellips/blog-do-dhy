<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'titulo';
    }

    protected $fillable = [
        'titulo',
        'slug',
        'subtitulo',
        'corpo',
        'imagem'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
