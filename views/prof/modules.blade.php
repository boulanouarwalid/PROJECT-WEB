@extends('layouts.app')

@section('title', 'Mes Modules')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Header with Summary -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="h3 mb-2">
                <i class="bi bi-journal-bookmark text-primary me-2"></i>Mes Modules
            </h1>
            <p class="text-muted mb-0">Gestion de votre charge pédagogique {{ now()->format('Y') }}-{{ now()->format('Y')+1 }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('charge-horaire.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Nouveau
            </a>
            <button class="btn btn-outline-secondary">
                <i class="bi bi-calendar3 me-1"></i> Planning
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4 g-3">
        <div class="col-md-4">
            <div class="card stat-card border-start border-primary border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-uppercase text-muted small mb-1">Modules Actifs</h6>
                            <h3 class="mb-0">{{ $affectations->count() }}</h3>
                        </div>
                        <div class="icon-circle bg-primary-light">
                            <i class="bi bi-journals text-primary"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-primary" style="width: {{ min(100, ($affectations->count()/10)*100) }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card border-start border-success border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-uppercase text-muted small mb-1">Heures Effectuées</h6>
                            <h3 class="mb-0">{{ $chargeTotale }}h</h3>
                        </div>
                        <div class="icon-circle bg-success-light">
                            <i class="bi bi-clock-history text-success"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-success" style="width: {{ min(100, ($chargeTotale/$chargeMinimale)*100) }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card border-start border-info border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-uppercase text-muted small mb-1">Groupes</h6>
                            <h3 class="mb-0">
                                {{ $affectations->sum(function($affectation) {
                                    return $affectation->ue->groupes_td + $affectation->ue->groupes_tp;
                                }) }}
                            </h3>
                        </div>
                        <div class="icon-circle bg-info-light">
                            <i class="bi bi-people text-info"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-info" style="width: 50%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Module Cards -->
    <div class="row g-4">
        @forelse($affectations as $affectation)
        <div class="col-lg-4 col-md-6">
            <div class="card module-card h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center border-bottom">
                    <div>
                        <span class="badge bg-{{ $affectation->ue->semestre == 'S1' || $affectation->ue->semestre == 'S3' || $affectation->ue->semestre == 'S5' ? 'primary' : 'warning' }}-light text-{{ $affectation->ue->semestre == 'S1' || $affectation->ue->semestre == 'S3' || $affectation->ue->semestre == 'S5' ? 'primary' : 'warning' }}">
                            {{ $affectation->ue->semestre }}
                        </span>
                        <h5 class="mb-0 mt-2">{{ $affectation->ue->nom }}</h5>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success">Actif</span>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <small class="text-muted d-block">Code</small>
                            <strong>{{ $affectation->ue->code }}</strong>
                        </div>
                        <div>
                            <small class="text-muted d-block">Volume</small>
                            <strong>
                                @switch($affectation->type_enseignement)
                                    @case('cours') {{ $affectation->ue->heures_cm }}h @break
                                    @case('td') {{ $affectation->ue->heures_td }}h @break
                                    @case('tp') {{ $affectation->ue->heures_tp }}h @break
                                @endswitch
                            </strong>
                        </div>
                        <div>
                            <small class="text-muted d-block">Type</small>
                            <strong>
                                @if($affectation->type_enseignement == 'cours') CM
                                @elseif($affectation->type_enseignement == 'td') TD
                                @else TP @endif
                            </strong>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <small class="text-muted d-block mb-1">Progression</small>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-{{ $affectation->progress_percentage == 100 ? 'success' : 'primary' }}" 
                                 style="width: {{ $affectation->progress_percentage }}%">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-1">
                            <small>{{ $affectation->charge_totale }}h effectuées</small>
                            <small>{{ $affectation->progress_percentage }}%</small>
                        </div>
                    </div>
                    
                    <div>
                        <small class="text-muted d-block mb-1">Groupes</small>
                        <div class="d-flex flex-wrap gap-2">
                            @php
                                $groupes = [];
                                if($affectation->type_enseignement == 'td' && $affectation->ue->groupes_td > 0) {
                                    for($i = 1; $i <= $affectation->ue->groupes_td; $i++) {
                                        $groupes[] = 'TD'.$i;
                                    }
                                } elseif($affectation->type_enseignement == 'tp' && $affectation->ue->groupes_tp > 0) {
                                    for($i = 1; $i <= $affectation->ue->groupes_tp; $i++) {
                                        $groupes[] = 'TP'.$i;
                                    }
                                }
                            @endphp
                            
                            @foreach($groupes as $groupe)
                                <span class="badge bg-primary bg-opacity-10 text-primary">{{ $groupe }}</span>
                            @endforeach
                            
                            @if(empty($groupes))
                                <span class="badge bg-secondary bg-opacity-10 text-secondary">Tous</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-top d-flex justify-content-between">

                    <i class="bi bi-eye me-1"></i> Détails
                    </a>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                            Actions
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-calendar-week me-2"></i> Planning</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-text me-2"></i> Notes</a></li>
                            <li><hr class="dropdown-divider"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i>
                Vous n'avez aucune affectation confirmée pour cette année universitaire.
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection