<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('assets/brand/coreui.svg#full') }}"></use>
        </svg>
        <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('assets/brand/coreui.svg#signet') }}"></use>
        </svg>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
        <!-- Dashboard -->
        <li class="nav-item"><a class="nav-link" href="{{ route('employee.dashboard') }}">
            <x-coreui-icon class="nav-icon" icon="cil-home" />
            Dashboard<span class="badge badge-sm bg-info ms-auto">NEW</span></a></li>

        <!-- Profile Management -->
        <li class="nav-title">Profile Management</li>
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
            <x-coreui-icon class="nav-icon" icon="cil-user" />
            Profile </a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{ route('employee.profile.edit') }}">
                    <x-coreui-icon class="nav-icon" icon="cil-pencil" />
                    Edit</a></li>
            </ul>
        </li>

        <!-- Congé Section -->
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
            <x-coreui-icon class="nav-icon" icon="cil-calendar" />
            Congé </a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{ route('employee.demande_conge.create') }}">
                    <x-coreui-icon class="nav-icon" icon="cil-paper-plane" />
                    Demander un Congé</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('employee.demande_conge.index') }}">
                    <x-coreui-icon class="nav-icon" icon="cil-list" />
                    Liste des Congés</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('employee.demande_conge.store') }}">
                    <x-coreui-icon class="nav-icon" icon="cil-check-circle" />
                    Soumettre</a></li>
            </ul>
        </li>

        <!-- Prêts Section -->
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
            <x-coreui-icon class="nav-icon" icon="cil-credit-card" />
            Prêts </a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{ route('loans.create') }}">
                    <x-coreui-icon class="nav-icon" icon="cil-file" />
                    Faire une Demande</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('loans.index') }}">
                    <x-coreui-icon class="nav-icon" icon="cil-list-rich" />
                    Mes Prêts</a></li>
            </ul>
        </li>


      <!-- Fiches de Paie Section -->
<li class="nav-group">
    <a class="nav-link nav-group-toggle" href="#">
        <x-coreui-icon class="nav-icon" icon="cil-file" />
        Fiches de Paie
    </a>
    <ul class="nav-group-items">



        <li class="nav-item">
            <a class="nav-link" href="{{ route('fichepaie.salary', ['employeeId' => auth()->user()->employee->employee_id]) }}">
                <x-coreui-icon class="nav-icon" icon="cil-dollar" />
                Salaire Ajusté
            </a>
        </li>


    </ul>
</li>

                    
                       
                    <li class="nav-group">
                        <a class="nav-link nav-group-toggle" href="#">
                            <x-coreui-icon class="nav-icon" icon="cil-chart-line" />
                            Performance
                        </a>
                        <ul class="nav-group-items">
                            
                            <li class="nav-item"><a class="nav-link" href="{{ route('employee.performances.chart') }}">
                                    <x-coreui-icon class="nav-icon" icon="cil-graph" />
                                    Graphique de Performance
                                </a>
                            </li>
                        </ul>
                    </li>
                        


                        

        </ul>

        
    </li>





</div>
