@extends('admin.layouts.app')

@section('breadcrum')
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item"><span>Accueil</span></li>
            <li class="breadcrumb-item active"><span>Liste des Performances</span></li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <!-- Section principale pour afficher la liste des performances -->
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <h2 class="text-center mb-4">Liste des Performances</h2>
            <!-- Tableau des performances -->
            <table class="table table-bordered table-hover table-striped table-responsive">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th>#</th>
                        <th>Nom de l'Employé</th>
                        <th>Date</th>
                        <th>Évaluation</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($performances as $performance)
                        <tr class="text-center">
                            <td>{{ $performance->id }}</td>
                            <td>{{ $performance->employee->user->name }}</td>
                            <td>{{ $performance->date }}</td>
                            <td>{{ $performance->rating }}</td>
                            <td>
                                <form action="{{ route('admin.performances.destroy', $performance->id_performance) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                                
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Aucune performance trouvée</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
