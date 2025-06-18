<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Matricula;
use App\Models\Pago;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el mes seleccionado o el mes actual si no se especifica
        // Si el mes no se especifica, se usa el mes actual
        $mesSeleccionado = $request->input('mes') ?? now()->format('Y-m');
        $fecha = Carbon::createFromFormat('Y-m', $mesSeleccionado);

        // Total de estudiantes registrados
        $totalEstudiantes = Alumno::count();

        // Matrículas del mes seleccionado
        $matriculas = Matricula::with(['alumno', 'pagos'])
            ->whereMonth('fecha_matricula', $fecha->month)
            ->whereYear('fecha_matricula', $fecha->year)
            ->get();

        $hoy = Carbon::today();

        $matriculaAlDia = $matriculas->filter(function ($matricula) {
            $totalPagado = $matricula->pagos->sum('monto_pagado');
            return $totalPagado >= $matricula->costo_total;
        })->count();

        $porVencer = $matriculas->filter(function ($matricula) use ($hoy) {
            $vence = Carbon::parse($matricula->fecha_matricula)->addMonth();
            $diasRestantes = $hoy->diffInDays($vence, false);
            return $diasRestantes > 0 && $diasRestantes <= 5;
        })->count();

        $atrasadas = $matriculas->filter(function ($matricula) use ($hoy) {
            $vence = Carbon::parse($matricula->fecha_matricula)->addMonth();
            $totalPagado = $matricula->pagos->sum('monto_pagado');
            return $vence->isPast() && $totalPagado < $matricula->costo_total;
        })->count();

        $alumnosConSaldoPendiente = $matriculas->filter(function ($matricula) {
            return $matricula->costo_total > $matricula->pagos->sum('monto_pagado');
        })->map(function ($matricula) {
            return $matricula->alumno; // Asegúrate de tener la relación `alumno` en `Matricula`
        });

        $alumnos = Alumno::with('acudiente')->get();

        // 👇 Pagos del mes seleccionado
        $mesSeleccionado = $request->input('mes') ?? now()->format('Y-m');
        $fecha = Carbon::createFromFormat('Y-m', $mesSeleccionado);

        $pagosPorMes = Pago::whereMonth('fecha_pago', $fecha->month)
            ->whereYear('fecha_pago', $fecha->year)
            ->get();


        return view('panel.index', compact(
            'totalEstudiantes',
            'matriculaAlDia',
            'porVencer',
            'atrasadas',
            'alumnos',
            'pagosPorMes',
            'mesSeleccionado',
        ));
    }
}
