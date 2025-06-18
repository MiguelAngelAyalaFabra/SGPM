<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\Alumno;
use App\Models\TipoPlan;
use App\Models\TipoJornada;
use App\Models\TipoDescuento;
use App\Models\MatriculaDia;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    public function index()
    {
        $matriculas = Matricula::with(['alumno', 'tipoPlan', 'tipoJornada', 'tipoDescuento'])->paginate(10);
        return view('matriculas.index', compact('matriculas'));
    }

    public function create()
    {
        $alumnos = Alumno::with('acudiente')->get();
        $planes = TipoPlan::all();
        $jornadas = TipoJornada::all();
        $descuentos = TipoDescuento::all();

        return view('matriculas.create', compact('alumnos', 'planes', 'jornadas', 'descuentos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'tipo_plan_id' => 'required|exists:tipo_planes,id',
            'tipo_jornada_id' => 'required|exists:tipo_jornadas,id',
            'fecha_matricula' => 'required|date',
            'dias_asistencia' => 'required|array|min:1',
        ]);

        $plan = TipoPlan::findOrFail($request->tipo_plan_id);
        $costo = $plan->costo;

        // Aplicar descuento si hay
        if ($request->filled('tipo_descuento_id')) {
            $descuento = TipoDescuento::find($request->tipo_descuento_id);
            $costo -= $costo * ($descuento->porcentaje / 100);
        }

        $matricula = Matricula::create([
            'alumno_id' => $request->alumno_id,
            'tipo_plan_id' => $request->tipo_plan_id,
            'tipo_jornada_id' => $request->tipo_jornada_id,
            'tipo_descuento_id' => $request->tipo_descuento_id,
            'fecha_matricula' => $request->fecha_matricula,
            'costo_total' => $costo,
        ]);

        // Guardar los días de asistencia
        foreach ($request->dias_asistencia as $dia) {
            MatriculaDia::create([
                'matricula_id' => $matricula->id,
                'dia' => $dia
            ]);
        }

        return redirect()->route('matriculas.index')->with('success', 'Matrícula registrada exitosamente.');
    }

    public function edit(Matricula $matricula)
    {
        $alumnos = Alumno::all();
        $planes = TipoPlan::all();
        $jornadas = TipoJornada::all();
        $descuentos = TipoDescuento::all();

        return view('matriculas.edit', compact('matricula', 'alumnos', 'planes', 'jornadas', 'descuentos'));
    }

    public function update(Request $request, Matricula $matricula)
    {
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'tipo_plan_id' => 'required|exists:tipo_planes,id',
            'tipo_jornada_id' => 'required|exists:tipo_jornadas,id',
            'fecha_matricula' => 'required|date',
            'tipo_descuento_id' => 'nullable|exists:tipo_descuentos,id',
        ]);

        $matricula->update([
            'alumno_id' => $request->alumno_id,
            'tipo_plan_id' => $request->tipo_plan_id,
            'tipo_jornada_id' => $request->tipo_jornada_id,
            'tipo_descuento_id' => $request->tipo_descuento_id,
            'fecha_matricula' => $request->fecha_matricula,
            // 'activo' eliminado porque ya no existe en la BD
        ]);

        return redirect()->route('matriculas.index')->with('success', 'Matrícula actualizada correctamente.');
    }

    public function show(Matricula $matricula)
    {
        $matricula->load(['alumno.acudiente', 'tipoPlan', 'tipoJornada', 'tipoDescuento', 'dias', 'pagos']);

        // Calcular saldo pendiente usando el método que agregaste en el modelo
        $saldoPendiente = $matricula->saldoPendiente();

        return view('matriculas.show', compact('matricula', 'saldoPendiente'));
    }

    public function destroy(Matricula $matricula)
    {
        $matricula->delete();

        return redirect()->route('matriculas.index')->with('success', 'Matrícula eliminada correctamente.');
    }
}
