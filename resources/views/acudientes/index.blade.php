@extends('dashboard')
@section('title', 'acudientes')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Acudientes</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Listado de Acudientes</li>
    </ol>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-4">
        <a href="{{ route('acudientes.create') }}" class="btn btn-primary">Agregar Acudiente</a>
    </div>

    <div class="card mb-4 shadow">
        <div class="card-header">
            <i class="fas fa-users me-1"></i>
            Acudientes Registrados
        </div>
        <div class="card-body">
            <table id="dataTable" class="table table-bordered table-striped table-hover">
                <thead class="table-primary text-center">
                    <tr>
                        <th>#</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($acudientes as $acudiente)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $acudiente->nombres }}</td>
                        <td>{{ $acudiente->apellidos }}</td>
                        <td>{{ $acudiente->telefono }}</td>
                        <td>{{ $acudiente->direccion }}</td>
                        <td class="text-center">
                            <a href="{{ route('acudientes.edit', $acudiente->id) }}"
                                class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('acudientes.destroy', $acudiente->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Estás seguro de eliminar este acudiente?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay acudientes registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
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