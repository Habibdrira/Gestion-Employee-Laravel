@extends('employee.layouts.app')

@section('content')
<div class="container">
    <h1>Mes Fiches de Paie</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Montant</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fichePaies as $fichePaie)
                <tr>
                    <td>{{ $fichePaie->id }}</td>
                    <td>{{ $fichePaie->date }}</td>
                    <td>{{ $fichePaie->montant }}</td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
