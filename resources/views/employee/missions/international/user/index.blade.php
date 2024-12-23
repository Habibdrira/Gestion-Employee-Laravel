@extends('employee.layouts.app')
@section('content')
<div class="container">
    <h1 class="mb-4">Mes Demandes de Missions Internationales</h1>

    <a href="{{ route('missions.international.create') }}" class="btn btn-primary mb-4">Demander votre mission internationale</a>

    @if($missions->isEmpty())
        <p>Aucune mission internationale trouvée.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID de la Mission</th>
                    <th>Superviseur</th>
                    <th>Objectif</th>
                    <th>Destination</th>
                    <th>Date de Début</th>
                    <th>Date de Fin</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach($missions as $mission)
                    <tr>
                        <td>{{ $mission->mission_id }}</td>
                        <td>{{ $mission->superviseur }}</td>
                        <td>{{ $mission->purpose }}</td>
                        <td>{{ $mission->destination }}</td>
                        <td>{{ $mission->start_date }}</td>
                        <td>{{ $mission->end_date }}</td>
                        <td>
                            @if($mission->status === 'pending')
                                <span class="badge bg-warning">En attente</span>
                            @elseif($mission->status === 'approved')
                                <span class="badge bg-success">Approuvée</span>
                            @elseif($mission->status === 'rejected')
                                <span class="badge bg-danger">Rejetée</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
