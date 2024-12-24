@extends('employee.layouts.app')

@section('content')
    <h1>Liste des Performances</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Note</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($performances as $performance)
                <tr>
                    <td>{{ $performance->rating }}</td>
                    <td>{{ $performance->date }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">Aucune performance trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
