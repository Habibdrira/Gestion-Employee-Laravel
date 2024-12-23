@extends('employee.layouts.app')

@section('content')
    <div class="container mt-5">
        <h3 class="mb-4 text-center">Vos Notifications</h3>

        @forelse($notifications as $notification)
            <div class="notification-item alert alert-info mb-3 shadow-sm p-3 rounded">
                <p class="mb-1">{{ $notification->data['message'] }}</p>
                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
            </div>
        @empty
            <p class="alert alert-warning text-center">Aucune notification pour le moment.</p>
        @endforelse

        <!-- Marquer toutes comme lues -->
        <div class="text-center mt-4">
            <a href="{{ route('notifications.markAllAsRead') }}" class="btn btn-primary">Marquer toutes comme lues</a>
        </div>
    </div
@endsection
