<?php

namespace App\Http\Controllers;

use App\Models\TipoDescuento;
use Illuminate\Http\Request;

class TipoDescuentoController extends Controller
{
    public function index()
    {
        $tipoDescuentos = TipoDescuento::all();
        return view('tipo-descuentos.index', compact('tipoDescuentos'));
    }

    public function create()
    {
        return view('tipo-descuentos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_descuento' => 'required|string|max:50',
            'porcentaje' => 'required|numeric|min:0|max:100',
        ]);

        TipoDescuento::create($request->only(['tipo_descuento', 'porcentaje']));

        return redirect()->route('tipo-descuentos.index')->with('success', 'Tipo de descuento creado correctamente.');
    }

    public function edit(TipoDescuento $tipoDescuento)
    {
        return view('tipo-descuentos.edit', compact('tipoDescuento'));
    }

    public function update(Request $request, TipoDescuento $tipoDescuento)
    {
        $request->validate([
            'tipo_descuento' => 'required|string|max:50',
            'porcentaje' => 'required|numeric|min:0|max:100',
        ]);

        $tipoDescuento->update($request->only(['tipo_descuento', 'porcentaje']));

        return redirect()->route('tipo-descuentos.index')->with('success', 'Tipo de descuento actualizado correctamente.');
    }

    public function destroy(TipoDescuento $tipoDescuento)
    {
        $tipoDescuento->delete();
        return redirect()->route('tipo-descuentos.index')->with('success', 'Tipo de descuento eliminado correctamente.');
    }
}
