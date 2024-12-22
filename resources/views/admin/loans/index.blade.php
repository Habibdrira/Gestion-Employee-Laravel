@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Gestion des Prêts</h1>

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

    <!-- Lien vers l'historique des prêts -->
    <div class="mb-4">
        <a href="{{ route('admin.loans.history') }}" class="btn btn-info">Historique des prêts</a>
    </div>

    <!-- Liste des prêts en attente -->
    <h3 class="mb-4">Prêts en attente</h3>
    @if ($loans->isEmpty())
        <div class="alert alert-info" role="alert">
            Aucun prêt en attente.
        </div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nom de l'utilisateur</th>
                    <th scope="col">Montant</th>
                    <th scope="col">Raison</th>
                    <th scope="col">Statut</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loans as $loan)
                    <tr>
                        <td>{{ $loan->user ? $loan->user->name : 'Utilisateur non trouvé' }}</td>
                        <td>{{ $loan->amount }} Dinar</td>
                        <td>{{ $loan->reason ?: 'Aucune raison spécifiée' }}</td>
                        <td>
                            <span class="badge
                                @if($loan->status == 'pending') badge-warning
                                @elseif($loan->status == 'approved') badge-success
                                @elseif($loan->status == 'rejected') badge-danger
                                @endif">
                                {{ ucfirst($loan->status) }}
                            </span>
                        </td>
                        <td>
                            @if ($loan->status == 'pending')
                            <form action="{{ route('admin.loans.approve', $loan) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Approuver</button>
                            </form>
                            <form action="{{ route('admin.loans.reject', $loan) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Rejeter</button>
                            </form>
                            @else
                                <span class="text-muted">Aucune action possible</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @endif
</div>
@endsection
