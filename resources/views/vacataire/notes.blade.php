@extends('layouts.app')

@section('title', 'Gestion des Notes')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 fw-bold text-primary">Gestion des Notes</h1>
    
    <div class="row mt-4 g-4">
        <!-- Normal Session Card -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg h-100 animate__animated animate__fadeInLeft">
                <div class="card-header bg-gradient-success text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-semibold">
                            <i class="bi bi-check-circle me-2"></i> Session Normale
                        </h5>
                        <span class="badge bg-white text-success fs-6">{{ $normalSessionUEs->count() }} UE(s)</span>
                    </div>
                </div>
                <div class="card-body">
                    @if($normalSessionUEs->isEmpty())
                        <div class="alert alert-success bg-light-success border-0">
                            <i class="bi bi-check-all me-2"></i> Toutes les notes sont à jour
                        </div>
                    @else
                        <div class="list-group list-group-flush">
                            @foreach($normalSessionUEs as $ue)
                            <div class="list-group-item list-group-item-action border-0 py-3 px-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1 fw-semibold text-dark">{{ $ue->code }} - {{ $ue->nom }}</h6>
                                        <small class="text-muted">{{ $ue->filiere->nom ?? '' }}</small>
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ route('vacataire.notes.upload', ['ue' => $ue->id, 'session_type' => 'normal']) }}" 
                                           class="btn btn-sm btn-success rounded-pill px-3 me-2">
                                            <i class="bi bi-cloud-arrow-up me-1"></i> Uploader
                                        </a>
                                        @if($ue->notes()->where('session_type', 'normal')->exists())
                                        <a href="{{ route('vacataire.notes.view', ['ue' => $ue->id, 'session_type' => 'normal']) }}" 
                                           class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                            <i class="bi bi-eye-fill me-1"></i> Voir
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="card-footer bg-transparent border-0 py-3">
                    <small class="text-muted"><i class="bi bi-info-circle me-1"></i> Notes non soumises</small>
                </div>
            </div>
        </div>

        <!-- Retake Session Card -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg h-100 animate__animated animate__fadeInRight">
                <div class="card-header bg-gradient-warning text-dark py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-semibold">
                            <i class="bi bi-exclamation-triangle me-2"></i> Session Rattrapage
                        </h5>
                        <span class="badge bg-white text-warning fs-6">{{ $retakeSessionUEs->count() }} UE(s)</span>
                    </div>
                </div>
                <div class="card-body">
                    @if($retakeSessionUEs->isEmpty())
                        <div class="alert alert-warning bg-light-warning border-0">
                            <i class="bi bi-check-all me-2"></i> Aucune note de rattrapage requise
                        </div>
                    @else
                        <div class="list-group list-group-flush">
                            @foreach($retakeSessionUEs as $ue)
                            <div class="list-group-item list-group-item-action border-0 py-3 px-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1 fw-semibold text-dark">{{ $ue->code }} - {{ $ue->nom }}</h6>
                                        <small class="text-muted">{{ $ue->filiere->nom ?? '' }}</small>
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ route('vacataire.notes.upload', ['ue' => $ue->id, 'session_type' => 'rattrapage']) }}" 
                                           class="btn btn-sm btn-warning rounded-pill px-3 me-2">
                                            <i class="bi bi-cloud-arrow-up me-1"></i> Uploader
                                        </a>
                                        @if($ue->notes()->where('session_type', 'rattrapage')->exists())
                                        <a href="{{ route('vacataire.notes.view', ['ue' => $ue->id, 'session_type' => 'rattrapage']) }}" 
                                           class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                            <i class="bi bi-eye-fill me-1"></i> Voir
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="card-footer bg-transparent border-0 py-3">
                    <small class="text-muted"><i class="bi bi-info-circle me-1"></i> Notes de seconde chance</small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .bg-gradient-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    }
    .bg-gradient-warning {
        background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
    }
    .list-group-item {
        transition: background-color 0.2s ease;
    }
    .list-group-item:hover {
        background-color: #f8f9fa;
    }
</style>

<!-- Animate.css for animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
@endsection