@extends('employee.layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Soumettre une nouvelle demande de prêt</h1>

    <!-- Message de succès après soumission de demande -->
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Afficher les erreurs de validation -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulaire pour soumettre une nouvelle demande -->
    <form method="POST" action="{{ route('loans.store') }}" class="needs-validation" novalidate>
        @csrf
        <div class="mb-3">
            <label for="amount" class="form-label">Montant souhaité (en Dinar)</label>
            <input
                type="number"
                name="amount"
                id="amount"
                class="form-control @error('amount') is-invalid @enderror"
                value="{{ old('amount') }}"
                placeholder="Exemple : 5000"
                min="1"
                step="0.01"
                required>
            @error('amount')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="reason" class="form-label">Raison (facultatif)</label>
            <textarea
                name="reason"
                id="reason"
                class="form-control @error('reason') is-invalid @enderror"
                rows="3"
                placeholder="Pourquoi avez-vous besoin du prêt ?">{{ old('reason') }}</textarea>
            @error('reason')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Soumettre la demande</button>
    </form>
</div>
@endsection
