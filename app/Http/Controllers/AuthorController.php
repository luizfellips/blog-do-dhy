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
    public function create() {
        return view('author.create');
    }

    public function store(Request $request) {
        
    }
}
