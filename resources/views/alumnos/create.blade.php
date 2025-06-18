@extends('dashboard')
@section('title', 'Registrar Alumno')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Registrar Alumno</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Panel</a></li>
        <li class="breadcrumb-item active">Nuevo Alumno</li>
    </ol>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-user-graduate me-1"></i>
            Formulario de Registro de Alumno
        </div>
        <div class="card-body">
            <form action="{{ route('alumnos.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" name="nombres" id="nombres" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="edad" class="form-label">Edad</label>
                    <input type="number" name="edad" id="edad" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="colegio" class="form-label">Colegio</label>
                    <input type="text" class="form-control" id="colegio" name="colegio" value="{{ old('colegio') }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="grado" class="form-label">Grado</label>
                    <input type="text" class="form-control" id="grado" name="grado" value="{{ old('grado') }}" required>
                </div>
                                

                <div class="mb-3">
                    <label for="tipo_sangre" class="form-label">Tipo de Sangre</label>
                    <input type="text" name="tipo_sangre" id="tipo_sangre" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="alergias" class="form-label">Alergias o Padecimientos Médicos</label>
                    <textarea name="alergias" id="alergias" class="form-control" rows="2"></textarea>
                </div>

                <div class="mb-3">
                    <label for="contacto_emergencia" class="form-label">Contacto de Emergencia</label>
                    <input type="text" name="contacto_emergencia" id="contacto_emergencia" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="acudiente_id" class="form-label">Acudiente</label>
                    <select name="acudiente_id" id="acudiente_id" class="form-select" required>
                        <option value="">Seleccione un acudiente</option>
                        @foreach($acudientes as $acudiente)
                        <option value="{{ $acudiente->id }}">
                            {{ $acudiente->nombres }} {{ $acudiente->apellidos }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Registrar</button>
                <a href="{{ route('alumnos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
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