@extends('admin.layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header bg-gradient-dark text-white text-center">
                    <h4>Attribuer une Prime</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.primes.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="employee_id">Nom de l'employé</label>
                            <select name="employee_id" id="employee_id" class="form-control" required>
                                <option value="">Choisir un employé</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->user->name ?? 'Nom non défini' }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="absence_days">Nombre de jours d'absence</label>
                            <input type="number" name="absence_days" id="absence_days" class="form-control" min="0" value="{{ old('absence_days', 0) }}">
                        </div>

                        <div class="form-group">
                            <label for="performance_rating">Note de performance</label>
                            <input type="number" name="performance_rating" id="performance_rating" class="form-control" min="0" max="10" step="0.1" value="{{ old('performance_rating', 0) }}">
                        </div>

                        <div class="form-group">
                            <label for="base_amount">Montant de base de la prime</label>
                            <input type="number" name="base_amount" id="base_amount" class="form-control" min="0" required value="{{ old('base_amount', 1000) }}">
                        </div>

                        <button type="submit" class="btn btn-success">Attribuer la prime</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
