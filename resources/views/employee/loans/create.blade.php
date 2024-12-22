@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Soumettre une nouvelle demande de prêt</h1>

    <!-- Message de succès après soumission de demande -->
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulaire pour soumettre une nouvelle demande -->
    <form method="POST" action="{{ route('loans.store') }}">
        @csrf
        <div class="mb-3">
            <label for="amount" class="form-label">Montant souhaité (en Dinar)</label>
            <input type="number" name="amount" id="amount" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="reason" class="form-label">Raison (facultatif)</label>
            <input type="text" name="reason" id="reason" class="form-control" placeholder="Pourquoi avez-vous besoin du prêt ?">
        </div>
        <button type="submit" class="btn btn-primary">Soumettre la demande</button>
    </form>
</div>
@endsection
