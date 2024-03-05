<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoticiaController extends Controller
{
    public function index() {
        $noticias = Noticia::all();

        // loop through all posts
        foreach ($noticias as $noticia) {
        // convert the title into a slug and save it to the slug field
        $noticia->slug = Str::slug($noticia->titulo);

        // save the post
        $noticia->save();
        }
        return view('home', compact('noticias'));
    }

    public function showBySlug($titulo) {
        $titulo = Str::slug($titulo);

        $noticia = Noticia::where('slug', $titulo)->firstOrFail();

        return view('noticia.show', [
            'noticia' => $noticia,
        ]);
    }
}
