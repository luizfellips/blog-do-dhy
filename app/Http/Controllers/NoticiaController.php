<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Author;
use App\Models\Noticia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class NoticiaController extends Controller
{
    public function index()
    {
        $carouselNoticias = Noticia::where('is_featured', true)->get();
        $noticias = Noticia::query()->paginate(6);

        return view('home', compact('noticias', 'carouselNoticias'));
    }

    public function searchResults()
    {
        $noticias = Noticia::query()->filter(request(['tag', 'search']))->paginate(6);

        return view('noticia.searchResults', compact('noticias'));
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

    public function trashed()
    {
        $noticias = Noticia::onlyTrashed()->paginate(6);

        return view('noticia.trashed', compact('noticias'));
    }

    public function restore($id) {

        try {
        $softDeletedNoticia = Noticia::onlyTrashed()->find($id);

            if ($softDeletedNoticia) {
                $softDeletedNoticia->restore();
            }            return redirect('dashboard')->with('message', 'Restaurado com sucesso!');
        } catch (\Throwable $th) {
            return redirect('dashboard')->with('message', 'Um erro ocorreu: ' . $th->getMessage());
        }
    }

    public function disintegrate($id) {

        try {
        $softDeletedNoticia = Noticia::onlyTrashed()->find($id);

            if ($softDeletedNoticia) {
                $softDeletedNoticia->forceDelete();
            }            return redirect('dashboard')->with('message', 'Desintegrado com sucesso!');
        } catch (\Throwable $th) {
            return redirect('dashboard')->with('message', 'Um erro ocorreu: ' . $th->getMessage());
        }
    }

    public function carousel()
    {
        $noticias = Noticia::query()->paginate(6);
        $carouselNoticias = Noticia::where('is_featured', true)->get();

        return view('noticia.carousel', compact('noticias', 'carouselNoticias'));
    }

    public function addToCarousel(Noticia $noticia)
    {
        try {
            $noticia->update([
                'is_featured' => true,
            ]);

            return redirect('dashboard')->with('message', 'Adicionado ao carrossel com sucesso!');
        } catch (\Throwable $th) {
            return redirect('dashboard')->with('message', 'Não foi possível completar a operação, erro: ' . $th->getMessage());
        }
    }

    public function removeFromCarousel(Noticia $noticia)
    {
        try {
            $noticia->update([
                'is_featured' => false,
            ]);

            return redirect()->route('noticia.carousel')->with('message', 'Removido do carrossel com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->route('noticia.carousel')->with('message', 'Não foi possível completar a operação, erro: ' . $th->getMessage());
        }
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

            $manager = new ImageManager(
                new Driver()
            );
            // Resize the image
            $image = $manager->read($requestImage);
            $image->scale(1320, 583);
            $image->toPng()->save(public_path("img/noticias/") . $imageName);

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

                $manager = new ImageManager(
                    new Driver()
                );
                // Resize the image
                $image = $manager->read($requestImage);
                $image->scale(1320, 583);
                $image->toPng()->save(public_path("img/noticias/") . $imageName);

                // Delete old image
                $oldImagePath = public_path("img/noticias/") . $noticia->imagem;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }

                $noticia->update([
                    'imagem' => $imageName,
                ]);
            }

            $noticia->tags()->sync([]);
            $noticia->tags()->attach($tagIds);

            return redirect('dashboard')->with('message', 'Atualizado com sucesso!');
        } catch (\Throwable $th) {
            return redirect('dashboard')->with('message', 'Não foi possível completar a operação, erro: ' . $th->getMessage());
        }
    }

    public function confirmDelete($id)
    {
        $noticia = Noticia::where('id', $id)->firstOrFail();

        return view('noticia.confirmDelete', [
            'noticia' => $noticia,
        ]);
    }

    public function destroy(Noticia $noticia)
    {
        try {
            $noticia->delete();
            return redirect('dashboard')->with('message', 'Deletado com sucesso!');
        } catch (\Throwable $th) {
            return redirect('dashboard')->with('message', 'Um erro ocorreu: ' . $th->getMessage());
        }
    }
}
