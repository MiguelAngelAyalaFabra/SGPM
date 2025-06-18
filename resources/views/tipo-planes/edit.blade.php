@extends('dashboard')
@section('title', 'EditarPlan')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Editar plan</h1>
    <form action="{{ route('tipo-planes.update', ['tipoPlanes' => $tipoPlanes->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="tipo_plan" class="form-label">Nombre del Plan</label>
            <input type="text" id="tipo_plan" name="tipo_plan" class="form-control" value="{{ $tipoPlanes->tipo_plan }}" required>
        </div>
        <div class="mb-3">
            <label for="costo" class="form-label">Costo</label>
            <input type="number" id="costo" name="costo" class="form-control" value="{{ $tipoPlanes->costo }}" required>
        </div>
        <div class="mb-3">
            <label for="dias_semana" class="form-label">Días por semana</label>
            <input type="number" id="dias_semana" name="dias_semana" class="form-control" value="{{ $tipoPlanes->dias_semana }}" required>
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Guardar Plan</button>
            <a href="{{ route('tipo-planes.index') }}" class="btn btn-secondary">Cancelar</a>
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

@endpush