@extends('employee.layouts.app')

@section('breadcrum')
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
                <span>Home</span>
            </li>
            <li class="breadcrumb-item active"><span>Dashboard</span></li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        @if($notifications->isNotEmpty())
            <div class="alert alert-info">
                <ul>
                    @foreach($notifications as $notification)
                        <li>{{ $notification->message }}</li>
                    @endforeach
                </ul>
            </div>
        @else
            <p>Aucune notification</p>
        @endif
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-success">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                    <div class="fs-4 fw-semibold">
                        {{ $primes }}
                    </div>
                    <div>Prime Totale</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-info">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                    <div class="fs-4 fw-semibold">
                        {{ $performances }}
                    </div>
                    <div>Performances</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-warning">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                    <div class="fs-4 fw-semibold">
                        {{ $absences }}
                    </div>
                    <div>Absences</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
