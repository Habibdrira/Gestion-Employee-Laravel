<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar" style="background-color: #00192f;">
    <div class="sidebar-brand d-none d-md-flex">
        <!-- Ajout de l'image PNG -->
        <img 
            src="{{ asset('assets/img/1.png') }}" 
            alt="Logo BD" 
            class="sidebar-brand-full" 
            width="200" 
            height="100" 
            style="object-fit: contain;"
        >
    </div>
    
    <style>
        .sidebar {
            background-color: #00192f;
        }

        .sidebar-nav .nav-link {
            background-color: transparent;
            color: #ffffff;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .sidebar-nav .nav-link:hover,
        .sidebar-nav .nav-link:focus,
        .sidebar-nav .nav-link.active {
            background-color: #002d47; /* Couleur survolée ou active */
            color: #ffffff;
        }

        .sidebar-nav .nav-group-toggle {
            color: #ffffff;
            background-color: transparent;
        }

        .sidebar-nav .nav-group-toggle:hover {
            background-color: #002d47;
        }

        .sidebar-brand img {
            margin: 0 auto;
        }
    </style>

    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>

        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('employee.dashboard') }}">
                <x-coreui-icon class="nav-icon" icon="cil-speedometer" />
                Dashboard
                <span class="badge badge-sm bg-info ms-auto">NEW</span>
            </a>
        </li>

        <!-- Employee Management -->
        <li class="nav-title">BesideYou </li>



                <!-- Congé Section -->
                <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <x-coreui-icon class="nav-icon" icon="cil-calendar" />
                    Congé </a>
                    <ul class="nav-group-items">
                        <li class="nav-item"><a class="nav-link" href="{{ route('employee.demande_conge.create') }}">
                            <x-coreui-icon class="nav-icon" icon="cil-list" />  Demander un Congé</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('employee.demande_conge.index') }}">
                            <x-coreui-icon class="nav-icon" icon="cil-user-follow" />
                            Liste des Congés</a></li>
                    </ul>
                </li>


                <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <x-coreui-icon class="nav-icon" icon="cil-briefcase" />
                    Missions Locales </a>
                    <ul class="nav-group-items">
                        <li class="nav-item"><a class="nav-link" href="{{ route('local_missions.index') }}">
                            <x-coreui-icon class="nav-icon" icon="cil-ban" />
                            Demander une mission locale</a></li>
                    </ul>
                </li>

                <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <x-coreui-icon class="nav-icon" icon="cil-globe-alt" />
                    Missions Internationales </a>
                    <ul class="nav-group-items">
                        <li class="nav-item"><a class="nav-link" href="{{ route('missions.international.user.index') }}">
                                <x-coreui-icon class="nav-icon" icon="cil-pen" />
                                Demander une mission internationale</a></li>
                    </ul>
                </li>

        <!-- pretes  Management -->
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <x-coreui-icon class="nav-icon" icon="cil-ban" />
                Prêts
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('loans.create') }}">
                        <x-coreui-icon class="nav-icon" icon="cil-plus" />
                        Faire une Demand
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{ route('loans.index') }}">
                        <x-coreui-icon class="nav-icon" icon="cil-list" />
                        Mes Prêts
                    </a>
                </li>
            </ul>
        </li>

              <!-- Fiches de Paie Section -->
<li class="nav-group">
    <a class="nav-link nav-group-toggle" href="#">
        <x-coreui-icon class="nav-icon" icon="cil-file" />
        Fiches de Paie
    </a>
    <ul class="nav-group-items">


        <li class="nav-item"><a class="nav-link" href="{{ route('employee.fichepaie.index') }}">
            <x-coreui-icon class="nav-icon" icon="cil-pen" />
            Mes Fiches de Paie</a></li>
        <li class="nav-item">
            
            <a class="nav-link" href="{{ route('employee.fichepaie.salary', ['employeeId' => auth()->user()->employee->employee_id]) }}">
                <x-coreui-icon class="nav-icon" icon="cil-dollar" />
                Salaire 
            </a>
        </li> 
        
        

    </ul>
</li>

        <!-- Performance Management -->
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <x-coreui-icon class="nav-icon" icon="cil-chart-line" />
                Performance 
            </a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{ route('employee.performance.index') }}">
                        <x-coreui-icon class="nav-icon" icon="cil-pen" />
                        consulter</a></li>
            </ul>
          
        </li>

        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
            <x-coreui-icon class="nav-icon" icon="cil-globe-alt" />
            Prime </a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{ route('employee.primes.index') }}">
                        <x-coreui-icon class="nav-icon" icon="cil-pen" />
                        consulter</a></li>
            </ul>
        </li>

   
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
