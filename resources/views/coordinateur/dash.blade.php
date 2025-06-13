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
                                Bienvenue, <span class="text-primary fw-bold">{{ Auth::user()->firstName }}</span> • Vue d'ensemble de votre filière
                            </p>
                        </div>
                        <div class="text-end">
                            <div class="badge bg-primary bg-gradient fs-6 px-3 py-2 mb-2">{{ Auth::user()->deparetement ?? 'Département' }}</div>
                            <div class="small text-muted">{{ now()->format('d/m/Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-lg modern-card stat-card-primary">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-primary bg-gradient">
                            <i class="bi bi-book-fill"></i>
                        </div>
                        <div class="ms-3">
                            <h3 class="stat-number text-dark mb-0">{{ $ues->count() }}</h3>
                            <p class="stat-label text-muted mb-0">Unités d'Enseignement</p>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 4px;">
                        <div class="progress-bar bg-primary" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-lg modern-card stat-card-success">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-success bg-gradient">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div class="ms-3">
                            <h3 class="stat-number text-dark mb-0">{{ $uesaffected->count() }}</h3>
                            <p class="stat-label text-muted mb-0">UE Affectées</p>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 4px;">
                        <div class="progress-bar bg-success" style="width: {{ $ues->count() > 0 ? ($uesaffected->count() / $ues->count()) * 100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-lg modern-card stat-card-info">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-info bg-gradient">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div class="ms-3">
                            <h3 class="stat-number text-dark mb-0">{{ $vacataire->count() }}</h3>
                            <p class="stat-label text-muted mb-0">Vacataires Actifs</p>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 4px;">
                        <div class="progress-bar bg-info" style="width: 85%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-lg modern-card stat-card-warning">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-warning bg-gradient">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                        </div>
                        <div class="ms-3">
                            <h3 class="stat-number text-dark mb-0">{{ $ues->where('responsable_id', null)->count() }}</h3>
                            <p class="stat-label text-muted mb-0">UE Vacantes</p>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 4px;">
                        <div class="progress-bar bg-warning" style="width: {{ $ues->count() > 0 ? ($ues->where('responsable_id', null)->count() / $ues->count()) * 100 : 0 }}%"></div>
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
                            <a href="{{ route('coordinateur.ues.create') }}" class="btn btn-outline-primary btn-lg w-100 modern-btn">
                                <i class="bi bi-plus-circle mb-2 d-block" style="font-size: 1.5rem;"></i>
                                <span class="small">Nouvelle UE</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <a href="{{ route('coordinateur.vacataire.create') }}" class="btn btn-outline-success btn-lg w-100 modern-btn">
                                <i class="bi bi-person-plus mb-2 d-block" style="font-size: 1.5rem;"></i>
                                <span class="small">Ajouter Vacataire</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <button class="btn btn-outline-info btn-lg w-100 modern-btn" data-bs-toggle="modal" data-bs-target="#importModal">
                                <i class="bi bi-cloud-upload mb-2 d-block" style="font-size: 1.5rem;"></i>
                                <span class="small">Importer</span>
                            </button>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <a href="{{ route('coordinateur.et') }}" class="btn btn-outline-warning btn-lg w-100 modern-btn">
                                <i class="bi bi-calendar-plus mb-2 d-block" style="font-size: 1.5rem;"></i>
                                <span class="small">Emploi du Temps</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <button class="btn btn-outline-secondary btn-lg w-100 modern-btn">
                                <i class="bi bi-file-earmark-pdf mb-2 d-block" style="font-size: 1.5rem;"></i>
                                <span class="small">Rapports</span>
                            </button>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <button class="btn btn-outline-danger btn-lg w-100 modern-btn">
                                <i class="bi bi-envelope mb-2 d-block" style="font-size: 1.5rem;"></i>
                                <span class="small">Notifications</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row g-4">
        <!-- UE List -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg modern-form-card">
                <div class="card-header bg-gradient-primary">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title text-white mb-0">
                            <i class="bi bi-list-ul me-2"></i>Unités d'Enseignement Récentes
                        </h5>
                        <a href="{{ route('coordinateur.ues.index') }}" class="btn btn-light btn-sm">
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
                                    <th class="border-0 px-4 py-3">Semestre</th>
                                    <th class="border-0 px-4 py-3">Statut</th>
                                    <th class="border-0 px-4 py-3 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ues->take(8) as $ue)
                                <tr class="border-0">
                                    <td class="px-4 py-3">
                                        <span class="fw-bold text-primary">{{ $ue->code }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="fw-semibold">{{ $ue->nom }}</div>
                                        <small class="text-muted">{{ $ue->annee_universitaire }}</small>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge bg-info bg-gradient">{{ $ue->semestre }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($ue->responsable_id)
                                            <span class="badge bg-success bg-gradient">
                                                <i class="bi bi-check-circle me-1"></i>Affectée
                                            </span>
                                        @else
                                            <span class="badge bg-warning bg-gradient">
                                                <i class="bi bi-exclamation-triangle me-1"></i>Vacante
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-end">
                                        <div class="btn-group">
                                            <a href="{{ route('coordinateur.ues.edit', $ue->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button class="btn btn-sm btn-outline-secondary">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="col-lg-4">
            <!-- Recent Activities -->
            <div class="card border-0 shadow-lg modern-form-card mb-4">
                <div class="card-header bg-gradient-success">
                    <h5 class="card-title text-white mb-0">
                        <i class="bi bi-activity me-2"></i>Activités Récentes
                    </h5>
                </div>
                <div class="card-body p-3">
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="d-flex align-items-start">
                                <div class="activity-icon bg-primary bg-gradient">
                                    <i class="bi bi-person-check"></i>
                                </div>
                                <div class="ms-3 flex-grow-1">
                                    <div class="fw-semibold">Nouvelle affectation</div>
                                    <div class="text-muted small">Dr. Martin assigné à Algorithmique</div>
                                    <div class="text-muted small">
                                        <i class="bi bi-clock me-1"></i>Il y a 2 heures
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="activity-item">
                            <div class="d-flex align-items-start">
                                <div class="activity-icon bg-success bg-gradient">
                                    <i class="bi bi-check-circle"></i>
                                </div>
                                <div class="ms-3 flex-grow-1">
                                    <div class="fw-semibold">UE validée</div>
                                    <div class="text-muted small">Base de Données - S4</div>
                                    <div class="text-muted small">
                                        <i class="bi bi-clock me-1"></i>Il y a 4 heures
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="activity-item">
                            <div class="d-flex align-items-start">
                                <div class="activity-icon bg-warning bg-gradient">
                                    <i class="bi bi-exclamation-triangle"></i>
                                </div>
                                <div class="ms-3 flex-grow-1">
                                    <div class="fw-semibold">UE en attente</div>
                                    <div class="text-muted small">Réseaux Informatiques</div>
                                    <div class="text-muted small">
                                        <i class="bi bi-clock me-1"></i>Il y a 1 jour
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="activity-item">
                            <div class="d-flex align-items-start">
                                <div class="activity-icon bg-info bg-gradient">
                                    <i class="bi bi-person-plus"></i>
                                </div>
                                <div class="ms-3 flex-grow-1">
                                    <div class="fw-semibold">Nouveau vacataire</div>
                                    <div class="text-muted small">Prof. Dubois ajouté</div>
                                    <div class="text-muted small">
                                        <i class="bi bi-clock me-1"></i>Il y a 2 jours
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 text-center">
                    <a href="#" class="btn btn-sm btn-outline-success">Voir toutes les activités</a>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="card border-0 shadow-lg modern-form-card">
                <div class="card-header bg-gradient-info">
                    <h5 class="card-title text-white mb-0">
                        <i class="bi bi-graph-up me-2"></i>Statistiques Rapides
                    </h5>
                </div>
                <div class="card-body p-3">
                    <div class="quick-stat-item">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Taux d'affectation</span>
                            <span class="fw-bold text-success">{{ $ues->count() > 0 ? round(($uesaffected->count() / $ues->count()) * 100) : 0 }}%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-success bg-gradient" style="width: {{ $ues->count() > 0 ? ($uesaffected->count() / $ues->count()) * 100 : 0 }}%"></div>
                        </div>
                    </div>

                    <div class="quick-stat-item">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">UE Vacantes</span>
                            <span class="fw-bold text-warning">{{ $ues->where('responsable_id', null)->count() }}</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-warning bg-gradient" style="width: {{ $ues->count() > 0 ? ($ues->where('responsable_id', null)->count() / $ues->count()) * 100 : 0 }}%"></div>
                        </div>
                    </div>

                    <div class="quick-stat-item">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Vacataires Actifs</span>
                            <span class="fw-bold text-info">{{ $vacataire->count() }}</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-info bg-gradient" style="width: 85%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Modern Base Styles */
body {
    background: linear-gradient(120deg, #f8fafc 0%, #e9ecef 100%);
    min-height: 100vh;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.main {
    background: transparent !important;
}

/* Modern Header */
.modern-header {
    background: rgba(255, 255, 255, 0.95) !important;
    border-radius: 20px !important;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

/* Modern Cards */
.modern-card {
    border-radius: 20px !important;
    transition: all 0.3s ease;
    animation: slideInUp 0.6s ease-out both;
    overflow: hidden;
}

.modern-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
}

/* Modern Form Card */
.modern-form-card {
    border-radius: 20px !important;
    overflow: hidden;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
}

.bg-gradient-success {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%) !important;
}

.bg-gradient-info {
    background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%) !important;
}

/* Statistics Cards */
.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    line-height: 1;
}

.stat-label {
    font-size: 0.9rem;
    font-weight: 500;
}

/* Modern Buttons */
.modern-btn {
    border-radius: 12px;
    font-weight: 600;
    padding: 1rem;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    text-align: center;
}

.modern-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

/* Modern Table */
.modern-table {
    border-radius: 15px;
    overflow: hidden;
}

.modern-table tbody tr {
    transition: all 0.3s ease;
}

.modern-table tbody tr:hover {
    background-color: rgba(102, 126, 234, 0.05);
    transform: translateX(5px);
}

/* Activity List */
.activity-list {
    max-height: 400px;
    overflow-y: auto;
}

.activity-item {
    padding: 1rem 0;
    border-bottom: 1px solid #e2e8f0;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
    flex-shrink: 0;
}

/* Quick Stats */
.quick-stat-item {
    padding: 1rem 0;
    border-bottom: 1px solid #e2e8f0;
}

.quick-stat-item:last-child {
    border-bottom: none;
}

/* Progress Bars */
.progress {
    border-radius: 10px;
    background-color: #e2e8f0;
}

.progress-bar {
    border-radius: 10px;
}

/* Animations */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .modern-btn {
        padding: 0.75rem;
        font-size: 0.875rem;
    }

    .stat-number {
        font-size: 1.5rem;
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        font-size: 1.25rem;
    }
}

/* Custom Scrollbar */
.activity-list::-webkit-scrollbar {
    width: 6px;
}

.activity-list::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.activity-list::-webkit-scrollbar-thumb {
    background: #cbd5e0;
    border-radius: 10px;
}

.activity-list::-webkit-scrollbar-thumb:hover {
    background: #a0aec0;
}
</style>
@endpush