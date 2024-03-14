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
        
    }
}
