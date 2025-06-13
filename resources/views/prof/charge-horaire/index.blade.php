@extends('layouts.app')

@section('title', 'Gestion des Charges Horaires')

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
                                <i class="bi bi-clock-history text-primary me-3"></i>
                                Gestion des Charges Horaires
                            </h1>
                            <p class="text-muted mb-0 fs-5">
                                Suivez et gérez vos <span class="text-primary fw-bold">affectations</span> d'enseignement
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
                            <button class="btn btn-outline-success btn-lg w-100 modern-btn" data-bs-toggle="modal" data-bs-target="#reportModal">
                                <i class="bi bi-file-earmark-pdf mb-2 d-block" style="font-size: 1.5rem;"></i>
                                <span class="small">Générer Rapport</span>
                            </button>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <button class="btn btn-outline-info btn-lg w-100 modern-btn">
                                <i class="bi bi-calendar-week mb-2 d-block" style="font-size: 1.5rem;"></i>
                                <span class="small">Planning</span>
                            </button>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <button class="btn btn-outline-warning btn-lg w-100 modern-btn">
                                <i class="bi bi-graph-up mb-2 d-block" style="font-size: 1.5rem;"></i>
                                <span class="small">Statistiques</span>
                            </button>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <button class="btn btn-outline-secondary btn-lg w-100 modern-btn">
                                <i class="bi bi-clock-history mb-2 d-block" style="font-size: 1.5rem;"></i>
                                <span class="small">Historique</span>
                            </button>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <button class="btn btn-outline-dark btn-lg w-100 modern-btn">
                                <i class="bi bi-gear mb-2 d-block" style="font-size: 1.5rem;"></i>
                                <span class="small">Paramètres</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-lg modern-stat-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-{{ ($alerteCharge ?? false) ? 'warning' : 'success' }} bg-gradient">
                            <i class="bi bi-{{ ($alerteCharge ?? false) ? 'exclamation-triangle' : 'check-circle' }} text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h3 class="mb-0 fw-bold text-dark">{{ $chargeTotale ?? 0 }}h</h3>
                            <p class="text-muted mb-0 small">Charge Totale</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-{{ ($alerteCharge ?? false) ? 'warning' : 'success' }}"
                                     style="width: {{ min(100, (($chargeTotale ?? 0) / ($chargeMinimale ?? 192)) * 100) }}%"></div>
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
                        <div class="stat-icon bg-primary bg-gradient">
                            <i class="bi bi-journal-bookmark text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h3 class="mb-0 fw-bold text-dark">{{ $affectations->count() }}</h3>
                            <p class="text-muted mb-0 small">Affectations</p>
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
                        <div class="stat-icon bg-info bg-gradient">
                            <i class="bi bi-person-video3 text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h3 class="mb-0 fw-bold text-dark">
                                {{ $affectations->where('type_enseignement', 'cours')->sum('charge_totale') }}h
                            </h3>
                            <p class="text-muted mb-0 small">Heures CM</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-info" style="width: 75%"></div>
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
                        <div class="stat-icon bg-secondary bg-gradient">
                            <i class="bi bi-people text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h3 class="mb-0 fw-bold text-dark">
                                {{ $affectations->whereIn('type_enseignement', ['td', 'tp'])->sum('charge_totale') }}h
                            </h3>
                            <p class="text-muted mb-0 small">Heures TD/TP</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-secondary" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charge Status Alert -->
    @if($alerteCharge ?? false)
    <div class="alert alert-warning border-0 shadow-sm mb-4">
        <div class="d-flex align-items-center">
            <div class="icon-circle bg-warning-light me-3">
                <i class="bi bi-exclamation-triangle text-warning"></i>
            </div>
            <div>
                <h6 class="alert-heading mb-1">Charge horaire insuffisante</h6>
                <p class="mb-0">
                    Vous n'avez pas atteint la charge minimale requise de {{ $chargeMinimale ?? 192 }}h.
                    Il vous manque <strong>{{ ($chargeMinimale ?? 192) - ($chargeTotale ?? 0) }}h</strong>.
                </p>
            </div>
        </div>
    </div>
    @endif

    <!-- Affectations List -->
    <div class="row g-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-dark">
                        <i class="bi bi-list-check me-2"></i>Mes Affectations
                    </h5>
                    <div class="d-flex gap-2">
                        <div class="input-group" style="width: 250px;">
                            <span class="input-group-text">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Rechercher..." id="searchInput">
                        </div>
                        <select class="form-select" style="width: 150px;" id="typeFilter">
                            <option value="">Tous types</option>
                            <option value="cours">CM</option>
                            <option value="td">TD</option>
                            <option value="tp">TP</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    @if($affectations->isEmpty())
                        <div class="text-center py-5">
                            <div class="icon-circle bg-muted-light mx-auto mb-3">
                                <i class="bi bi-journal-x text-muted fs-1"></i>
                            </div>
                            <h5 class="text-muted">Aucune affectation</h5>
                            <p class="text-muted mb-3">Vous n'avez aucune affectation d'enseignement pour cette année.</p>
                            <a href="{{ route('charge-horaire.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-1"></i>Créer une affectation
                            </a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle" id="affectationsTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-0">Module</th>
                                        <th class="border-0">Type</th>
                                        <th class="border-0">Charge</th>
                                        <th class="border-0">Progression</th>
                                        <th class="border-0">Statut</th>
                                        <th class="border-0">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($affectations as $affectation)
                                    <tr>
                                        <td>
                                            <div>
                                                <div class="fw-semibold">{{ $affectation->ue->nom }}</div>
                                                <small class="text-muted">{{ $affectation->ue->code }} - S{{ $affectation->ue->semestre }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $affectation->type_enseignement == 'cours' ? 'primary' : ($affectation->type_enseignement == 'td' ? 'info' : 'secondary') }}">
                                                {{ strtoupper($affectation->type_enseignement) }}
                                            </span>
                                        </td>
                                        <td>
                                            <strong>{{ $affectation->charge_totale }}h</strong>
                                        </td>
                                        <td>
                                            @php
                                                $progress = rand(60, 100); // Replace with actual progress calculation
                                            @endphp
                                            <div class="progress" style="height: 6px; width: 80px;">
                                                <div class="progress-bar bg-{{ $progress == 100 ? 'success' : 'primary' }}"
                                                     style="width: {{ $progress }}%"></div>
                                            </div>
                                            <small class="text-muted">{{ $progress }}%</small>
                                        </td>
                                        <td>
                                            @php
                                                $status = rand(1, 3);
                                                $statusClass = $status == 1 ? 'success' : ($status == 2 ? 'warning' : 'info');
                                                $statusText = $status == 1 ? 'Terminé' : ($status == 2 ? 'En cours' : 'Planifié');
                                                $statusIcon = $status == 1 ? 'check-circle' : ($status == 2 ? 'clock' : 'calendar');
                                            @endphp
                                            <span class="badge bg-{{ $statusClass }}-light text-{{ $statusClass }}">
                                                <i class="bi bi-{{ $statusIcon }} me-1"></i>{{ $statusText }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-outline-primary show-details"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detailsModal"
                                                        data-affectation-id="{{ $affectation->id }}"
                                                        title="Voir détails">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <button class="btn btn-outline-success" title="Planning">
                                                    <i class="bi bi-calendar-week"></i>
                                                </button>
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-outline-secondary dropdown-toggle"
                                                            data-bs-toggle="dropdown">
                                                        <i class="bi bi-three-dots"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#">
                                                            <i class="bi bi-pencil me-2"></i>Modifier
                                                        </a></li>
                                                        <li><a class="dropdown-item" href="#">
                                                            <i class="bi bi-file-earmark-text me-2"></i>Rapport
                                                        </a></li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li><a class="dropdown-item text-danger" href="#">
                                                            <i class="bi bi-trash me-2"></i>Supprimer
                                                        </a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div class="text-muted">
                                Affichage de {{ $affectations->count() }} affectation(s)
                            </div>
                            @if($affectations->hasPages())
                                {{ $affectations->links() }}
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Details Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="bi bi-info-circle me-2"></i>Détails de l'Affectation
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modalDetailsContent">
                <!-- Content loaded via AJAX -->
                <div class="text-center my-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Chargement...</span>
                    </div>
                    <p class="text-muted mt-3">Chargement des détails...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i>Fermer
                </button>
                <button type="button" class="btn btn-primary">
                    <i class="bi bi-download me-1"></i>Exporter
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Report Modal -->
<div class="modal fade" id="reportModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">
                    <i class="bi bi-file-earmark-pdf me-2"></i>Générer un Rapport
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="reportForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Type de rapport</label>
                            <select class="form-select" name="report_type">
                                <option value="summary">Résumé annuel</option>
                                <option value="detailed">Détaillé par module</option>
                                <option value="monthly">Répartition mensuelle</option>
                                <option value="comparison">Comparaison années</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Format</label>
                            <select class="form-select" name="format">
                                <option value="pdf">PDF</option>
                                <option value="excel">Excel</option>
                                <option value="csv">CSV</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Année universitaire</label>
                            <select class="form-select" name="academic_year">
                                <option value="{{ date('Y') }}-{{ date('Y')+1 }}">{{ date('Y') }}-{{ date('Y')+1 }}</option>
                                <option value="{{ date('Y')-1 }}-{{ date('Y') }}">{{ date('Y')-1 }}-{{ date('Y') }}</option>
                                <option value="{{ date('Y')-2 }}-{{ date('Y')-1 }}">{{ date('Y')-2 }}-{{ date('Y')-1 }}</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Inclure</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="include_stats" checked>
                                <label class="form-check-label">Statistiques</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="include_charts" checked>
                                <label class="form-check-label">Graphiques</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-info" id="generateReportBtn">
                    <i class="bi bi-file-earmark-pdf me-1"></i>Générer
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.icon-circle {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.bg-primary-light {
    background-color: rgba(13, 110, 253, 0.1);
}

.bg-success-light {
    background-color: rgba(25, 135, 84, 0.1);
}

.bg-warning-light {
    background-color: rgba(255, 193, 7, 0.1);
}

.bg-info-light {
    background-color: rgba(13, 202, 240, 0.1);
}

.bg-secondary-light {
    background-color: rgba(108, 117, 125, 0.1);
}

.bg-muted-light {
    background-color: rgba(108, 117, 125, 0.1);
}

.card {
    border-radius: 12px;
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-2px);
}

.btn {
    border-radius: 8px;
}

.progress {
    border-radius: 10px;
}

.badge {
    font-size: 0.75rem;
    padding: 0.375rem 0.75rem;
}

.table th {
    font-weight: 600;
    color: #495057;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Details modal handler
    document.querySelectorAll('.show-details').forEach(function(button) {
        button.addEventListener('click', function() {
            const affectationId = this.getAttribute('data-affectation-id');
            const modalContent = document.getElementById('modalDetailsContent');

            // Show loading state
            modalContent.innerHTML = `
                <div class="text-center my-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Chargement...</span>
                    </div>
                    <p class="text-muted mt-3">Chargement des détails...</p>
                </div>
            `;

            // Simulate loading (replace with actual AJAX call)
            setTimeout(function() {
                modalContent.innerHTML = `
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card border-0 bg-light">
                                <div class="card-body">
                                    <h6 class="text-primary mb-3">Informations Générales</h6>
                                    <div class="row g-2">
                                        <div class="col-6"><strong>Module:</strong></div>
                                        <div class="col-6">Algorithmique</div>
                                        <div class="col-6"><strong>Code:</strong></div>
                                        <div class="col-6">INF101</div>
                                        <div class="col-6"><strong>Type:</strong></div>
                                        <div class="col-6">CM</div>
                                        <div class="col-6"><strong>Charge:</strong></div>
                                        <div class="col-6">24h</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 bg-light">
                                <div class="card-body">
                                    <h6 class="text-success mb-3">Progression</h6>
                                    <div class="progress mb-3" style="height: 10px;">
                                        <div class="progress-bar bg-success" style="width: 75%"></div>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-6"><strong>Effectué:</strong></div>
                                        <div class="col-6">18h</div>
                                        <div class="col-6"><strong>Restant:</strong></div>
                                        <div class="col-6">6h</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <h6 class="text-info mb-3">Séances Planifiées</h6>
                            <div class="table-responsive">
                                <table class="table table-sm table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Date</th>
                                            <th>Heure</th>
                                            <th>Salle</th>
                                            <th>Durée</th>
                                            <th>Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>15/01/2025</td>
                                            <td>08:00 - 10:00</td>
                                            <td>A101</td>
                                            <td>2h</td>
                                            <td><span class="badge bg-success">Effectué</span></td>
                                        </tr>
                                        <tr>
                                            <td>22/01/2025</td>
                                            <td>08:00 - 10:00</td>
                                            <td>A101</td>
                                            <td>2h</td>
                                            <td><span class="badge bg-warning">Planifié</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                `;
            }, 1000);
        });
    });

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const typeFilter = document.getElementById('typeFilter');
    const table = document.getElementById('affectationsTable');

    if (searchInput && table) {
        searchInput.addEventListener('input', filterTable);
        typeFilter.addEventListener('change', filterTable);

        function filterTable() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedType = typeFilter.value.toLowerCase();
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(function(row) {
                const text = row.textContent.toLowerCase();
                const typeCell = row.querySelector('td:nth-child(2)');
                const type = typeCell ? typeCell.textContent.toLowerCase() : '';

                const matchesSearch = text.includes(searchTerm);
                const matchesType = !selectedType || type.includes(selectedType);

                row.style.display = matchesSearch && matchesType ? '' : 'none';
            });
        }
    }

    // Report generation
    document.getElementById('generateReportBtn')?.addEventListener('click', function() {
        // Simulate report generation
        this.innerHTML = '<i class="bi bi-hourglass-split me-1"></i>Génération...';
        this.disabled = true;

        setTimeout(() => {
            this.innerHTML = '<i class="bi bi-check-circle me-1"></i>Téléchargé!';
            setTimeout(() => {
                this.innerHTML = '<i class="bi bi-file-earmark-pdf me-1"></i>Générer';
                this.disabled = false;
                bootstrap.Modal.getInstance(document.getElementById('reportModal')).hide();
            }, 1500);
        }, 2000);
    });
});
</script>

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
    border: 2px solid #e9ecef;
}

.modern-input .input-group-text {
    border-radius: 15px 0 0 15px !important;
    border: 2px solid #e9ecef;
    border-right: none;
}

.form-select {
    border-radius: 15px !important;
    padding: 12px 16px;
    border: 2px solid #e9ecef;
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

.alert {
    border-radius: 15px !important;
}

.modal-content {
    border-radius: 20px !important;
    overflow: hidden;
}

.btn-group .btn {
    border-radius: 8px !important;
}

.btn-group .btn:not(:last-child) {
    margin-right: 2px;
}
</style>
@endsection
