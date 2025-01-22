@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">

    <h2>Mettre à jour la demande de congé</h2>

    <form method="POST" action="{{ route('admin.demande_conge.update', ['id' => $demande->id]) }}">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="statut" class="form-label">Statut</label>
            <select name="statut" id="statut" class="form-select">
                <option value="Approuvé" {{ $demande->statut == 'Approuvé' ? 'selected' : '' }}>Approuvé</option>
                <option value="Rejeté" {{ $demande->statut == 'Rejeté' ? 'selected' : '' }}>Rejeté</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
