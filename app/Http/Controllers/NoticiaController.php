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
    public function index()
    {
        $noticias = Noticia::query()->paginate(6);

        return view('home', compact('noticias'));
    }

    public function showBySlug($titulo)
    {
        $titulo = Str::slug($titulo);

        $noticia = Noticia::where('slug', $titulo)->with('author')->firstOrFail();
        $noticiaKey = $noticia->getKey();

        $noticias = Noticia::where('id', '<>', $noticiaKey)->paginate(3);

        return view('noticia.show', [
            'noticia' => $noticia,
            'noticias' => $noticias
        ]);
    }

    public function create()
    {
        $authors = Author::all();
        $tags = Tag::all();

        return view('noticia.create', compact('authors', 'tags'));
    }

    public function edit($id)
    {
        $authors = Author::all();
        $tags = Tag::all();

        $noticia = Noticia::with(['author', 'tags'])->where('id', $id)->first();

        return view('noticia.edit', compact('noticia', 'authors', 'tags'));
    }


    public function list()
    {
        $noticias = Noticia::with('author')->paginate(6);

        return view('noticia.list', compact('noticias'));
    }

    public function store(Request $request)
    {
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

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . '.' . $extension;

            $requestImage->move(public_path("img/noticias"), $imageName);

            $noticia->imagem = $imageName;
        }

        $noticia->save();

        $tagIds = $request->tags;

        $noticia->tags()->attach($tagIds);

        return redirect('dashboard')->with('message', 'Criada com sucesso!');
    }

    public function update(Request $request, Noticia $noticia)
    {

        try {
            $tagIds = $request->tags;

            $noticia->update([
                'titulo' => $request->titulo,
                'slug' => Str::slug($request->titulo),
                'subtitulo' => $request->subtitulo,
                'corpo' => $request->corpo,
                'legenda_imagem' => $request->legenda_imagem,
                'author_id' => $request->author_id,
            ]);

            if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
                $requestImage = $request->imagem;

                $extension = $requestImage->extension();

                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . '.' . $extension;

                $requestImage->move(public_path("img/noticias"), $imageName);

                $noticia->update([
                    'imagem' => $imageName,
                ]);
            }

            $noticia->tags()->sync([]);
            $noticia->tags()->attach($tagIds);

            return redirect('dashboard')->with('message', 'Atualizado com sucesso!');
        } catch (\Throwable $th) {
            return redirect('dashboard')->with('message', 'Não foi possível completar a operação');
        }
    }

    public function confirmDelete($id)
    {
        $noticia = Noticia::where('id', $id)->firstOrFail();

        return view('noticia.confirmDelete', [
            'noticia' => $noticia,
        ]);
    }

    public function destroy(Noticia $noticia) {
        try {
            $noticia->delete();
            return redirect('dashboard')->with('message', 'Deletado com sucesso!');

        } catch (\Throwable $th) {
            return redirect('dashboard')->with('message', 'Um erro ocorreu: ' . $th->getMessage());
        }
    }
}
