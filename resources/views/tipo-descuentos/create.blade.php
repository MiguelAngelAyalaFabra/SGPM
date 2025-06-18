@extends('dashboard')
@section('title', 'Crear Tipo de Descuento')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Crear Tipo de Descuento</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('tipo-descuentos.index') }}">Tipos de Descuento</a></li>
        <li class="breadcrumb-item active">Crear</li>
    </ol>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header">
            <i class="fa-solid fa-percent me-1"></i> Nuevo Tipo de Descuento
        </div>
        <div class="card-body">
            <form action="{{ route('tipo-descuentos.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="tipo_descuento" class="form-label">Nombre del Descuento</label>
                    <input type="text" class="form-control" id="tipo_descuento" name="tipo_descuento" value="{{ old('tipo_descuento') }}" required>
                </div>

                <div class="mb-3">
                    <label for="porcentaje" class="form-label">Porcentaje (%)</label>
                    <input type="number" class="form-control" id="porcentaje" name="porcentaje" value="{{ old('porcentaje') }}" step="0.01" min="0" max="100" required>
                </div>

                <a href="{{ route('tipo-descuentos.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
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