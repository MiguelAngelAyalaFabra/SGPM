<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Matricula;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function index()
    {
        $pagos = Pago::with('matricula.alumno.acudiente')->latest()->get();

        $totalPagado = $pagos->sum('monto_pagado');
        $cantidadPagos = $pagos->count();

        return view('pagos.index', compact('pagos', 'totalPagado', 'cantidadPagos'));
    }

    public function create()
    {
        $matriculas = Matricula::with('alumno')->get();
        return view('pagos.create', compact('matriculas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'matricula_id' => 'required|exists:matriculas,id',
            'fecha_pago' => 'required|date',
            'monto_pagado' => 'required|numeric',
        ]);

        Pago::create([
            'matricula_id' => $request->matricula_id,
            'fecha_pago' => $request->fecha_pago,
            'monto_pagado' => $request->monto_pagado,
        ]);

        return redirect()->route('pagos.index')->with('success', 'Pago registrado correctamente');
    }
}
