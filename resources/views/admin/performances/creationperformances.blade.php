@extends('admin.layouts.app')

@section('breadcrum')
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item"><span>Accueil</span></li>
            <li class="breadcrumb-item active"><span>Liste des Employés</span></li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <!-- Section principale pour afficher la liste des employés -->
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <h2 class="text-center mb-4">Liste des Employés</h2>

            <!-- Tableau des employés -->
            <table class="table table-bordered table-hover table-striped table-responsive">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Ville</th>
                        <th>Poste</th>
                        <th>Salaire</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                        <tr class="text-center">
                            <td>{{ $employee->employee_id }}</td>
                            <td>{{ $employee->user->name ?? 'Non spécifié' }}</td>
                            <td>{{ $employee->user->lastname ?? 'Non spécifié' }}</td>
                            <td>{{ $employee->city ?? 'Non spécifié' }}</td>
                            <td>{{ $employee->position ?? 'Non spécifié' }}</td>
                            <td>{{ $employee->salary ?? 'Non spécifié' }}</td>
                            <td>
                                <!-- Bouton de création de performance pour chaque employé -->
                                <a href="{{ route('admin.performances.create', $employee->employee_id) }}" class="btn btn-primary btn-sm me-1">
                                    Ajouter Performance
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Aucun employé trouvé</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
