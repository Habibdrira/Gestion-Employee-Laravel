@extends('employee.layouts.app')

@section('content')
<div class="container">
    <h1>Salaire Ajusté</h1>
    <p><strong>Nom de l'employé : </strong> {{ $employee->user->name }}</p>
    <p><strong>Position : </strong> {{ $employee->position }}</p>
    <p><strong>Salaire de base : </strong> {{ $employee->salary }} €</p>
    <p><strong>Total des absences : </strong> -{{ $totalAbsenceImpact ?? 0 }} €</p>
    <p><strong>Total des primes : </strong> +{{ $totalPrimes ?? 0 }} €</p>
    <h3><strong>Salaire ajusté : </strong> {{ $adjustedSalary }} €</h3>

    <a href="{{ route('employee.fichepaie.downloadSalary', ['employeeId' => $employee->employee_id]) }}" class="btn btn-success">
        Télécharger le rapport de salaire
    </a>
    
    <a href="{{ route('employee.fichepaie.index') }}" class="btn btn-primary">Retour</a>
</div>
@endsection
