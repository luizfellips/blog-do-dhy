<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;

class AuthorController extends Controller
{
    public function create()
    {
        $authors = Author::all();

        return view('author.create', compact('authors'));
    }

    public function store(AuthorRequest $request)
    {
        try {
            Author::create([
                'name' => $request->input('author.name'),
                'job' => $request->input('author.job'),
            ]);

            $authors = Author::all();

            session()->flash('message', 'Autor registrado com sucesso');
            return view('author.create', compact('authors'));
        } catch (\Throwable $th) {
            return redirect()->route('author.create')->with('message', 'Author could not be created. Please contact dev');
        }
    }

    public function show(Author $author)
    {
        $authorWithNoticias = Author::with('noticias')->where('id', $author->id)->first();

        return view('author.show', [
            'author' => $authorWithNoticias,
        ]);
    }

    public function destroy(Author $author)
    {
        try {
            $author->delete();
            $authors = Author::all();

            session()->flash('message', 'Autor deletado com sucesso');
            return view('author.create', compact('authors'));
        } catch (\Throwable $th) {
            $authors = Author::all();

            session()->flash('message', 'Não foi possível deletar o autor. Há notícias associadas com o mesmo, exclua-as permantemente e tente novamente.');
            session()->flash('status', 'error');
            return view('author.create', compact('authors'));
        }
    }
}
