@extends('layouts.app')

@section('title', 'Mes Unités d\'Enseignement')

@section('content')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-1">Mes Unités d'Enseignement</h2>
            <p class="text-muted mb-0">Gestion de vos cours assignés</p>
        </div>
        <div>
            <span class="badge bg-primary bg-opacity-10 text-primary p-2">
                <i class="bi bi-journal-bookmark me-1"></i> {{ $ues->count() }} UE(s)
            </span>
        </div>
    </div>

    <!-- Main Cards Grid -->
    @if($ues->isEmpty())
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <i class="bi bi-journal-x fs-1 text-muted"></i>
                <h5 class="text-muted mt-3">Aucune unité d'enseignement assignée</h5>
                <p class="text-muted">Contactez votre coordinateur pour plus d'informations</p>
            </div>
        </div>
    @else
        <div class="row g-4">
            @foreach($ues as $ue)
            <div class="col-xl-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-header bg-white border-0 pb-0">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <span class="badge bg-primary bg-opacity-10 text-primary mb-2">
                                    {{ $ue->code }}
                                </span>
                                <h4 class="mb-1">{{ $ue->nom }}</h4>
                            </div>
                            <span class="badge bg-light text-dark">
                                S{{ $ue->semestre }}
                            </span>
                        </div>
                        <p class="text-muted small mb-2">
                            <i class="bi bi-building me-1"></i> {{ $ue->filiere->nom }} • 
                            <i class="bi bi-people me-1"></i> {{ $ue->niveau->nom }}
                        </p>
                    </div>
                    
                    <div class="card-body pt-0">
                        <!-- Hours Summary -->
                        <div class="d-flex justify-content-around text-center mb-3">
                            <div>
                                <div class="text-muted small">CM</div>
                                <div class="fw-bold">{{ $ue->heures_cm }}h</div>
                            </div>
                            <div>
                                <div class="text-muted small">TD</div>
                                <div class="fw-bold">{{ $ue->heures_td }}h</div>
                            </div>
                            <div>
                                <div class="text-muted small">TP</div>
                                <div class="fw-bold">{{ $ue->heures_tp }}h</div>
                            </div>
                            <div>
                                <div class="text-muted small">Total</div>
                                <div class="fw-bold text-primary">{{ $ue->heures_cm + $ue->heures_td + $ue->heures_tp }}h</div>
                            </div>
                        </div>
                        
                        <!-- Notes Status -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between small mb-1">
                                <span>Progression des notes</span>
                                <span>75%</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-success" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card Footer with Actions -->
                    <div class="card-footer bg-white border-0 d-flex justify-content-between">
                        <a href="{{ route('vacataire.ue.details', $ue->id) }}" 
                           class="btn btn-sm btn-outline-primary rounded-pill px-3">
                            <i class="bi bi-eye me-1"></i> Détails
                        </a>
                        
                        <div class="dropdown">
                            <button class="btn btn-sm btn-primary rounded-pill px-3 dropdown-toggle" 
                                    type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-journal-text me-1"></i> Notes
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('vacataire.notes.upload', ['ue' => $ue->id, 'session_type' => 'normal']) }}">
                                        <i class="bi bi-journal-check me-2"></i> Session Normale
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('vacataire.notes.upload', ['ue' => $ue->id, 'session_type' => 'rattrapage']) }}">
                                        <i class="bi bi-clock-history me-2"></i> Session Rattrapage
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

<style>
    .hover-lift {
        transition: all 0.3s ease;
        border-radius: 12px;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 2.5rem rgba(0, 0, 0, 0.1) !important;
    }
    .card-header {
        border-radius: 12px 12px 0 0 !important;
    }
    .progress {
        border-radius: 3px;
    }
</style>

<!-- Required CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
@endsection