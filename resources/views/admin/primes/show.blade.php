@extends('admin.layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header bg-gradient-dark text-white text-center">
                    <h4>Liste des Employés ayant des Primes</h4>
                </div>
                <div class="card-body">
                    @if($employeesWithPrimes->isEmpty())
                        <p>Aucun employé n'a reçu de prime.</p>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nom de l'employé</th>
                                    <th>Montant de la prime</th>
                                    <th>Facteur d'absence</th>
                                    <th>Facteur de performance</th>
                                    <th>Actions</th> <!-- Nouvelle colonne pour les actions -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employeesWithPrimes as $employee)
                                    @foreach($employee->primes as $prime)
                                        <tr>
                                            <td>{{ $employee->user->name }}</td>
                                            <td>{{ $prime->amount }} €</td>
                                            <td>{{ $prime->absence_factor }}</td>
                                            <td>{{ $prime->performance_factor }}</td>

                                            <!-- Colonne des actions, avec un bouton de suppression -->
                                            <td>
                                                <!-- Formulaire de suppression -->
                                                <form action="{{ route('admin.primes.destroy', ['prime' => $prime->id_prime]) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette prime ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                </form>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
