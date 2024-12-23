@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Ajouter une Performance</h1>
    <form action="{{ route('admin.performances.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="employee_id" class="form-label">Employé</label>
            <select name="employee_id" id="employee_id" class="form-select" required>
                <option value="" selected disabled>-- Sélectionnez un employé --</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="rating" class="form-label">Évaluation</label>
            <input type="number" name="rating" id="rating" class="form-control" min="0" max="10" step="0.1" required>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection