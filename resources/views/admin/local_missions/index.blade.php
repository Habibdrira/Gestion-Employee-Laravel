@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Liste des Missions Locales</h1>



    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID Mission</th>
                <th>Employé</th>
                <th>Région</th>
                <th>Date Début</th>
                <th>Date Fin</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($missions as $mission)
                <tr class="table-light">
                    <td>{{ $mission->id }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="text-sm mb-0">{{ $mission->employee->user->getFullNameAttribute() }}</h6>
                                <p class="text-xs text-secondary mb-0">{{ $mission->employee->user->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td>{{ $mission->region }}</td>
                    <td>{{ \Carbon\Carbon::parse($mission->start_date)->format('Y-m-d') }}</td>
                    <td>{{ \Carbon\Carbon::parse($mission->end_date)->format('Y-m-d') }}</td>

                    <td>
                        @if ($mission->status == 'pending')
                            <span class="badge bg-warning">En attente</span>
                        @elseif ($mission->status == 'Approved')
                            <span class="badge bg-success">Approuvée</span>
                        @elseif ($mission->status == 'Rejected')
                            <span class="badge bg-danger">Rejetée</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.local_missions.approve', $mission->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Approuver</button>
                        </form>
                        <form action="{{ route('admin.local_missions.reject', $mission->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Rejeter</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
