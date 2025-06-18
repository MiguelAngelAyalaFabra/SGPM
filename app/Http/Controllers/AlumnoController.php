<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Acudiente;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function index()
    {
        $alumnos = Alumno::with('acudiente')->orderBy('apellidos')->paginate(10);
        return view('alumnos.index', compact('alumnos'));
    }

    public function create()
    {
        $acudientes = Acudiente::all();
        return view('alumnos.create', compact('acudientes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'edad' => 'required|integer|min:1|max:17',
            'colegio' => 'required|string|max:100',
            'grado' => 'required|string|max:50',
            'tipo_sangre' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'alergias' => 'nullable|string|max:255',
            'contacto_emergencia' => 'nullable|string|max:20',
            'acudiente_id' => 'required|exists:acudientes,id',
        ], [
            'nombres.required' => 'El nombre es obligatorio.',
            'apellidos.required' => 'El apellido es obligatorio.',
            'edad.required' => 'La edad es obligatoria.',
            'edad.max' => 'La edad máxima permitida es 17 años.',
            'colegio.required' => 'El colegio es obligatorio.',
            'grado.required' => 'El grado es obligatorio.',
            'acudiente_id.required' => 'Debe seleccionar un acudiente.',
            'acudiente_id.exists' => 'El acudiente seleccionado no existe.',
        ]);

        $existe = Alumno::where('nombres', $request->nombres)
            ->where('apellidos', $request->apellidos)
            ->where('edad', $request->edad)
            ->exists();

        if ($existe) {
            return redirect()->back()
                ->withErrors(['duplicado' => 'Este alumno ya ha sido registrado.'])
                ->withInput();
        }

        Alumno::create($validated);

        return redirect()->route('alumnos.index')->with('success', 'Alumno registrado correctamente.');
    }

    public function show($id)
    {
        $alumno = Alumno::with('acudiente')->findOrFail($id);
        return view('alumnos.show', compact('alumno'));
    }

    public function edit($id)
    {
        $alumno = Alumno::findOrFail($id);
        $acudientes = Acudiente::all();
        return view('alumnos.edit', compact('alumno', 'acudientes'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'edad' => 'required|integer|min:1|max:17',
            'colegio' => 'required|string|max:100',
            'grado' => 'required|string|max:50',
            'tipo_sangre' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'alergias' => 'nullable|string|max:255',
            'contacto_emergencia' => 'nullable|string|max:20',
            'acudiente_id' => 'required|exists:acudientes,id',
        ], [
            'nombres.required' => 'El nombre es obligatorio.',
            'apellidos.required' => 'El apellido es obligatorio.',
            'edad.required' => 'La edad es obligatoria.',
            'edad.max' => 'La edad máxima permitida es 17 años.',
            'colegio.required' => 'El colegio es obligatorio.',
            'grado.required' => 'El grado es obligatorio.',
            'acudiente_id.required' => 'Debe seleccionar un acudiente.',
            'acudiente_id.exists' => 'El acudiente seleccionado no existe.',
        ]);

        $duplicado = Alumno::where('nombres', $request->nombres)
            ->where('apellidos', $request->apellidos)
            ->where('edad', $request->edad)
            ->where('id', '!=', $id)
            ->exists();

        if ($duplicado) {
            return redirect()->back()
                ->withErrors(['duplicado' => 'Ya existe otro alumno con estos datos.'])
                ->withInput();
        }

        $alumno = Alumno::findOrFail($id);

        $alumno->update($validated);

        return redirect()->route('alumnos.index')->with('success', 'Alumno actualizado correctamente.');
    }

    public function destroy($id)
    {
        $alumno = Alumno::findOrFail($id);
        $alumno->delete();

        return redirect()->route('alumnos.index')->with('success', 'Alumno eliminado correctamente.');
    }
}
