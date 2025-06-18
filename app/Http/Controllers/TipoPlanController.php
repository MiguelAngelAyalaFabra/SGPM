<?php

namespace App\Http\Controllers;

use App\Models\TipoPlan;
use Illuminate\Http\Request;

class TipoPlanController extends Controller
{
    public function index()
    {
        $tipoPlanes = TipoPlan::all();
        return view('tipo-planes.index', compact('tipoPlanes'));
    }

    public function create()
    {
        return view('tipo-planes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_plan' => 'required|string|max:255',
            'costo' => 'required|numeric|min:0',
            'dias_semana' => 'required|integer|min:1|max:5',
        ]);

        TipoPlan::create($request->all());

        return redirect()->route('tipo-planes.index')->with('success', 'Plan creado correctamente.');
    }

    public function edit(TipoPlan $tipoPlanes)
    {
        return view('tipo-planes.edit', compact('tipoPlanes'));
    }

    public function update(Request $request, TipoPlan $tipoPlanes)
    {
        $request->validate([
            'tipo_plan' => 'required|string|max:255',
            'costo' => 'required|numeric|min:0',
            'dias_semana' => 'required|integer|min:1|max:5',
        ]);

        $tipoPlanes->update($request->all());

        return redirect()->route('tipo-planes.index')->with('success', 'Plan actualizado correctamente.');
    }

    public function destroy(TipoPlan $tipoPlanes)
    {
        $tipoPlanes->delete();
        return redirect()->route('tipo-planes.index')->with('success', 'Plan eliminado correctamente.');
    }
}