@extends('admin.layouts.app')

@section('content')
    <div class="container mt-5">
        <h3 class="mb-4 text-center">Vos Notifications</h3>

        @forelse($notifications as $notification)
            <div class="notification-item alert alert-info mb-3 shadow-sm p-3 rounded">
                <p class="mb-1">
                    <strong>Mission:</strong> {{ $notification->data['employee_name'] }} a soumis une mission locale dans la région {{ $notification->data['region'] }} avec le statut {{ $notification->data['status'] }}.
                </p>

                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
            </div>
        @empty
            <p class="alert alert-warning text-center">Aucune notification pour le moment.</p>
        @endforelse

        <!-- Marquer toutes comme lues -->
        <div class="text-center mt-4">
            <a href="{{ route('admin.notifications.markAllAsRead') }}" class="btn btn-primary">Marquer toutes comme lues</a>
        </div>
    </div>
@endsection
