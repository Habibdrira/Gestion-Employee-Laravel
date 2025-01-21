<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar" style="background-color: #00192f;">
    <!-- Sidebar Brand Section -->
    <div class="sidebar-brand d-none d-md-flex">
        <!-- Ajout de l'image -->
        <img 
        src="{{ asset('assets/img/1.png') }}" 
        alt="Logo BD" 
        class="sidebar-brand-full" 
        width="200" 
        height="100" 
        style="object-fit: contain;"
    >
    </div>

    <!-- Styles pour la sidebar -->
    <style>
      
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

        /* Image style (optionnel) */
       .sidebar-brand img {
            margin: 0 auto;
        }
        
    </style>

    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>

        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                <x-coreui-icon class="nav-icon" icon="cil-speedometer" />
                Dashboard
                
            </a>
        </li>

        <!-- Employee Management -->
        <li class="nav-title">Employee Management</li>


        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <x-coreui-icon class="nav-icon" icon="cil-people" />
                Employee List
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.gereEmpl.index') }}">
                        <x-coreui-icon class="nav-icon" icon="cil-list" />
                        Employee List
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.gereEmpl.create') }}">
                        <x-coreui-icon class="nav-icon" icon="cil-user-follow" />
                        Add Employee
                    </a>
                </li>
            </ul>
        </li>

        
        <!-- Absence Management -->
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <x-coreui-icon class="nav-icon" icon="cil-ban" />
                Absence Management
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.absences') }}">
                        <x-coreui-icon class="nav-icon" icon="cil-list" />
                        Absence List
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.absences.create') }}">
                        <x-coreui-icon class="nav-icon" icon="cil-plus" />
                        Create Absence
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
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.performances.index') }}">
                        <x-coreui-icon class="nav-icon" icon="cil-list" />
                        Performance List
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.performances.creationperformances') }}">
                        <x-coreui-icon class="nav-icon" icon="cil-plus" />
                        Add Performance
                    </a>
                </li>
            </ul>
        </li>


        <!-- Loan Management -->
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <x-coreui-icon class="nav-icon" icon="cil-credit-card" />
                Loan Management
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.loans.index') }}">
                        <x-coreui-icon class="nav-icon" icon="cil-clock" />
                        Pending Loans
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.loans.history') }}">
                        <x-coreui-icon class="nav-icon" icon="cil-history" />
                        Loan History
                    </a>
                </li>
            </ul>
        </li>

        <!-- Bonus Management -->
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <x-coreui-icon class="nav-icon" icon="cil-cash" />
                Bonus Management
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.primes.show') }}">
                        <x-coreui-icon class="nav-icon" icon="cil-money" />
                        Bonus List
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.primes.index') }}">
                        <x-coreui-icon class="nav-icon" icon="cil-money" />
                        Ajouter Bonus
                    </a>
                </li>
            </ul>
        </li>

                <!-- Leave Management -->
                <li class="nav-group">
                    <a class="nav-link nav-group-toggle" href="#">
                        <x-coreui-icon class="nav-icon" icon="cil-calendar" />
                        Leave Management
                    </a>
                    <ul class="nav-group-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.demande_conge.conges') }}">
                                <x-coreui-icon class="nav-icon" icon="cil-list" />
                                Leave Requests
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.demande_conge.analyser_congees') }}">
                                <x-coreui-icon class="nav-icon" icon="cil-chart-line" />
                                Leave Analysis
                            </a>
                        </li>
                    </ul>
                </li>

        <!-- Local Missions -->
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <x-coreui-icon class="nav-icon" icon="cil-briefcase" />
                Local Missions
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.local_missions.index') }}">
                        <x-coreui-icon class="nav-icon" icon="cil-map" />
                        Local Mission List
                    </a>
                </li>
            </ul>
        </li>

        <!-- International Missions -->
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <x-coreui-icon class="nav-icon" icon="cil-briefcase"  />
                International Missions
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('missions.international.admin.index') }}">
                        <x-coreui-icon class="nav-icon" icon="cil-globe-alt" />
                        International Mission List
                    </a>
                </li>
            </ul>
        </li>

    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
