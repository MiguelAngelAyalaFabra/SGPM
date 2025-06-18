@extends('dashboard')

@section('title', 'tipo-planes')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Planes</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Listado de planes</li>
    </ol>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('tipo-planes.create') }}" class="btn btn-primary mb-3">Crear nuevo plan</a>
    </div>

    <div class="card mb-4 shadow">
        <div class="card-header">
            <i class="fa-solid fa-calendar-check me-1"></i>
            Planes Registrados
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-primary text-center">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Costo</th>
                        <th>Días por semana</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tipoPlanes as $tipoPlan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tipoPlan->tipo_plan }}</td>
                        <td class="text-center">${{ number_format($tipoPlan->costo, 0, ',', '.') }}</td>
                        <td class="text-center">{{ $tipoPlan->dias_semana }}</td>
                        <td class="text-center">
                            <a href="{{ route('tipo-planes.edit', $tipoPlan->id) }}"
                                class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('tipo-planes.destroy', $tipoPlan->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Estás seguro?')">Eliminar</button>
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
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('input[name="dias[]"]');
        const planSelect = document.getElementById('id_tipo_plan');

        if (!planSelect) return;

        function getMaxDias(planTexto) {
            if (planTexto.includes("3")) return 3;
            if (planTexto.includes("2")) return 2;
            return 5;
        }

        planSelect.addEventListener('change', function () {
            const planTexto = this.options[this.selectedIndex].text;
            const maxDias = getMaxDias(planTexto);

            checkboxes.forEach(cb => {
                cb.checked = false; // Reiniciar al cambiar el plan
                cb.addEventListener('change', function () {
                    const checkedCount = Array.from(checkboxes).filter(c => c.checked).length;
                    if (checkedCount > maxDias) {
                        this.checked = false;
                        alert("Este plan solo permite seleccionar hasta " + maxDias + " días.");
                    }
                });
            });
        });
    });
    </script>
    @endpush