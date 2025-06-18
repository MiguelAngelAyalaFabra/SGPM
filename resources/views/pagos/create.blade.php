@extends('dashboard')

@section('title', 'Registrar Pago')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Registrar Pago</h1>

    <form action="{{ route('pagos.store') }}" method="POST" class="mt-4">
        @csrf

        <div class="mb-3">
            <label for="matricula_id" class="form-label">Matrícula</label>
            <select name="matricula_id" id="matricula_id" class="form-select" required>
                <option value="">Seleccione una matrícula</option>
                @foreach ($matriculas as $matricula)
                    <option value="{{ $matricula->id }}">
                        {{ $matricula->alumno->nombres }} {{ $matricula->alumno->apellidos }} - {{ $matricula->id }}
                    </option>
                @endforeach
            </select>
            @error('matricula_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="fecha_pago" class="form-label">Fecha de Pago</label>
            <input type="date" name="fecha_pago" id="fecha_pago" class="form-control" value="{{ old('fecha_pago') }}" required>
            @error('fecha_pago')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="monto_pagado" class="form-label">Monto Pagado</label>
            <input type="number" step="0.01" name="monto_pagado" id="monto_pagado" class="form-control" value="{{ old('monto_pagado') }}" required>
            @error('monto_pagado')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Registrar Pago</button>
        <a href="{{ route('pagos.index') }}" class="btn btn-secondary">Cancelar</a>
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