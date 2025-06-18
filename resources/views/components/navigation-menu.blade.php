<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Inicio</div>
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Panel
                </a>
                
                <div class="sb-sidenav-menu-heading">MODULOS</div>
                <a class="nav-link" href="{{ url('acudientes') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                    Acudientes
                </a>
                <a class="nav-link" href="{{ url('alumnos') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                    Alumnos
                </a>
                <a class="nav-link" href="{{ url('matriculas') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-school"></i></div>
                    Matriculas
                </a>
                <a class="nav-link" href="{{ url('pagos') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-hand-holding-usd"></i></div>
                    Pagos
                </a>
                {{-- <a class="nav-link" href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
                    Estadísticas
                </a> --}}
                <div class="sb-sidenav-menu-heading">GESTIÓN</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                    aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-plus"></i></div>
                    Crear
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ url('tipo-planes') }}">Plan</a>
                        <a class="nav-link" href="{{ url('tipo-jornadas') }}">Jornada</a>
                        <a class="nav-link" href="{{ url('tipo-descuentos') }}">Descuento</a>
                    </nav>
                </div>  
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Usuario de la sesión:</div>
            {{ Auth::user()->name }}
        </div>
    </nav>
</div>