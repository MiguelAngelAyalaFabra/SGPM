@extends('dashboard')
@section('title', 'CrearJornada')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Crear nuevo tipo de jornada</h1>
    <form action="{{ route('tipo-jornadas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="tipo_jornada" class="form-label">Nombre de la Jornada</label>
            <input type="text" id="tipo_jornada" name="tipo_jornada" class="form-control" required
                value="{{ old('tipo_jornada') }}">
            @error('tipo_jornada')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="hora_inicio" class="form-label">Hora de inicio</label>
            <input type="time" id="hora_inicio" name="hora_inicio" class="form-control" required
                value="{{ old('hora_inicio') }}">
            @error('hora_inicio')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="hora_fin" class="form-label">Hora de fin</label>
            <input type="time" id="hora_fin" name="hora_fin" class="form-control" required
                value="{{ old('hora_fin') }}">
            @error('hora_fin')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('tipo-jornadas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

@push('js')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bs5-toast@1.0.0/dist/bs5-toast.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/scripts.js') }}"></script>

@endpush