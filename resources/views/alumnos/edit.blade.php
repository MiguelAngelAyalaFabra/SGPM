@extends('dashboard')

@section('title', 'Editar Alumno')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Editar Alumno</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('alumnos.index') }}">Alumnos</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Hay algunos problemas con tu entrada.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('alumnos.update', $alumno->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Datos del Alumno
            </div>
            <div class="card-body row">
                <div class="col-md-6 mb-3">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" id="nombres" name="nombres" value="{{ old('nombres', $alumno->nombres) }}" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" id="apellidos" name="apellidos" value="{{ old('apellidos', $alumno->apellidos) }}" class="form-control" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="edad" class="form-label">Edad</label>
                    <input type="number" id="edad" name="edad" value="{{ old('edad', $alumno->edad) }}" class="form-control" required min="1" max="20">
                </div>

                <div class="col-md-5 mb-3">
                    <label for="colegio" class="form-label">Colegio</label>
                    <input type="text" id="colegio" name="colegio" value="{{ old('colegio', $alumno->colegio) }}" class="form-control" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="grado" class="form-label">Grado</label>
                    <input type="text" id="grado" name="grado" value="{{ old('grado', $alumno->grado) }}" class="form-control" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="tipo_sangre" class="form-label">Tipo de Sangre</label>
                    <input type="text" id="tipo_sangre" name="tipo_sangre" value="{{ old('tipo_sangre', $alumno->tipo_sangre) }}" class="form-control">
                </div>

                <div class="col-md-8 mb-3">
                    <label for="alergias" class="form-label">Alergias o padecimientos médicos</label>
                    <input type="text" id="alergias" name="alergias" value="{{ old('alergias', $alumno->alergias) }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="contacto_emergencia" class="form-label">Teléfono de contacto de emergencia</label>
                    <input type="text" id="contacto_emergencia" name="contacto_emergencia" value="{{ old('contacto_emergencia', $alumno->contacto_emergencia) }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="acudiente_id" class="form-label">Acudiente</label>
                    <select id="acudiente_id" name="acudiente_id" class="form-select" required>
                        <option value="">-- Seleccione un acudiente --</option>
                        @foreach($acudientes as $acudiente)
                            <option value="{{ $acudiente->id }}" {{ old('acudiente_id', $alumno->acudiente_id) == $acudiente->id ? 'selected' : '' }}>
                                {{ $acudiente->nombres }} {{ $acudiente->apellidos }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('alumnos.index') }}" class="btn btn-outline-secondary">← Cancelar</a>
            <button type="submit" class="btn btn-success">Actualizar Alumno</button>
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