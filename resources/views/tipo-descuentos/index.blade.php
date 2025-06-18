@extends('dashboard')
@section('title', 'Descuentos')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tipos de Descuento</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Listado de descuentos</li>
    </ol>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-4">
        <a href="{{ route('tipo-descuentos.create') }}" class="btn btn-primary">Crear nuevo tipo de descuento</a>
    </div>

    <div class="card mb-4 shadow">
        <div class="card-header">
            <i class="fa-solid fa-percent me-1"></i>
            Descuentos Registrados
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-primary text-center">
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Tipo de Descuento</th>
                        <th>Porcentaje (%)</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tipoDescuentos as $descuento)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $descuento->id }}</td>
                        <td>{{ $descuento->tipo_descuento }}</td>
                        <td class="text-center">{{ $descuento->porcentaje }}%</td>
                        <td class="text-center">
                            <a href="{{ route('tipo-descuentos.edit', $descuento->id) }}"
                                class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('tipo-descuentos.destroy', $descuento->id) }}" method="POST"
                                style="display:inline-block;"
                                onsubmit="return confirm('¿Seguro que deseas eliminar este descuento?');">
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
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bs5-toast@1.0.0/dist/bs5-toast.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/scripts.js') }}"></script>

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