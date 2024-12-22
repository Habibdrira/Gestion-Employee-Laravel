@extends('admin.layouts.app')

@section('breadcrum')
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
                <span>Tableau de bord</span>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.gereEmpl.index') }}">Employés</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <span>Ajouter un Employé</span>
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <!-- Formulaire d'ajout d'employé -->
            <h4 class="mb-4 text-xl font-semibold text-gray-800 dark:text-white">Ajouter un Employé</h4>
            <form action="{{ route('admin.gereEmpl.store') }}" method="POST">
                @csrf
                <!-- Informations Utilisateur -->
                <h5 class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-200">Informations Employé</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email :</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Exemple: employe@mail.com" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Mot de passe :</label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mot de passe sécurisé" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="lastname" class="form-label">Nom :</label>
                        <input type="text" id="lastname" name="lastname" class="form-control @error('lastname') is-invalid @enderror" placeholder="Nom de famille" value="{{ old('lastname') }}" required>
                        @error('lastname')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Prénom :</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Prénom" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Informations Employé -->
                <h5 class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-200 mt-5">Informations supplémentaires</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="address" class="form-label">Adresse :</label>
                        <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Adresse complète" value="{{ old('address') }}" required>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="city" class="form-label">Ville :</label>
                        <input type="text" id="city" name="city" class="form-control @error('city') is-invalid @enderror" placeholder="Ville" value="{{ old('city') }}" required>
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="position" class="form-label">Poste :</label>
                        <input type="text" id="position" name="position" class="form-control @error('position') is-invalid @enderror" placeholder="Poste occupé" value="{{ old('position') }}" required>
                        @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="salary" class="form-label">Salaire :</label>
                        <input type="number" id="salary" name="salary" class="form-control @error('salary') is-invalid @enderror" placeholder="Salaire brut" value="{{ old('salary') }}" required>
                        @error('salary')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="conge" class="form-label">Nombre de congé :</label>
                        <input type="number" id="conge" name="conge" class="form-control @error('conge') is-invalid @enderror" placeholder="Nombre de jours de congé" value="{{ old('conge') }}" required>
                        @error('conge')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Bouton de soumission -->
                <button type="submit" class="btn btn-primary w-100 mt-4">Ajouter l'employé</button>
            </form>
        </div>
    </div>
</div>
@endsection
