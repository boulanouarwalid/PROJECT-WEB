@extends('layouts.app')

@section('title', 'Historique des Affectations')

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
                                <i class="bi bi-clock-history text-info me-3"></i>
                                Historique des Affectations
                            </h1>
                            <p class="text-muted mb-0 fs-5">
                                Consultez vos <span class="text-info fw-bold">affectations passées</span> • Suivi de votre parcours d'enseignement
                            </p>
                        </div>
                        <div class="text-end">
                            <div class="badge bg-info bg-gradient fs-6 px-3 py-2 mb-2">{{ auth()->user()->deparetement ?? 'Enseignant' }}</div>
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
                            <i class="bi bi-calendar-range text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h3 class="mb-0 fw-bold text-dark">5</h3>
                            <p class="text-muted mb-0 small">Années d'enseignement</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-primary" style="width: 100%"></div>
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
                            <h3 class="mb-0 fw-bold text-dark">42</h3>
                            <p class="text-muted mb-0 small">Modules enseignés</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-success" style="width: 85%"></div>
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
                            <i class="bi bi-clock text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h3 class="mb-0 fw-bold text-dark">1,248h</h3>
                            <p class="text-muted mb-0 small">Heures totales</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-info" style="width: 90%"></div>
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
                            <i class="bi bi-graph-up text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h3 class="mb-0 fw-bold text-dark">249h</h3>
                            <p class="text-muted mb-0 small">Moyenne par an</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-warning" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row g-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg modern-form-card">
                <div class="card-header bg-gradient-info">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title text-white mb-0">
                            <i class="bi bi-list-ul me-2"></i>Historique Détaillé (5 Dernières Années)
                        </h5>
                        <div class="d-flex gap-2">
                            <button class="btn btn-light btn-sm">
                                <i class="bi bi-download me-1"></i>Exporter
                            </button>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-light active" data-view="table">
                                    <i class="bi bi-table"></i>
                                </button>
                                <button class="btn btn-outline-light" data-view="timeline">
                                    <i class="bi bi-clock-history"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <!-- Search and Filter Bar -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="input-group modern-input">
                                <span class="input-group-text bg-light border-0">
                                    <i class="bi bi-search text-muted"></i>
                                </span>
                                <input type="text" class="form-control border-0 bg-light" placeholder="Rechercher un module...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select border-0 bg-light">
                                <option value="">Toutes les années</option>
                                <option value="2024-2025">2024-2025</option>
                                <option value="2023-2024">2023-2024</option>
                                <option value="2022-2023">2022-2023</option>
                                <option value="2021-2022">2021-2022</option>
                                <option value="2020-2021">2020-2021</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select border-0 bg-light">
                                <option value="">Tous les types</option>
                                <option value="cours">Cours (CM)</option>
                                <option value="td">Travaux Dirigés (TD)</option>
                                <option value="tp">Travaux Pratiques (TP)</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-info w-100 modern-btn">
                                <i class="bi bi-funnel me-1"></i>Filtrer
                            </button>
                        </div>
                    </div>

                    <!-- Table View -->
                    <div id="tableView" class="table-responsive">
                        <table class="table table-hover mb-0 modern-table">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0 px-4 py-3">Année Universitaire</th>
                                    <th class="border-0 px-4 py-3">Module</th>
                                    <th class="border-0 px-4 py-3">Type</th>
                                    <th class="border-0 px-4 py-3">Volume</th>
                                    <th class="border-0 px-4 py-3">Statut</th>
                                    <th class="border-0 px-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Sample data - replace with dynamic content -->
                                <tr class="border-0">
                                    <td class="px-4 py-3">
                                        <span class="badge bg-primary bg-gradient text-white fw-bold">2024-2025</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div>
                                            <div class="fw-semibold text-dark">Algorithmique Avancée</div>
                                            <small class="text-muted">INF301 - S5</small>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge bg-secondary bg-gradient">CM</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="fw-bold text-dark">24h</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge bg-success bg-gradient">Terminé</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary" title="Détails">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-info" title="Rapport">
                                                <i class="bi bi-file-earmark-text"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="border-0">
                                    <td class="px-4 py-3">
                                        <span class="badge bg-primary bg-gradient text-white fw-bold">2023-2024</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div>
                                            <div class="fw-semibold text-dark">Base de Données</div>
                                            <small class="text-muted">INF201 - S3</small>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge bg-info bg-gradient">TD</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="fw-bold text-dark">36h</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge bg-success bg-gradient">Terminé</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary" title="Détails">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-info" title="Rapport">
                                                <i class="bi bi-file-earmark-text"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="border-0">
                                    <td colspan="6" class="px-4 py-5 text-center">
                                        <div class="text-muted">
                                            <i class="bi bi-info-circle me-2"></i>
                                            Aucune donnée historique disponible pour le moment
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted">
                            Affichage de 1 à 10 sur 25 résultats
                        </div>
                        <nav>
                            <ul class="pagination pagination-sm mb-0">
                                <li class="page-item disabled">
                                    <span class="page-link">Précédent</span>
                                </li>
                                <li class="page-item active">
                                    <span class="page-link">1</span>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Suivant</a>
                                </li>
                            </ul>
                        </nav>
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

.modern-input .form-control {
    border-radius: 15px !important;
    padding: 12px 16px;
}

.modern-input .input-group-text {
    border-radius: 15px 0 0 15px !important;
    border: none;
}

.form-select {
    border-radius: 15px !important;
    padding: 12px 16px;
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

.pagination .page-link {
    border-radius: 8px !important;
    margin: 0 2px;
    border: none;
}

.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #17a2b8 0%, #117a8b 100%);
    border: none;
}
</style>
@endsection