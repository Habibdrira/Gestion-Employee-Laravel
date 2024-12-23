@extends('employee.layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Demander une Mission Internationale</h1>

        <form action="{{ route('missions.international.store') }}" method="POST">
            @csrf
            <input type="hidden" name="employee_id"
            value="{{ auth()->user()->employee ? auth()->user()->employee->id : '' }}"
            required>

            <div class="form-group">
                <label for="mission_id">ID Mission</label>
                <input type="text" name="mission_id" id="mission_id" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="superviseur">Superviseur</label>
                <input type="text" name="superviseur" id="superviseur" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="purpose">Objet</label>
                <input type="text" name="purpose" id="purpose" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="start_date">Date de début</label>
                <input type="date" name="start_date" id="start_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="end_date">Date de fin</label>
                <input type="date" name="end_date" id="end_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="destination">Destination</label>
                <input type="text" name="destination" id="destination" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="expenses">Frais estimés</label>
                <input type="number" name="expenses" id="expenses" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="interim">Interim</label>
                <textarea name="interim" id="interim" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Soumettre la demande</button>
        </form>
    </div>
@endsection
