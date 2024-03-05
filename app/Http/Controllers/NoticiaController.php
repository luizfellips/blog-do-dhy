<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function index() {
        $noticias = Noticia::all();

        return view('home', compact('noticias'));
    }
}
