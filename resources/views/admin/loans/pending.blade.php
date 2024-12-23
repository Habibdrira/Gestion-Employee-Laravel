@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Prêts en Attente</h1>

    @if ($loans->isEmpty())
        <div class="alert alert-info" role="alert">
            Aucune demande de prêt en attente.
        </div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Montant</th>
                    <th>Raison</th>
                    <th>Date de demande</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loans as $loan)
                    <tr>
                        <td>{{ $loan->amount }} Dinar</td>
                        <td>{{ $loan->reason ?: 'Aucune raison spécifiée' }}</td>
                        <td>{{ $loan->created_at->format('d/m/Y') }}</td>
                        <td>
                            <form action="{{ route('admin.loans.approve', $loan) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Approuver</button>
                            </form>
                            <form action="{{ route('admin.loans.reject', $loan) }}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit" class="btn btn-danger">Rejeter</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
