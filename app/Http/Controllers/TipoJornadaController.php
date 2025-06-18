<?php

namespace App\Http\Controllers;

use App\Models\TipoJornada;
use Illuminate\Http\Request;

class TipoJornadaController extends Controller
{
    public function index()
    {
        $tipoJornadas = TipoJornada::all();
        return view('tipo-jornadas.index', compact('tipoJornadas'));
    }

    public function create()
    {
        return view('tipo-jornadas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_jornada' => 'required|string|max:255',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
        ]);

        TipoJornada::create($request->all());

        return redirect()->route('tipo-jornadas.index')->with('success', 'Tipo de jornada creado correctamente.');
    }

    public function edit(TipoJornada $tipoJornada)
    {
        return view('tipo-jornadas.edit', compact('tipoJornada'));
    }

    public function update(Request $request, TipoJornada $tipoJornada)
    {
        $request->validate([
            'tipo_jornada' => 'required|string|max:255',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
        ]);

        $tipoJornada->update($request->all());

        return redirect()->route('tipo-jornadas.index')->with('success', 'Tipo de jornada actualizado correctamente.');
    }

    public function destroy(TipoJornada $tipoJornada)
    {
        $tipoJornada->delete();

        return redirect()->route('tipo-jornadas.index')->with('success', 'Tipo de jornada eliminado correctamente.');
    }
}
