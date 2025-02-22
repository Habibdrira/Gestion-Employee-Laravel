@extends('admin.layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-lg">
                <div class="card-header bg-gradient-dark text-white text-center">
                    <h4 class="text-white">Modifier une Absence</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.absences.update', $absence->id_absence) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Employé -->
                        <div class="mb-3">
                            <label for="employee_id" class="form-label">Employé</label>
                            <select name="employee_id" id="employee_id" class="form-control" required>
                                <option value="" disabled {{ !$absence->employee_id ? 'selected' : '' }}>
                                    -- Sélectionner un employé --
                                </option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->employee_id }}" 
                                        {{ $employee->employee_id == $absence->employee_id ? 'selected' : '' }}>
                                        {{ $employee->user->name ?? 'Nom indisponible' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Date -->
                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" name="date" id="date" class="form-control" 
                                value="{{ old('date', $absence->date) }}" required>
                            @error('date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Durée -->
                        <div class="mb-3">
                            <label for="duration" class="form-label">Durée (en heures)</label>
                            <input type="number" name="duration" id="duration" class="form-control" 
                                min="1" value="{{ old('duration', $absence->duration) }}" required>
                            @error('duration')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Raison -->
                        <div class="mb-3">
                            <label for="reason" class="form-label">Raison</label>
                            <input type="text" name="reason" id="reason" class="form-control" 
                                value="{{ old('reason', $absence->reason) }}" required>
                            @error('reason')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Boutons -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Modifier</button>
                            <a href="{{ route('admin.absences') }}" class="btn btn-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
