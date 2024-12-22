@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Mes Prêts</h1>
    @if ($loans->isEmpty())
        <div class="alert alert-info" role="alert">
            Vous n'avez pas encore fait de demande de prêt.
        </div>
    @else
        <table class="table table-striped">
            <thead>
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
                        <td>{{ $loan->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <a href="{{ route('loans.create') }}" class="btn btn-primary my-4">Nouvelle demande</a>
</div>
@endsection
