<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agenda = Agenda::all();
        return view('agenda.index', compact('agenda'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $agenda = new Agenda;
            $agenda->titulo = $request->titulo;
            $agenda->descricao = $request->descricao;
            $agenda->data = $request->data;

            $agenda->save();
            return redirect()->route('agenda.index')->with('message', 'Agendado com sucesso!');
        } catch (\Throwable $th) {
            session()->flash('message', 'Um erro ocorreu: ' . $th->getMessage());
            session()->flash('status', 'error');
            return redirect()->route('dashboard');
        }
    }

    public function delete()
    {
        $agenda = Agenda::all();
        return view('agenda.delete', compact('agenda'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $agenda = Agenda::find($id);
            $agenda->delete();
            return redirect()->route('agenda.delete')->with('message', 'Desmarcado com sucesso!');
        } catch (\Throwable $th) {
            session()->flash('message', 'Um erro ocorreu: ' . $th->getMessage());
            session()->flash('status', 'error');
            return redirect()->route('dashboard');
        }
    }
}
