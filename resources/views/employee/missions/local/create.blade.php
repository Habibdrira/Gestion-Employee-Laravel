<!-- resources/views/employee/missions/local/create.blade.php -->

@extends('employee.layouts.app')

@section('content')
<div class="form-container">
    <h1>Demander une Mission Locale</h1>

    <form action="{{ route('local_missions.store') }}" method="POST">
        @csrf

        <div class="form-sections">
            <!-- Section 1: Mission Details -->
            <fieldset>
                <legend>Détails de la Mission</legend>

                <!-- Region -->
                <div class="form-group">
                    <label for="region">Région</label>
                    <input type="text" name="region" id="region" value="{{ old('region') }}" required>
                    @error('region')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- ID de l'employé -->
             <!-- ID de l'employé -->
             <input type="hidden" name="employee_id" value="{{ auth()->user()->employee->employee_id }}" required>


                <!-- Personne Accompagnante -->
                <div class="form-group">
                    <label for="accompanying_person">Personne Accompagnante</label>
                    <input type="text" name="accompanying_person" id="accompanying_person" value="{{ old('accompanying_person') }}" required>
                    @error('accompanying_person')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Superviseur -->
                <div class="form-group">
                    <label for="superviseur">Superviseur</label>
                    <input type="text" name="superviseur" id="superviseur" value="{{ old('superviseur') }}" required>
                    @error('superviseur')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Objet de la mission -->
                <div class="form-group">
                    <label for="purpose">Objet de la mission</label>
                    <textarea name="purpose" id="purpose" required>{{ old('purpose') }}</textarea>
                    @error('purpose')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Date de début -->
                <div class="form-group">
                    <label for="start_date">Date de début</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" required>
                    @error('start_date')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Date de fin -->
                <div class="form-group">
                    <label for="end_date">Date de fin</label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" required>
                    @error('end_date')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </fieldset>

            <!-- Section 2: Vehicle Details -->
            <fieldset>
                <legend>Détails du Véhicule</legend>

                <!-- Plaque d'immatriculation -->
                <div class="form-group">
                    <label for="license_plate">Plaque d'immatriculation</label>
                    <input type="text" name="license_plate" id="license_plate" value="{{ old('license_plate') }}" required>
                    @error('license_plate')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Type de véhicule -->
                <div class="form-group">
                    <label for="car_type">Type de véhicule</label>
                    <input type="text" name="car_type" id="car_type" value="{{ old('car_type') }}" required>
                    @error('car_type')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Type de carburant -->
                <div class="form-group">
                    <label for="fuel_type">Type de carburant</label>
                    <input type="text" name="fuel_type" id="fuel_type" value="{{ old('fuel_type') }}" required>
                    @error('fuel_type')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Carte carburant -->
                <div class="form-group">
                    <label for="carte_carburant">Carte carburant</label>
                    <input type="text" name="carte_carburant" id="carte_carburant" value="{{ old('carte_carburant') }}" required>
                    @error('carte_carburant')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </fieldset>

            <!-- Section 3: Expenses -->
            <fieldset>
                <legend>Dépenses</legend>

                <!-- Distance parcourue -->
                <div class="form-group">
                    <label for="distance_traveled">Distance parcourue (en km)</label>
                    <input type="number" name="distance_traveled" id="distance_traveled" value="{{ old('distance_traveled') }}" required>
                    @error('distance_traveled')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Coût du carburant -->
                <div class="form-group">
                    <label for="fuel_cost">Coût du carburant</label>
                    <input type="number" name="fuel_cost" id="fuel_cost" value="{{ old('fuel_cost') }}" required>
                    @error('fuel_cost')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Dépenses autoroutes -->
                <div class="form-group">
                    <label for="toll_expenses">Dépenses autoroutes</label>
                    <input type="number" name="toll_expenses" id="toll_expenses" value="{{ old('toll_expenses') }}">
                    @error('toll_expenses')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Hôtel -->
                <div class="form-group">
                    <label for="hotel">Hôtel</label>
                    <input type="text" name="hotel" id="hotel" value="{{ old('hotel') }}">
                    @error('hotel')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Indemnités -->
                <div class="form-group">
                    <label for="indemnity">Indemnités</label>
                    <input type="number" name="indemnity" id="indemnity" value="{{ old('indemnity') }}">
                    @error('indemnity')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Coût total -->
                <div class="form-group">
                    <label for="total_cost">Coût total</label>
                    <input type="number" name="total_cost" id="total_cost" value="{{ old('total_cost') }}" required>
                    @error('total_cost')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </fieldset>
        </div>

        <div class="form-group">
            <button type="submit" class="submit-btn">Soumettre la demande</button>
        </div>
    </form>
</div>

<style>
    .form-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-container h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-sections {
        display: flex;
        justify-content: space-between;
    }

    fieldset {
        margin-bottom: 20px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        width: 30%;
    }

    legend {
        font-weight: bold;
        padding: 0 10px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .form-group .error-message {
        color: red;
        font-size: 0.875em;
    }

    .submit-btn {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 1em;
        cursor: pointer;
    }

    .submit-btn:hover {
        background-color: #0056b3;
    }
</style>
@endsection
