@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Ajouter une Performance pour {{ $employee->user->name }}</h1>
    <form action="{{ route('admin.performances.store') }}" method="POST">
        @csrf
        <!-- Champ caché pour l'ID de l'employé -->
        <input type="hidden" name="employee_id" value="{{ $employee->employee_id }}">

        <div class="mb-3">
            <label for="employee_name" class="form-label">Employé</label>
            <input type="text" id="employee_name" class="form-control" value="{{ $employee->user->name }}" disabled>
        </div>
        
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="rating" class="form-label">Évaluation</label>
            <input type="number" name="rating" id="rating" class="form-control" min="0" max="5" step="0.1" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection
