@extends('dashboard')
@section('title', 'Registrar Matrícula')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Registrar Nueva Matrícula</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('matriculas.index') }}">Matrículas</a></li>
        <li class="breadcrumb-item active">Registrar</li>
    </ol>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('matriculas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="alumno_id" class="form-label">Alumno</label>
            <select name="alumno_id" id="alumno_id" class="form-select" required>
                <option value="">Seleccione un alumno</option>
                @foreach($alumnos as $alumno)
                    <option value="{{ $alumno->id }}">
                        {{ $alumno->nombres }} {{ $alumno->apellidos }} 
                        - ({{ $alumno->acudiente->nombres ?? 'Sin acudiente' }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tipo_plan_id" class="form-label">Tipo de Plan</label>
            <select name="tipo_plan_id" id="tipo_plan_id" class="form-select" required>
                <option value="">Seleccione un plan</option>
                @foreach($planes as $plan)
                    <option value="{{ $plan->id }}">{{ $plan->tipo_plan }} - ${{ number_format($plan->costo, 0, ',', '.') }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tipo_jornada_id" class="form-label">Jornada</label>
            <select name="tipo_jornada_id" id="tipo_jornada_id" class="form-select" required>
            <option value="">Seleccione una jornada</option>
            @foreach($jornadas as $jornada)
                <option value="{{ $jornada->id }}">
                {{ $jornada->tipo_jornada }} - {{ \Carbon\Carbon::parse($jornada->hora_inicio)->format('H:i') }} a {{ \Carbon\Carbon::parse($jornada->hora_fin)->format('H:i') }}
                </option>
            @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tipo_descuento_id" class="form-label">Descuento (opcional)</label>
            <select name="tipo_descuento_id" id="tipo_descuento_id" class="form-select">
                <option value="">Sin descuento</option>
                @foreach($descuentos as $descuento)
                    <option value="{{ $descuento->id }}">{{ $descuento->tipo_descuento }} ({{ $descuento->porcentaje }}%)</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha_matricula" class="form-label">Fecha de Matrícula</label>
            <input type="date" name="fecha_matricula" id="fecha_matricula" class="form-control" value="{{ date('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label for="fecha_matricula" class="form-label">Días de Asistencia</label><br>
            @php
                $diasSemana = ['lunes', 'martes', 'miércoles', 'jueves', 'viernes'];
            @endphp
            @foreach($diasSemana as $dia)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="dias_asistencia[]" value="{{ $dia }}" id="{{ $dia }}">
                    <label class="form-check-label" for="{{ $dia }}">{{ ucfirst($dia) }}</label>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-success">Registrar Matrícula</button>
        <a href="{{ route('matriculas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
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