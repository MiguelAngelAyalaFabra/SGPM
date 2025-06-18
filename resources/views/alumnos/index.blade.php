@extends('dashboard')
@section('title', 'alumnos')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Alumnos Registrados</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Listado de Acudientes</li>
    </ol>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('alumnos.create') }}" class="btn btn-primary">Registrar Nuevo Alumno</a>
    </div>

    <div class="card mb-4 shadow">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Lista de Alumnos
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-primary text-center">
                        <tr>
                            <th>#</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Edad</th>
                            <th>Acudiente</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alumnos as $alumno)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $alumno->nombres }}</td>
                                <td>{{ $alumno->apellidos }}</td>
                                <td>{{ $alumno->edad }}</td>
                                <td>
                                    @if($alumno->acudiente)
                                        {{ $alumno->acudiente->nombres }} {{ $alumno->acudiente->apellidos }}
                                    @else
                                        No asignado
                                    @endif
                                </td>
                                
                                
                                <td>
                                    <a href="{{ route('alumnos.show', $alumno->id) }}" class="btn btn-info btn-sm">Ver</a>
                                    <a href="{{ route('alumnos.edit', $alumno->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('¿Está seguro de eliminar este alumno?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            <!-- Agrega la paginación aquí -->
            <div class="mt-3">
                {{ $alumnos->links('pagination::bootstrap-5') }}
            </div>
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
