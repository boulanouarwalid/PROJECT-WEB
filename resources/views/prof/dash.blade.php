@extends('layouts.app')

@section('title', 'Tableau de Bord')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg modern-header">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="display-6 fw-bold text-dark mb-2">
                                <i class="bi bi-speedometer2 text-primary me-3"></i>
                                Tableau de Bord
                            </h1>
                            <p class="text-muted mb-0 fs-5">
                                Bienvenue, <span class="text-primary fw-bold">{{ auth()->user()->firstName }}</span> • Espace Enseignant
                            </p>
                        </div>
                        <div class="text-end">
                            <div class="badge bg-primary bg-gradient fs-6 px-3 py-2 mb-2">{{ auth()->user()->deparetement ?? 'Enseignant' }}</div>
                            <div class="small text-muted">{{ now()->format('d/m/Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-lg modern-stat-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-primary bg-gradient">
                            <i class="bi bi-clock-history text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h3 class="mb-0 fw-bold text-dark">192h</h3>
                            <p class="text-muted mb-0 small">Charge Horaire</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-primary" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-lg modern-stat-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-success bg-gradient">
                            <i class="bi bi-journal-bookmark text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h3 class="mb-0 fw-bold text-dark">8</h3>
                            <p class="text-muted mb-0 small">Modules Actifs</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-success" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-lg modern-stat-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-warning bg-gradient">
                            <i class="bi bi-star text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h3 class="mb-0 fw-bold text-dark">3</h3>
                            <p class="text-muted mb-0 small">Souhaits</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-warning" style="width: 60%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-lg modern-stat-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-info bg-gradient">
                            <i class="bi bi-file-earmark-text text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h3 class="mb-0 fw-bold text-dark">5</h3>
                            <p class="text-muted mb-0 small">Notes à uploader</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-info" style="width: 40%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg modern-form-card">
                <div class="card-header bg-gradient-primary">
                    <h5 class="card-title text-white mb-0">
                        <i class="bi bi-lightning-fill me-2"></i>Actions Rapides
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <a href="{{ route('charge-horaire.create') }}" class="btn btn-outline-primary btn-lg w-100 modern-btn">
                                <i class="bi bi-plus-circle mb-2 d-block" style="font-size: 1.5rem;"></i>
                                <span class="small">Nouvelle Affectation</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <a href="{{ route('prof.notes') }}" class="btn btn-outline-success btn-lg w-100 modern-btn">
                                <i class="bi bi-upload mb-2 d-block" style="font-size: 1.5rem;"></i>
                                <span class="small">Uploader Notes</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <a href="{{ route('prof.ues') }}" class="btn btn-outline-warning btn-lg w-100 modern-btn">
                                <i class="bi bi-star mb-2 d-block" style="font-size: 1.5rem;"></i>
                                <span class="small">Exprimer Souhaits</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <a href="{{ route('prof.historique') }}" class="btn btn-outline-info btn-lg w-100 modern-btn">
                                <i class="bi bi-clock-history mb-2 d-block" style="font-size: 1.5rem;"></i>
                                <span class="small">Historique</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <a href="{{ route('prof.modules') }}" class="btn btn-outline-secondary btn-lg w-100 modern-btn">
                                <i class="bi bi-journal-bookmark mb-2 d-block" style="font-size: 1.5rem;"></i>
                                <span class="small">Mes Modules</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <a href="{{ route('prof.chargehoraire') }}" class="btn btn-outline-dark btn-lg w-100 modern-btn">
                                <i class="bi bi-graph-up mb-2 d-block" style="font-size: 1.5rem;"></i>
                                <span class="small">Charge Horaire</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row g-4">
        <!-- Recent Modules -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg modern-form-card">
                <div class="card-header bg-gradient-primary">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title text-white mb-0">
                            <i class="bi bi-list-ul me-2"></i>Mes Modules Récents
                        </h5>
                        <a href="{{ route('prof.modules') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-arrow-right me-1"></i>Voir tout
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 modern-table">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0 px-4 py-3">Code UE</th>
                                    <th class="border-0 px-4 py-3">Intitulé</th>
                                    <th class="border-0 px-4 py-3">Type</th>
                                    <th class="border-0 px-4 py-3">Volume</th>
                                    <th class="border-0 px-4 py-3">Progression</th>
                                    <th class="border-0 px-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Sample data - replace with dynamic content -->
                                <tr class="border-0">
                                    <td class="px-4 py-3">
                                        <span class="badge bg-primary bg-gradient text-white fw-bold">INF101</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div>
                                            <div class="fw-semibold text-dark">Algorithmique</div>
                                            <small class="text-muted">S1 - INFO1</small>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge bg-secondary bg-gradient">CM</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="fw-bold text-dark">24h</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="progress mb-1" style="height: 6px;">
                                            <div class="progress-bar bg-success bg-gradient" style="width: 75%"></div>
                                        </div>
                                        <small class="text-muted">75% (18h/24h)</small>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary" title="Détails">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-success" title="Notes">
                                                <i class="bi bi-file-earmark-text"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="border-0">
                                    <td colspan="6" class="px-4 py-5 text-center">
                                        <div class="text-muted">
                                            <i class="bi bi-info-circle me-2"></i>
                                            Connectez-vous pour voir vos modules actuels
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-lg modern-form-card">
                <div class="card-header bg-gradient-success">
                    <h5 class="card-title text-white mb-0">
                        <i class="bi bi-graph-up me-2"></i>Résumé Rapide
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Charge totale</span>
                        <span class="fw-bold text-dark">192h / 200h</span>
                    </div>
                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar bg-success bg-gradient" style="width: 96%"></div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Modules actifs</span>
                        <span class="fw-bold text-dark">8</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Notes uploadées</span>
                        <span class="fw-bold text-dark">12 / 16</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Souhaits en attente</span>
                        <span class="fw-bold text-warning">3</span>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="card border-0 shadow-lg modern-form-card mt-4">
                <div class="card-header bg-gradient-info">
                    <h5 class="card-title text-white mb-0">
                        <i class="bi bi-clock-history me-2"></i>Activité Récente
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Notes uploadées</h6>
                                <p class="text-muted small mb-0">Algorithmique - Session normale</p>
                                <small class="text-muted">Il y a 2 heures</small>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Nouvelle affectation</h6>
                                <p class="text-muted small mb-0">Base de données - TD</p>
                                <small class="text-muted">Hier</small>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-warning"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Souhait exprimé</h6>
                                <p class="text-muted small mb-0">Programmation Web</p>
                                <small class="text-muted">Il y a 3 jours</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Coordinateur-style CSS */
.modern-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 20px !important;
    transition: all 0.3s ease;
}

.modern-stat-card {
    border-radius: 20px !important;
    transition: all 0.3s ease;
    overflow: hidden;
}

.modern-stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.modern-form-card {
    border-radius: 20px !important;
    overflow: hidden;
    transition: all 0.3s ease;
}

.modern-form-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
}

.bg-gradient-success {
    background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%) !important;
}

