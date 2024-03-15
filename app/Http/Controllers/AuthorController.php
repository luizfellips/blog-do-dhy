<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Noticia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;

class AuthorController extends Controller
{
    public function create() {
        $authors = Author::all();

        return view('author.create', compact('authors'));
    }

    public function store(Request $request) {
        $author = new Author;
        $author->name = $request->name;
        $author->job = $request->job;

        $author->save();

        $authors = Author::all();

        session()->flash('message', 'Autor registrado com sucesso');
        return view('author.create', compact('authors'));
    }

    public function show(Author $author) {
        $authorWithNoticias = Author::with('noticias')->where('id', $author->id)->first();

        return view('author.show', [
            'author' => $authorWithNoticias,
        ]);
    }

    public function destroy(Author $author) {
        $author->delete();
        $authors = Author::all();

        session()->flash('message', 'Autor deletado com sucesso');
        return view('author.create', compact('authors'));
    }
}
