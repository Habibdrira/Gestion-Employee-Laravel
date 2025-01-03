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

        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">
            <x-coreui-icon class="nav-icon" icon="cil-speedometer" />
            Dashboard<span class="badge badge-sm bg-info ms-auto">NEW</span></a></li>

        <li class="nav-title">Management</li>

        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
            <x-coreui-icon class="nav-icon" icon="cil-user" />
            Profile </a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.profile.edit') }}">
                    <x-coreui-icon class="nav-icon" icon="cil-pen" />
                    Edit</a></li>
            </ul>
        </li>

        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
            <x-coreui-icon class="nav-icon" icon="cil-user" />
            Gestion Employee </a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.gereEmpl.index') }}">
                    <x-coreui-icon class="nav-icon" icon="cil-pen" />
                    Liste des Employés</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.gereEmpl.create') }}">
                    <x-coreui-icon class="nav-icon" icon="cil-pen" />
                    Ajouter un Employé </a></li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <x-coreui-icon class="nav-icon" icon="cil-speedometer" />
                Dashboard<span class="badge badge-sm bg-info ms-auto">NEW</span>
            </a>
        </li>

        <li class="nav-title">Management</li>

        <!-- Profile Management -->
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <x-coreui-icon class="nav-icon" icon="cil-user" />
                Profile
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.profile.edit') }}">
                        <x-coreui-icon class="nav-icon" icon="cil-pencil" />
                        Edit
                    </a>
                </li>
            </ul>
        </li>

        <!-- Gestion des Employés -->
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <x-coreui-icon class="nav-icon" icon="cil-people" />
                Gestion Employés
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.gereEmpl.index') }}">
                        <x-coreui-icon class="nav-icon" icon="cil-list" />
                        Liste des Employés
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.gereEmpl.create') }}">
                        <x-coreui-icon class="nav-icon" icon="cil-user-follow" />
                        Ajouter un Employé
                    </a>
                </li>
            </ul>
        </li>

        <!-- Gestion des Congés -->
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <x-coreui-icon class="nav-icon" icon="cil-calendar" />
                Gestion des Congés
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.demande_conge.conges') }}">
                        <x-coreui-icon class="nav-icon" icon="cil-list" />
                        Liste des Demandes de Congé
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.demande_conge.analyser_congees') }}">
                        <x-coreui-icon class="nav-icon" icon="cil-chart" />
                        Analyse des Congés
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
            <x-coreui-icon class="nav-icon" icon="cil-user" />
            analyser-congees </a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.demande_conge.conges') }}">
                    <x-coreui-icon class="nav-icon" icon="cil-pen" />
                    Liste des Demandes de Congé</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.demande_conge.analyser_congees') }}">
                    <x-coreui-icon class="nav-icon" icon="cil-pen" />
                    Analyse des Congés </a></li>

            </ul>
        </li>

        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
            <x-coreui-icon class="nav-icon" icon="cil-user" />
            analyser-absences </a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.absences') }}">
                    <x-coreui-icon class="nav-icon" icon="cil-pen" />
                    Liste des absences</a></li>
            </ul>
        </li>

        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
            <x-coreui-icon class="nav-icon" icon="cil-user" />
            Missions Locales </a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.local_missions.index') }}">
                    <x-coreui-icon class="nav-icon" icon="cil-pen" />
                    Liste des Missions Locales</a></li>
            </ul>
        </li>

        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
            <x-coreui-icon class="nav-icon" icon="cil-user" />
            Missions Internationales </a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{ route('missions.international.admin.index') }}">
                    <x-coreui-icon class="nav-icon" icon="cil-pen" />
                    Liste des Missions Internationales</a></li>
            </ul>
        </li>

                  

        </ul>
        




    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">

        <x-coreui-icon class="nav-icon" icon="cil-user" />
        analyser-absences </a>
    <ul class="nav-group-items">

        <li class="nav-item"><a class="nav-link" href="{{ route('admin.absences') }}">

            <x-coreui-icon class="nav-icon" icon="cil-pen" />

            Liste des absences</a></li>


        <li class="nav-item"><a class="nav-link" href="{{ route('admin.absences.create') }}">

                <x-coreui-icon class="nav-icon" icon="cil-pen" />

                crer absences </a></li>

    </ul>

    <li class="nav-group">
        <a class="nav-link nav-group-toggle" href="#">
            <x-coreui-icon class="nav-icon" icon="cil-pen" />
            Gestion de Performance
        </a>
       
    </li>
</li>
   
<li class="nav-group">
    <a class="nav-link nav-group-toggle" href="#">
        <x-coreui-icon class="nav-icon" icon="cil-pen" />
        Gestion de Performance
    </a>
    <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.performances.index') }}">
                <x-coreui-icon class="nav-icon" icon="cil-list" />
                Liste des Performances
            </a>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.performances.create') }}">
                <x-coreui-icon class="nav-icon" icon="cil-plus" />
                Ajouter une Performance
            </a>
        </li>
    </ul>
</li>



<li class="nav-group"><a class="nav-link nav-group-toggle" href="#">


    <x-coreui-icon class="nav-icon" icon="cil-user" />
    Primes</a>
<ul class="nav-group-items">

    <li class="nav-item"><a class="nav-link" href="{{ route('admin.primes.index') }}">

        <x-coreui-icon class="nav-icon" icon="cil-pen" />

        Liste des Primes</a></li>
          
</ul>
</li>


        <!-- Gestion des Absences -->
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <x-coreui-icon class="nav-icon" icon="cil-warning" />
                Gestion des Absences
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.absences') }}">
                        <x-coreui-icon class="nav-icon" icon="cil-list" />
                        Liste des Absences
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.absences.create') }}">
                        <x-coreui-icon class="nav-icon" icon="cil-plus" />
                        Créer une Nouvelle Absence
                    </a>
                </li>
            </ul>
        </li>

        <!-- Gestion des Prêts -->
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <x-coreui-icon class="nav-icon" icon="cil-bank" />
                Gestion des Prêts
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.loans.index') }}">
                        <x-coreui-icon class="nav-icon" icon="cil-clock" />
                        Prêts en Attente
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.loans.history') }}">
                        <x-coreui-icon class="nav-icon" icon="cil-history" />
                        Historique des Prêts
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
