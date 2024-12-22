@extends('admin.layouts.app')

@section('breadcrum')
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Tableau de bord</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.gereEmpl.index') }}">Employés</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Modifier l'Employé</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Modifier l'Employé</h2>

    <form action="{{ route('admin.gereEmpl.update', $employee->employee_id) }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        @method('PUT')

        <!-- Nom et Prénom -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Nom</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $employee->user->name ?? '') }}" required>
            </div>
            <div class="col-md-6">
                <label for="lastname" class="form-label">Prénom</label>
                <input type="text" name="lastname" class="form-control" value="{{ old('lastname', $employee->user->lastname ?? '') }}" required>
            </div>
        </div>

        <!-- Ville, Poste et Salaire -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="city" class="form-label">Ville</label>
                <input type="text" name="city" class="form-control" value="{{ old('city', $employee->city ?? '') }}" required>
            </div>
            <div class="col-md-6">
                <label for="position" class="form-label">Poste</label>
                <input type="text" name="position" class="form-control" value="{{ old('position', $employee->position ?? '') }}" required>
            </div>
        </div>

        <!-- Salaire -->
        <div class="mb-3">
            <label for="salary" class="form-label">Salaire</label>
            <input type="number" name="salary" class="form-control" value="{{ old('salary', $employee->salary ?? '') }}" required>
        </div>

        <!-- Bouton de soumission -->
        <button type="submit" class="btn btn-primary w-100 mt-4">Modifier</button>
    </form>
</div>
@endsection
