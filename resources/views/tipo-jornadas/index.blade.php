@extends('dashboard')
@section('title', 'jornadas')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tipos de Jornada</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Listado de jornadas</li>
    </ol>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-4">
        <a href="{{ route('tipo-jornadas.create') }}" class="btn btn-primary">Crear nuevo tipo de jornada</a>
    </div>

    <div class="card mb-4 shadow">
        <div class="card-header">
            <i class="fa-solid fa-clock me-1"></i>
            Jornadas Registradas
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-primary text-center">
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Tipo de Jornada</th>
                        <th>Hora inicio</th>
                        <th>Hora fin</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tipoJornadas as $jornada)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $jornada->id }}</td>
                        <td>{{ $jornada->tipo_jornada }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($jornada->hora_inicio)->format('H:i') }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($jornada->hora_fin)->format('H:i') }}</td>
                        <td class="text-center">
                            <a href="{{ route('tipo-jornadas.edit', $jornada->id) }}"
                                class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('tipo-jornadas.destroy', $jornada->id) }}" method="POST"
                                style="display:inline-block;"
                                onsubmit="return confirm('¿Seguro que deseas eliminar este tipo de jornada?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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