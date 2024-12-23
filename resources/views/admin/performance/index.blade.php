@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Liste des Performances</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Employé</th>
                <th>Date</th>
                <th>Évaluation</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($performances as $performance)
                <tr>
                    <td>{{ $performance->id_performance }}</td>
                    <td>{{ $performance->employee->name }}</td>
                    <td>{{ $performance->date }}</td>
                    <td>{{ $performance->rating }}</td>
                    <td>
                        <a href="{{ route('admin.performances.show', $performance->id_performance) }}" class="btn btn-info">Voir</a>
                        <form action="{{ route('admin.performances.destroy', $performance->id_performance) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection