@extends('employee.layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Mes Prêts</h1>

    <!-- Message en cas de liste vide -->
    @if ($loans->isEmpty())
        <div class="alert alert-info" role="alert">
            Vous n'avez pas encore fait de demande de prêt.
        </div>
        <a href="{{ route('loans.create') }}" class="btn btn-primary">Faire une demande</a>
    @else
        <!-- Tableau des prêts -->
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Montant</th>
                    <th>Raison</th>
                    <th>Statut</th>
                    <th>Date de demande</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loans as $loan)
                    <tr>
                        <td>{{ number_format($loan->amount, 2) }} Dinar</td>
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
                        <td>{{ $loan->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Bouton de nouvelle demande -->
        <div class="text-center my-4">
            <a href="{{ route('loans.create') }}" class="btn btn-primary">Nouvelle demande</a>
        </div>
    @endif
</div>
@endsection
