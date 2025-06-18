@extends('dashboard')
@section('title', 'Editar Matrícula')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Editar Matrícula</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('matriculas.index') }}">Matrículas</a></li>
        <li class="breadcrumb-item active">Editar</li>
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

    <form action="{{ route('matriculas.update', $matricula->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card shadow mb-4">
            <div class="card-header">
                <strong>Datos de Matrícula</strong>
            </div>
            <div class="card-body row g-3">

                <div class="col-md-6">
                    <label for="alumno_id" class="form-label">Alumno</label>
                    <select class="form-select" id="alumno_id" name="alumno_id" required>
                        @foreach($alumnos as $alumno)
                            <option value="{{ $alumno->id }}" {{ $matricula->alumno_id == $alumno->id ? 'selected' : '' }}>
                                {{ $alumno->nombres }} {{ $alumno->apellidos }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="tipo_plan_id" class="form-label">Tipo de Plan</label>
                    <select class="form-select" id="tipo_plan_id" name="tipo_plan_id" required>
                        @foreach($planes as $plan)
                            <option value="{{ $plan->id }}" {{ $matricula->tipo_plan_id == $plan->id ? 'selected' : '' }}>
                                {{ $plan->tipo_plan }} - ${{ number_format($plan->costo, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="tipo_jornada_id" class="form-label">Jornada</label>
                    <select class="form-select" id="tipo_jornada_id" name="tipo_jornada_id" required>
                        @foreach($jornadas as $jornada)
                            <option value="{{ $jornada->id }}" {{ $matricula->tipo_jornada_id == $jornada->id ? 'selected' : '' }}>
                                {{ $jornada->tipo_jornada }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="tipo_descuento_id" class="form-label">Descuento (opcional)</label>
                    <select class="form-select" id="tipo_descuento_id" name="tipo_descuento_id">
                        <option value="">Sin descuento</option>
                        @foreach($descuentos as $descuento)
                            <option value="{{ $descuento->id }}" {{ $matricula->tipo_descuento_id == $descuento->id ? 'selected' : '' }}>
                                {{ $descuento->tipo_descuento }} - {{ $descuento->porcentaje }}%
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="fecha_matricula" class="form-label">Fecha de Matrícula</label>
                    <input type="date" class="form-control" id="fecha_matricula" name="fecha_matricula" value="{{ $matricula->fecha_matricula->format('Y-m-d') }}" required>
                </div>

            </div>

            <div class="card-footer text-end">
                <a href="{{ route('matriculas.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
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