@extends('dashboard')
@section('title', 'dashboard')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
@endpush
@php
use App\Models\Matricula;

$saldosPendientes = Matricula::all()->sum(function ($matricula) {
$totalPagado = $matricula->pagos->sum('monto_pagado');
return max(0, $matricula->costo_total - $totalPagado);
});
@endphp

@section('content')
<div class="container-fluid px-4 align-items-center">
    <h1 class="mt-4">Panel principal</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Gestiona tu negocio de manera fácil y sencilla.</li>
    </ol>

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    Estudiantes Registrados: {{ \App\Models\Alumno::count() }}
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('alumnos.index') }}">Ver detalles</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    Total Recaudado: ${{ number_format(\App\Models\Pago::sum('monto_pagado'), 0) }}
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('pagos.index') }}">Ver detalles</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    Saldos Pendientes: ${{ number_format($saldosPendientes, 0) }}
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#" data-bs-toggle="modal" data-bs-target="#saldosPendientesModal">Ver detalles</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        
    </div>

    <!-- Tabla de Estudiantes -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Estudiantes Registrados
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Edad</th>
                        <th>Acudiente</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Edad</th>
                        <th>Acudiente</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach(\App\Models\Alumno::all() as $alumno)
                    <tr>
                        <td>{{ $alumno->nombres }}</td>
                        <td>{{ $alumno->apellidos }}</td>
                        <td>{{ $alumno->edad }}</td>
                        <td>{{ $alumno->acudiente['nombres'] ?? 'N/A' }} {{ $alumno->acudiente['apellidos'] ?? '' }}
                        </td>
                        <td>
                            <a href="{{ route('alumnos.show', $alumno->id) }}" class="btn btn-info btn-sm">Ver</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Gráfica de Pagos -->

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 shadow">
                <div>
                    <form method="GET" action="{{ route('dashboard') }}" class="mb-4 d-flex gap-3 align-items-center">
                        <label for="mes" class="mb-3 fw-semibold">Pagos por mes:</label>
                        <input type="month" name="mes" id="mes" class="form-control"
                            value="{{ request('mes', $mesSeleccionado ?? now()->format('Y-m')) }}" required>
                        <button type="submit" class="btn btn-sm btn-primary">Filtrar</button>
                    </form>
                </div>
                <div class="card-header d-flex justify-content-between align-items-center">
                    @php
                    use Carbon\Carbon;
                    $mesNombre = Carbon::createFromFormat('Y-m', $mesSeleccionado)->translatedFormat('F Y');
                    @endphp
                    <div>
                        <i class="fas fa-chart-line me-2"></i> Estadísticas de Pagos - {{ ucfirst($mesNombre) }}
                    </div>

                    <div class="text-end small text-muted">
                        Última actualización: {{ now()->format('d/m/Y H:i') }}
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3 d-flex flex-wrap gap-3">
                        <div class="bg-light rounded p-3 text-center shadow-sm flex-fill">
                            <div class="fw-bold">Total Recaudado</div>
                            <div class="fs-5 text-success">${{ number_format($pagosPorMes->sum('monto_pagado'), 0) }}
                            </div>
                        </div>
                        <div class="bg-light rounded p-3 text-center shadow-sm flex-fill">
                            <div class="fw-bold">Número de Pagos</div>
                            <div class="fs-5 text-primary">{{ $pagosPorMes->count() }}</div>
                        </div>
                        <div class="bg-light rounded p-3 text-center shadow-sm flex-fill">
                            <div class="fw-bold">Promedio por Pago</div>
                            <div class="fs-5 text-warning">
                                ${{ number_format($pagosPorMes->avg('monto_pagado'), 0) }}
                            </div>
                        </div>
                    </div>

                    <div class="chart-container" style="position: relative; height: 400px;">
                        <canvas id="paymentStatisticsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal de Saldos Pendientes -->
<div class="modal fade" id="saldosPendientesModal" tabindex="-1" aria-labelledby="saldosPendientesLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alumnos con Saldo Pendiente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="buscarAlumno" class="form-control mb-3" placeholder="Buscar alumno por nombre...">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="tablaSaldosPendientes">
                        <thead class="table-light">
                            <tr>
                                <th>Alumno</th>
                                <th>Fecha Matrícula</th>
                                <th>Costo Total</th>
                                <th>Total Pagado</th>
                                <th>Saldo Pendiente</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Matricula::with('alumno', 'pagos')->get() as $matricula)
                                @php
                                    $totalPagado = $matricula->pagos->sum('monto_pagado');
                                    $saldo = $matricula->costo_total - $totalPagado;
                                @endphp
                                @if($saldo > 0)
                                <tr>
                                    <td>{{ $matricula->alumno->nombres }} {{ $matricula->alumno->apellidos }}</td>
                                    <td>{{ $matricula->fecha_matricula->format('d/m/Y') }}</td>
                                    <td>${{ number_format($matricula->costo_total, 0) }}</td>
                                    <td>${{ number_format($totalPagado, 0) }}</td>
                                    <td class="text-danger fw-bold">${{ number_format($saldo, 0) }}</td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')
<!-- Bootstrap y scripts generales -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="{{ asset('js/scripts.js') }}"></script>

<!-- Chart.js v4 -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<!-- Simple DataTables -->
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
    crossorigin="anonymous"></script>

<!-- Inicializar tabla -->
@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('paymentStatisticsChart').getContext('2d');
    
        const labels = [
            @php
    $estadisticas = $pagosPorMes->groupBy(function($pago) {
        return \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m');
    })->map(function ($grupo) {
        return [
            'monto_total' => $grupo->sum('monto_pagado'),
        ];
    });
    echo $estadisticas->keys()->map(fn($fecha) => "'$fecha'")->join(',');
@endphp

        ];
    
        const montoTotalData = [
            @php
                echo $estadisticas->map(fn($data) => $data['monto_total'])->join(',');
            @endphp
        ];
    
        // Línea plana de total mensual (repite el total para que tenga el mismo largo que los días)
        const totalMensual = {{ $pagosPorMes->sum('monto_pagado') }};
        const lineaTotalMensual = Array(labels.length).fill(totalMensual);
    
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Recaudación diaria ($)',
                        data: montoTotalData,
                        fill: true,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        tension: 0.3,
                        pointRadius: 5,
                        pointHoverRadius: 8
                    },
                    {
                        label: 'Recaudación mensual total ($)',
                        data: lineaTotalMensual,
                        borderColor: 'rgba(255, 99, 132, 0.8)',
                        borderDash: [10, 5],
                        pointRadius: 5,
                        tension: 0,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `$ ${context.parsed.y}`;
                            }
                        }
                    },
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + value;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputBuscar = document.getElementById('buscarAlumno');
        const tabla = document.getElementById('tablaSaldosPendientes').getElementsByTagName('tbody')[0];

        inputBuscar.addEventListener('keyup', function () {
            const filtro = this.value.toLowerCase();
            Array.from(tabla.rows).forEach(fila => {
                const texto = fila.cells[0].textContent.toLowerCase();
                fila.style.display = texto.includes(filtro) ? '' : 'none';
            });
        });
    });
</script>

@endpush

<!-- Fin de los scripts -->