<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    public function index() {
        return view('videos.index');
    }
    
    public function create() {
        $tags = Tag::all();

        return view('tags.create', compact('tags'));
    }

    public function store(Request $request) {
        $tag = new Tag;
        $tag->name = $request->name;

        $tag->save();

        $tags = Tag::all();

        session()->flash('message', 'Tag registrada com sucesso');
        return view('tags.create', compact('tags'));
    }

    public function destroy(Tag $tag) {
        $tag->delete();
        $tags = Tag::all();

        session()->flash('message', 'Tag deletada com sucesso');

        return redirect()->route('tags.create', compact('tags'));
    }
}
