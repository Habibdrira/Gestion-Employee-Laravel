<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar" style="background-color: #212631;">
    <div class="sidebar-brand d-none d-md-flex">
        <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="#"></use>
        </svg>
        <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('assets/brand/coreui.svg#signet') }}"></use>
        </svg>
    </div>
    
    <style>
        .sidebar-nav .nav-link {
            background-color: #212631;
            color: #ffffff;
        }

        .sidebar-nav .nav-link:hover,
        .sidebar-nav .nav-link:focus,
        .sidebar-nav .nav-link.active {
            background-color: #2b343d; /* Couleur pour l'état actif ou survolé */
            color: #ffffff;
        }

        .sidebar-nav .nav-group-toggle {
            background-color: #212631;
            color: #ffffff;
        }
    </style>

    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>

        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                <x-coreui-icon class="nav-icon" icon="cil-speedometer" />
                Dashboard
                <span class="badge badge-sm bg-info ms-auto">NEW</span>
            </a>
        </li>

        <!-- Employee Management -->
        <li class="nav-title">Employee Management</li>
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <x-coreui-icon class="nav-icon" icon="cil-user" />
                Profile
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.profile.edit') }}">
                        <x-coreui-icon class="nav-icon" icon="cil-pencil" />
                        Edit Profile
                    </a>
                </li>
            </ul>
        </li>

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
