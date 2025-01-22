@extends('employee.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Colonne principale contenant les informations de salaire -->
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h2>Salaire de l'Employé</h2>
                </div>
                <div class="card-body">
                    <h4 class="mb-4"><strong>Informations de l'employé</strong></h4>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Nom de l'employé : </strong> {{ $employee->user->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Position : </strong> {{ $employee->position }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Salaire de base : </strong> {{ number_format($employee->salary, 2) }} DT</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Total des absences : </strong> -{{ number_format($totalAbsenceImpact ?? 0, 2) }} DT</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Total des primes : </strong> +{{ number_format($totalPrimes ?? 0, 2) }} DT</p>
                        </div>
                        <div class="col-md-6">
                            <h4 class="text-success"><strong>Salaire : </strong> {{ number_format($adjustedSalary, 2) }} DT</h4>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <!-- Boutons de téléchargement et retour -->
                      
                        <a href="{{ route('employee.fichepaie.index') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
