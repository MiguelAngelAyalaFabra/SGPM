<?php

namespace App\Http\Controllers;

use App\Models\Acudiente;
use Illuminate\Http\Request;

class AcudienteController extends Controller
{
    public function index()
    {
        $acudientes = Acudiente::all();
        return view('acudientes.index', compact('acudientes'));
    }

    public function create()
    {
        return view('acudientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
        ]);

        Acudiente::create($request->all());

        return redirect()->route('acudientes.index')->with('success', 'Acudiente registrado correctamente.');
    }

    public function show($id)
    {
        $acudiente = Acudiente::findOrFail($id);
        return view('acudientes.show', compact('acudiente'));
    }

    public function edit($id)
    {
        $acudiente = Acudiente::findOrFail($id);
        return view('acudientes.edit', compact('acudiente'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
        ]);

        $acudiente = Acudiente::findOrFail($id);
        $acudiente->update($request->all());

        return redirect()->route('acudientes.index')->with('success', 'Acudiente actualizado correctamente.');
    }

    public function destroy($id)
    {
        $acudiente = Acudiente::findOrFail($id);
        $acudiente->delete();

        return redirect()->route('acudientes.index')->with('success', 'Acudiente eliminado correctamente.');
    }
}
