@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Historique des Prêts</h1>

    <!-- Message de succès ou erreur après action -->
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <!-- Affichage des prêts approuvés et rejetés -->
    @if ($loans->isEmpty())
        <div class="alert alert-info" role="alert">
            Aucun prêt approuvé ou rejeté pour le moment.
        </div>
    @else
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nom de l'utilisateur</th>
                    <th scope="col">Montant</th>
                    <th scope="col">Raison</th>
                    <th scope="col">Statut</th>
                    <th scope="col">Date de demande</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loans as $loan)
                    <tr>
                        <td>{{ $loan->user->name ?? 'Utilisateur non trouvé' }}</td>
                        <td>{{ number_format($loan->amount, 2, ',', ' ') }} Dinar</td>
                        <td>{{ $loan->reason ?: 'Aucune raison spécifiée' }}</td>
                        <td>
                            <span class="badge
                                @if($loan->status == 'approved') badge-success
                                @elseif($loan->status == 'rejected') badge-danger
                                @else badge-secondary
                                @endif">
                                {{ ucfirst($loan->status) }}
                            </span>
                        </td>
                        <td>{{ $loan->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Bouton pour télécharger le CSV -->
        <div class="mb-4">
            <a href="{{ route('admin.loans.downloadCSV') }}" class="btn btn-secondary">
                <i class="fas fa-file-download"></i> Télécharger l'historique en CSV
            </a>
        </div>
    @endif
</div>
@endsection
