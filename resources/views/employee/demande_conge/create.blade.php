@extends('employee.layouts.app')

@section('title', 'Demander un Congé')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Demander un Congé</h1>

    <!-- Formulaire de demande de congé -->
    <form action="{{ route('employee.demande_conge.store') }}" method="POST" class="mt-4">
        @csrf

        <!-- Date de début -->
        <div class="mb-4">
            <label for="date_debut" class="form-label">Date de début</label>
            <input type="date" name="date_debut" id="date_debut" class="form-control" required aria-label="Date de début">
        </div>

        <!-- Date de fin -->
        <div class="mb-4">
            <label for="date_fin" class="form-label">Date de fin</label>
            <input type="date" name="date_fin" id="date_fin" class="form-control" required aria-label="Date de fin" onchange="validateDates()">
        </div>

        <!-- Type de congé -->
        <div class="mb-4">
            <label for="type" class="form-label">Type de congé</label>
            <select name="type" id="type" class="form-select" required aria-label="Type de congé">
                <option value="Annuel">Annuel</option>
                <option value="Maladie">Maladie</option>
                <option value="Maternité">Maternité</option>
                <option value="Autre">Autre</option>
            </select>
        </div>

        <!-- Commentaire -->
        <div class="mb-4">
            <label for="commentaire" class="form-label">Commentaire</label>
            <textarea name="commentaire" id="commentaire" class="form-control" rows="4" placeholder="Ajoutez un commentaire (facultatif)" aria-label="Commentaire"></textarea>
        </div>

        <!-- Bouton de soumission -->
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Soumettre</button>
        </div>
    </form>
</div>

<!-- Validation JavaScript -->
<script>
    function validateDates() {
        const startDate = document.getElementById("date_debut").value;
        const endDate = document.getElementById("date_fin").value;

        if (new Date(startDate) > new Date(endDate)) {
            alert("La date de fin doit être après la date de début.");
            document.getElementById("date_fin").value = "";  // Clear the invalid end date
        }
    }
</script>
@endsection
