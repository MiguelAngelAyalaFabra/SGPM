@extends('dashboard')
@section('title', 'matriculas')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Matrículas Registradas</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Listado de Matrículas</li>
    </ol>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('matriculas.create') }}" class="btn btn-primary">Registrar Nueva Matrícula</a>
    </div>

    <div class="card mb-4 shadow">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Lista de Matrículas
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="dataTable">
                <thead class="table-primary text-center">
                    <tr>
                        <th>#</th>
                        <th>Alumno</th>
                        <th>Plan</th>
                        <th>Jornada</th>
                        <th>Descuento</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($matriculas as $matricula)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $matricula->alumno->nombres }} {{ $matricula->alumno->apellidos }}</td>
                        <td>{{ $matricula->tipoPlan->tipo_plan }}</td>
                        <td>{{ $matricula->tipoJornada->tipo_jornada }}</td>
                        <td>{{ $matricula->tipoDescuento->tipo_descuento ?? 'Ninguno' }}</td>
                        <td>{{ $matricula->fecha_matricula }}</td>
                        <td class="text-center">
                            <a href="{{ route('matriculas.show', $matricula->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('matriculas.edit', $matricula->id) }}"
                                class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('matriculas.destroy', $matricula->id) }}" method="POST"
                                class="d-inline" onsubmit="return confirm('¿Está seguro de eliminar esta matrícula?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3">
                {{ $matriculas->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
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