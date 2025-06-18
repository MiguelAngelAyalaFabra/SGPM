@extends('dashboard')
@section('title', 'Detalle de Matrícula')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Detalle de Matrícula</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('matriculas.index') }}">Matrículas</a></li>
        <li class="breadcrumb-item active">Detalle</li>
    </ol>

    <div class="card mb-4 shadow">
        <div class="card-header">
            <i class="fas fa-info-circle me-1"></i>
            Información de la Matrícula
        </div>
        <div class="card-body">
            <h5>Alumno</h5>
            <p><strong>Nombre:</strong> {{ $matricula->alumno->nombres }} {{ $matricula->alumno->apellidos }}</p>
            <p><strong>Edad:</strong> {{ $matricula->alumno->edad }}</p>
            <p><strong>Acudiente:</strong> {{ $matricula->alumno->acudiente->nombres ?? 'No asignado' }} {{ $matricula->alumno->acudiente->apellidos ?? '' }}</p>

            <hr>

            <h5>Detalles de la Matrícula</h5>
            <p><strong>Fecha de Matrícula:</strong> {{ \Carbon\Carbon::parse($matricula->fecha_matricula)->format('d/m/Y') }}</p>
            <p><strong>Plan:</strong> {{ $matricula->tipoPlan->tipo_plan }}</p>
            <p><strong>Jornada:</strong> {{ $matricula->tipoJornada->tipo_jornada }}</p>
            <p><strong>Descuento:</strong> 
                {{ $matricula->tipoDescuento ? $matricula->tipoDescuento->tipo_descuento . ' (' . $matricula->tipoDescuento->porcentaje . '%)' : 'Sin descuento' }}
            </p>
            <p><strong>Costo total:</strong> ${{ number_format($matricula->costo_total, 0, ',', '.') }}</p>

            <hr>

            <h5>Pagos y Saldo</h5>
            <p><strong>Total pagado:</strong> ${{ number_format($matricula->pagos->sum('monto_pagado'), 0, ',', '.') }}</p>
            <p><strong>Saldo pendiente:</strong> 
                @if($saldoPendiente > 0)
                    <span class="text-danger">${{ number_format($saldoPendiente, 0, ',', '.') }}</span>
                @else
                    <span class="text-success">Sin saldo pendiente</span>
                @endif
            </p>

            <hr>

            <h5>Días de Asistencia</h5>
            @if($matricula->dias->isEmpty())
                <p>No hay días registrados.</p>
            @else
                <ul>
                    @foreach($matricula->dias as $dia)
                        <li>{{ ucfirst($dia->dia) }}</li>
                    @endforeach
                </ul>
            @endif

            <a href="{{ route('matriculas.index') }}" class="btn btn-secondary mt-3">Volver</a>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bs5-toast@1.0.0/dist/bs5-toast.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/scripts.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Inicializar DataTable si existe el elemento
        const tableElement = document.querySelector("#dataTable");
        if (typeof DataTable !== "undefined" && tableElement) {
            new DataTable(tableElement);
        }

        // Mostrar Toast si existen los elementos
        const toastTrigger = document.getElementById('liveToastBtn');
        const toastLiveExample = document.getElementById('liveToast');

        if (toastTrigger && toastLiveExample) {
            const toast = new bootstrap.Toast(toastLiveExample);
            toastTrigger.addEventListener('click', () => {
                toast.show();
            });
        }
    });
</script>
@endpush