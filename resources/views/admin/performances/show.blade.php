@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Détails de la Performance</h1>
    <table class="table">
        <tr>
            <th>ID</th>
            <td>{{ $performance->id_performance }}</td>
        </tr>
        <tr>
            <th>Employé</th>
            <td>{{ $performance->employee->name }}</td>
        </tr>
        <tr>
            <th>Date</th>
            <td>{{ $performance->date }}</td>
        </tr>
        <tr>
            <th>Évaluation</th>
            <td>{{ $performance->rating }}</td>
        </tr>
    </table>
    <a href="{{ route('admin.performances.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection