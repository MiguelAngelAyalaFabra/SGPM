@extends('dashboard')

@section('title', 'Detalle del Alumno')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Detalle del Alumno</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('alumnos.index') }}">Alumnos</a></li>
        <li class="breadcrumb-item active">Detalle</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Información del Alumno
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Nombres:</dt>
                <dd class="col-sm-9">{{ $alumno->nombres }}</dd>

                <dt class="col-sm-3">Apellidos:</dt>
                <dd class="col-sm-9">{{ $alumno->apellidos }}</dd>

                <dt class="col-sm-3">Edad:</dt>
                <dd class="col-sm-9">{{ $alumno->edad }} años</dd>

                <dt class="col-sm-3">Colegio:</dt>
                <dd class="col-sm-9">{{ $alumno->colegio }}</dd>

                <dt class="col-sm-3">Grado:</dt>
                <dd class="col-sm-9">{{ $alumno->grado }}</dd>

                <dt class="col-sm-3">Tipo de Sangre:</dt>
                <dd class="col-sm-9">{{ $alumno->tipo_sangre ?? 'No especificado' }}</dd>

                <dt class="col-sm-3">Alergias:</dt>
                <dd class="col-sm-9">{{ $alumno->alergias ?? 'Ninguna' }}</dd>

                <dt class="col-sm-3">Contacto de Emergencia:</dt>
                <dd class="col-sm-9">{{ $alumno->contacto_emergencia ?? 'No especificado' }}</dd>
            </dl>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">
            Información del Acudiente
        </div>
        <div class="card-body">
            @if ($alumno->acudiente)
                <dl class="row">
                    <dt class="col-sm-3">Nombre:</dt>
                    <dd class="col-sm-9">{{ $alumno->acudiente->nombres }} {{ $alumno->acudiente->apellidos }}</dd>

                    <dt class="col-sm-3">Teléfono:</dt>
                    <dd class="col-sm-9">{{ $alumno->acudiente->telefono }}</dd>

                    <dt class="col-sm-3">Dirección:</dt>
                    <dd class="col-sm-9">{{ $alumno->acudiente->direccion }}</dd>   
                    

                </dl>
            @else
                <p>No se ha asignado acudiente.</p>
            @endif
        </div>
    </div>

    <a href="{{ route('alumnos.index') }}" class="btn btn-outline-primary">← Volver a la lista</a>
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