@extends('admin.layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Liste des Missions Internationales</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID Mission</th>
                    <th>Employé</th>
                    <th>Superviseur</th>
                    <th>Destination</th>
                    <th>Date Début</th>
                    <th>Date Fin</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($missions as $mission)
                    <tr>
                        <td>{{ $mission->mission_id }}</td>
                        <td>
                            @if ($mission->employee && $mission->employee->user)
                                <h6 class="text-sm mb-0">{{ $mission->employee->user->getFullNameAttribute() }}</h6>
                                <p class="text-xs text-secondary mb-0">{{ $mission->employee->user->email }}</p>
                            @else
                                <p class="text-danger">Utilisateur ou employé non disponible</p>
                            @endif
                        </td>
                        <td>{{ $mission->superviseur }}</td>
                        <td>{{ $mission->destination }}</td>
                        <td>{{ \Carbon\Carbon::parse($mission->start_date)->format('Y-m-d') }}</td>
                        <td>{{ \Carbon\Carbon::parse($mission->end_date)->format('Y-m-d') }}</td>
                        <td>
                            @if($mission->status == 'approved')
                                <span class="badge bg-success">Approuvée</span>
                            @elseif($mission->status == 'rejected')
                                <span class="badge bg-danger">Rejetée</span>
                            @else
                                <span class="badge bg-warning">En attente</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('missions.international.approve', $mission->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir approuver cette mission ?')">Approuver</button>
                            </form>
                            <form action="{{ route('missions.international.reject', $mission->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir rejeter cette mission ?')">Rejeter</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
@endsection