.bg-gradient-info {
    background: linear-gradient(135deg, #17a2b8 0%, #117a8b 100%) !important;
}

.modern-btn {
    border-radius: 15px !important;
    transition: all 0.3s ease;
    border: 2px solid;
    font-weight: 600;
}

.modern-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.modern-table {
    font-size: 0.95rem;
}

.modern-table th {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 0.5px;
    color: #6c757d;
}

.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-item:last-child {
    margin-bottom: 0;
}

.timeline-marker {
    position: absolute;
    left: -35px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 3px solid #fff;
    box-shadow: 0 0 0 2px #dee2e6;
}

.timeline-item:before {
    content: '';
    position: absolute;
    left: -30px;
    top: 17px;
    width: 2px;
    height: calc(100% + 8px);
    background: #dee2e6;
}

.timeline-item:last-child:before {
    display: none;
}

.timeline-content h6 {
    font-size: 0.9rem;
    font-weight: 600;
}

.timeline-content p {
    font-size: 0.85rem;
    margin-bottom: 2px;
}

.timeline-content small {
    font-size: 0.75rem;
}

.progress {
    border-radius: 10px;
}

.badge {
    border-radius: 8px;
    font-weight: 600;
}

.card-header {
    border-bottom: none !important;
}

.btn-group .btn {
    border-radius: 8px !important;
}

.btn-group .btn:not(:last-child) {
    margin-right: 2px;
}
</style>
@endsection