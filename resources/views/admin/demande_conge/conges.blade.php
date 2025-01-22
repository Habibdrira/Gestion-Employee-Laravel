@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">

    <h2 class="text-center mb-4">Liste des Demandes de Congé</h2>


    <!-- Tableau des demandes -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="bg-primary text-white">
                <tr>
                    <th>Employé</th>
                    <th>Jours Utilisés</th>
                    <th>Date de Début</th>
                    <th>Date de Fin</th>
                    <th>Type</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($demandes as $demande)
                <tr>
                    <td>{{ $demande->employee ? $demande->employee->employee_id : 'Non assigné' }}</td>
                    <td>{{ $demande->employee ? $demande->employee->nbrjconge : '0' }} jours</td>
                    <td>{{ $demande->date_debut ? \Carbon\Carbon::parse($demande->date_debut)->format('d/m/Y') : 'N/A' }}</td>
                    <td>{{ $demande->date_fin ? \Carbon\Carbon::parse($demande->date_fin)->format('d/m/Y') : 'N/A' }}</td>
                    <td>{{ $demande->type }}</td>
                    <td>
                        <span class="badge 
                                {{ $demande->statut === 'Approuvé' ? 'bg-success' : ($demande->statut === 'Rejeté' ? 'bg-danger' : 'bg-warning') }}">
                                {{ $demande->statut }}
                        </span>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.demande_conge.update', $demande->id_conge) }}">
                            @csrf
                            @method('PUT')
                            <select name="statut" class="form-select form-select-sm mb-2">
                                <option value="Approuvé" {{ $demande->statut === 'Approuvé' ? 'selected' : '' }}>Approuvé</option>
                                <option value="Rejeté" {{ $demande->statut === 'Rejeté' ? 'selected' : '' }}>Rejeté</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary">Mettre à jour</button>
                        </form>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Aucune demande trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
