<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    public function create() {
        $tags = Tag::all();

        return view('tags.create', compact('tags'));
    }

    public function store(Request $request) {
        $tag = new Tag;
        $tag->name = $request->name;

        $tag->save();

        return view('tags.create', compact('tags'))->with('message', 'Tag criada com sucesso');
    }

    public function destroy(Tag $tag) {
        $tag->delete();
        $tags = Tag::all();

        return view('tags.create', compact('tags'))->with('message', 'Tag deletada com sucesso');
    }
}
