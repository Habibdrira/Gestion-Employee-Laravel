@extends('employee.layouts.app')

@section('content')
    <h1 class="text-center my-4 text-dark">Mes Demandes De Missions Locales</h1>

    <div class="table-responsive">
        <div class="text-left mt-4">
            <a href="{{ route('local_missions.create') }}" class="btn btn-primary" style="padding: 10px 20px; font-size: 16px;">
                Créer une nouvelle mission
            </a>
        </div>
        <table class="table table-bordered table-striped" style="width: 100%; font-size: 14px;">
            <thead class="thead-dark">
                <tr>
                    <th style="width: 5%;">Région</th>
                    <th style="width: 10%;">Objet</th>
                    <th style="width: 8%;">Date Début</th>
                    <th style="width: 8%;">Date Fin</th>

                    <th style="width: 8%;">Car Type</th>
                    <th style="width: 8%;">Fuel Type</th>
                    <th style="width: 8%;">Carte Carburant</th>
                    <th style="width: 8%;">Distance Traveled</th>
                    <th style="width: 8%;">Fuel Cost</th>
                    <th style="width: 8%;">Toll Expenses</th>
                    <th style="width: 8%;">Hotel</th>
                    <th style="width: 8%;">Indemnity</th>
                    <th style="width: 8%;">Total Cost</th>
                    <th style="width: 8%;">Statut</th>

                    <th style="width: 10%;">Actions</th>

                </tr>
            </thead>
            <tbody>
                @forelse($missions as $mission)
                    <tr>
                        <td>{{ $mission->region }}</td>
                        <td>{{ $mission->purpose }}</td>
                        <td>{{ $mission->start_date }}</td>
                        <td>{{ $mission->end_date }}</td>


                        <td>{{ $mission->car_type }}</td>
                        <td>{{ $mission->fuel_type }}</td>
                        <td>{{ $mission->carte_carburant }}</td>
                        <td>{{ $mission->distance_traveled }}</td>
                        <td>{{ $mission->fuel_cost }}</td>
                        <td>{{ $mission->toll_expenses }}</td>
                        <td>{{ $mission->hotel }}</td>
                        <td>{{ $mission->indemnity }}</td>
                        <td>{{ $mission->total_cost }}</td>
                        <td>
                            @if($mission->status === 'Approved')
                                <span class="badge bg-success">Approuvé</span>
                            @elseif($mission->status === 'Rejected')
                                <span class="badge bg-danger">Rejeté</span>
                            @else
                                <span class="badge bg-warning">En Attente</span>
                            @endif
                        </td>
                        <td>
                            <!-- Bouton Modifier -->
                            <a href="{{ route('local_missions.edit', $mission->id) }}" class="btn btn-sm btn-warning">Modifier</a>

                            <!-- Formulaire pour le bouton Supprimer -->
                            <form action="{{ route('local_missions.destroy', $mission->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette mission ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="19" class="text-center">Aucune mission locale trouvée pour cet employé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
