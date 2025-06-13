@extends('layouts.app')

@section('title', 'Tableau de Bord')

@section('content')
<div class="container-fluid px-4">
    <!-- Welcome Header -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <div>
            <h1 class="fw-bold text-primary mb-0">Tableau de Bord</h1>
            <p class="text-muted mb-0">Bonjour {{ $user->firstName }} , bienvenue sur votre espace</p>
        </div>
        <div class="d-flex">
            <div class="badge bg-light text-dark p-2 me-2">
                <i class="bi bi-calendar-check me-1"></i>
                {{ now()->format('d/m/Y') }}
            </div>
            <div class="badge bg-light text-dark p-2">
                <i class="bi bi-book me-1"></i>
                {{ $ues->count() }} UE(s)
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary bg-gradient text-white shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-0">UE Assignées</h6>
                            <h2 class="mb-0">{{ $ues->count() }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                            <i class="bi bi-journal-bookmark fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-success bg-gradient text-white shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-0">Notes Complètes</h6>
                            <h2 class="mb-0">{{ $ues->count() - $normalSessionUEs->count() }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                            <i class="bi bi-check-circle fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning bg-gradient text-white shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-0">Notes Manquantes</h6>
                            <h2 class="mb-0">{{ $normalSessionUEs->count() }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                            <i class="bi bi-exclamation-triangle fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-info bg-gradient text-white shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-0">Rattrapages</h6>
                            <h2 class="mb-0">{{ $retakeSessionUEs->count() }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                            <i class="bi bi-clock-history fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main UE Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 overflow-hidden">
                <div class="card-header bg-white border-0 pt-3 pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Mes Unités d'Enseignement</h5>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown">
                                <i class="bi bi-funnel"></i> Filtres
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Toutes</a></li>
                                <li><a class="dropdown-item" href="#">Notes complètes</a></li>
                                <li><a class="dropdown-item" href="#">Notes manquantes</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($ues->isEmpty())
                        <div class="text-center py-5">
                            <i class="bi bi-journal-x fs-1 text-muted"></i>
                            <h5 class="text-muted mt-3">Aucune unité d'enseignement assignée</h5>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Code</th>
                                        <th>Nom</th>
                                        <th>Filière</th>
                                        <th>Statut Notes</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ues as $ue)
                                    <tr>
                                        <td class="fw-semibold">{{ $ue->code }}</td>
                                        <td>{{ $ue->nom }}</td>
                                        <td>{{ $ue->filiere->nom }}</td>
                                        <td>
                                            @if($ue->notes()->where('session_type', 'normal')->exists())
                                                <span class="badge bg-success bg-opacity-10 text-success">
                                                    <i class="bi bi-check-circle me-1"></i> Complète
                                                </span>
                                            @else
                                                <span class="badge bg-warning bg-opacity-10 text-warning">
                                                    <i class="bi bi-exclamation-triangle me-1"></i> Manquante
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <div class="btn-group">
                                                <a href="{{ route('vacataire.notes.upload', ['ue' => $ue->id, 'session_type' => 'normal']) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-upload"></i> Notes
                                                </a>
                                                <a href="{{ route('ue.details', $ue->id) }}"
                                                   class="btn btn-sm btn-outline-secondary">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Notes Status Cards -->
    <div class="row mt-4 g-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Session Normale</h5>
                    <span class="badge bg-success bg-opacity-10 text-success">
                        {{ $ues->count() - $normalSessionUEs->count() }}/{{ $ues->count() }} complètes
                    </span>
                </div>
                <div class="card-body">
                    @if($normalSessionUEs->isEmpty())
                        <div class="text-center py-4">
                            <i class="bi bi-check-circle fs-1 text-success"></i>
                            <h5 class="text-success mt-3">Toutes les notes sont à jour</h5>
                        </div>
                    @else
                        <div class="list-group list-group-flush">
                            @foreach($normalSessionUEs as $ue)
                            <div class="list-group-item border-0 px-0 py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1 fw-semibold">{{ $ue->code }} - {{ $ue->nom }}</h6>
                                        <small class="text-muted">{{ $ue->filiere->nom }}</small>
                                    </div>
                                    <a href="{{ route('vacataire.notes.upload', ['ue' => $ue->id, 'session_type' => 'normal']) }}" 
                                       class="btn btn-sm btn-success rounded-pill px-3">
                                        <i class="bi bi-upload me-1"></i> Uploader
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Session Rattrapage</h5>
                    <span class="badge bg-warning bg-opacity-10 text-warning">
                        {{ $retakeSessionUEs->count() }} en attente
                    </span>
                </div>
                <div class="card-body">
                    @if($retakeSessionUEs->isEmpty())
                        <div class="text-center py-4">
                            <i class="bi bi-check-circle fs-1 text-muted"></i>
                            <h5 class="text-muted mt-3">Aucune note de rattrapage requise</h5>
                        </div>
                    @else
                        <div class="list-group list-group-flush">
                            @foreach($retakeSessionUEs as $ue)
                            <div class="list-group-item border-0 px-0 py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1 fw-semibold">{{ $ue->code }} - {{ $ue->nom }}</h6>
                                        <small class="text-muted">{{ $ue->filiere->nom }}</small>
                                    </div>
                                    <a href="{{ route('vacataire.notes.upload', ['ue' => $ue->id, 'session_type' => 'rattrapage']) }}" 
                                       class="btn btn-sm btn-warning rounded-pill px-3">
                                        <i class="bi bi-upload me-1"></i> Uploader
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
    .card {
        border-radius: 12px;
        transition: all 0.3s ease;
    }
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.1);
    }
    .table-hover tbody tr {
        transition: all 0.2s ease;
    }
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
    .badge {
        border-radius: 8px;
        padding: 5px 10px;
    }
    .list-group-item {
        transition: background-color 0.2s ease;
    }
    .list-group-item:hover {
        background-color: #f8f9fa;
    }
</style>

<!-- Required CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
@endsection