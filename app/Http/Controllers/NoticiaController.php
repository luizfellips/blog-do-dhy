<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Noticia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;

class NoticiaController extends Controller
{
    public function index() {
        $noticias = Noticia::query()->paginate(6);

        return view('home', compact('noticias'));
    }

    public function showBySlug($titulo) {
        $titulo = Str::slug($titulo);

        $noticia = Noticia::where('slug', $titulo)->with('author')->firstOrFail();
        $noticiaKey = $noticia->getKey();

        $noticias = Noticia::where('id', '<>', $noticiaKey)->paginate(3);

        return view('noticia.show', [
            'noticia' => $noticia,
            'noticias' => $noticias
        ]);
    }

    public function create() {
        $authors = Author::all();
        $tags = Tag::all();

        return view('noticia.create', compact('authors', 'tags'));
    }

    public function store(Request $request) {
        $noticia = new Noticia;

        $noticia->titulo = $request->titulo;
        $noticia->slug = Str::slug($request->titulo);
        $noticia->subtitulo = $request->subtitulo;
        $noticia->corpo = $request->corpo;
        $noticia->legenda_imagem = $request->legenda_imagem;
        $noticia->author_id = $request->author_id;

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $requestImage = $request->imagem;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now"));

            $requestImage->move(public_path("img/noticias"), $imageName);

            $noticia->imagem = $imageName;
        }

        $noticia->save();

        $tagIds = $request->tags;

        $noticia->tags()->attach($tagIds);

        return redirect('/')->with('message', 'Criada com sucesso!');
    }
}
