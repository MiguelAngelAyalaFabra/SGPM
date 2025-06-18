@extends('dashboard')

@section('title', 'Pagos')

@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" />
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Pagos</h1>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row mb-3">
        <div class="col">
            <a href="{{ route('pagos.create') }}" class="btn btn-primary">Registrar Pago</a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Total Recaudado</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h5 class="text-white">${{ number_format($totalPagado, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Cantidad de Pagos</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h5 class="text-white">{{ $cantidadPagos }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-table me-1"></i>Listado de Pagos</div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Alumno</th>
                        <th>Acudiente</th>
                        <th>Fecha de Pago</th>
                        <th>Monto Pagado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pagos as $pago)
                    <tr>
                        <td>{{ $pago->id }}</td>
                        <td>{{ $pago->matricula->alumno->nombres }} {{ $pago->matricula->alumno->apellidos }}</td>
                        <td>{{ $pago->matricula->alumno->acudiente->nombres }} {{ $pago->matricula->alumno->acudiente->apellidos }}</td>
                        <td>{{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</td>
                        <td>${{ number_format($pago->monto_pagado, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
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
