@extends('employee.layouts.app')

@section('content')
    <h1>Liste des Primes</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Montant</th>
                <th>Date Attribuée</th>
            </tr>
        </thead>
        <tbody>
            @forelse($primes as $prime)
                <tr>
                    <td>{{ $prime->amount }}</td>
                    <td>{{ $prime->date_awarded }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">Aucune prime trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
