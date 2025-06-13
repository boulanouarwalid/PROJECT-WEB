@extends('layouts.app')

@section('title', "Historique des UEs")

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
                                Historique des UEs
                            </h1>
                            <p class="text-muted mb-0 fs-5">
                                Consultation de l'historique des UEs • <span class="text-info fw-bold">{{ $logs ? $logs->total() : 0 }}</span> UEs trouvées
                                @if($departement ?? false)
                                    • Département: <span class="text-primary fw-bold">{{ $departement->nom }}</span>
                                @endif
                                @if($logs && $logs->hasPages())
                                    • Page <span class="text-warning fw-bold">{{ $logs->currentPage() }}</span> sur {{ $logs->lastPage() }}
                                @endif
                            </p>
                        </div>
                        <div class="text-end">
                            <div class="badge bg-info bg-gradient fs-6 px-3 py-2 mb-2">Historique</div>
                            <div class="small text-muted">{{ now()->format('d/m/Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    @if($logs && $logs->total() > 0)
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="stat-icon bg-primary bg-gradient text-white mb-3">
                        <i class="bi bi-book"></i>
                    </div>
                    <h3 class="fw-bold text-primary">{{ $logs->total() }}</h3>
                    <p class="text-muted mb-0">Total UEs</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="stat-icon bg-success bg-gradient text-white mb-3">
                        <i class="bi bi-person-check"></i>
                    </div>
                    <h3 class="fw-bold text-success">{{ $logs->where('est_vacant', false)->count() }}</h3>
                    <p class="text-muted mb-0">UEs Affectées</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="stat-icon bg-warning bg-gradient text-white mb-3">
                        <i class="bi bi-person-x"></i>
                    </div>
                    <h3 class="fw-bold text-warning">{{ $logs->where('est_vacant', true)->count() }}</h3>
                    <p class="text-muted mb-0">UEs Vacantes</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="stat-icon bg-info bg-gradient text-white mb-3">
                        <i class="bi bi-calendar-range"></i>
                    </div>
                    <h3 class="fw-bold text-info">{{ $logs->unique('annee_universitaire')->count() }}</h3>
                    <p class="text-muted mb-0">Années</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Search and Filters -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg modern-form-card">
                <div class="card-header bg-gradient-primary">
                    <h5 class="card-title text-white mb-0">
                        <i class="bi bi-search me-2"></i>Recherche et Filtres
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form method="GET" action="{{ route('coordinateur.historique') }}" class="row g-3">
                        <div class="col-lg-4 col-md-6">
                            <label for="search" class="form-label fw-semibold">Rechercher une UE</label>
                            <div class="input-group modern-input">
                                <span class="input-group-text">
                                   <i class="bi bi-search text-primary"></i>
                                </span>
                                <input type="text" class="form-control" id="search" name="search"
                                       placeholder="Nom ou code de l'UE..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3">
                            <label for="annee" class="form-label fw-semibold">Année</label>
                            <select class="form-select modern-select" id="annee" name="annee">
                                <option value="">Toutes</option>
                                <option value="2024-2025" {{ request('annee') === '2024-2025' ? 'selected' : '' }}>2024-2025</option>
                                <option value="2023-2024" {{ request('annee') === '2023-2024' ? 'selected' : '' }}>2023-2024</option>
                                <option value="2022-2023" {{ request('annee') === '2022-2023' ? 'selected' : '' }}>2022-2023</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-3">
                            <label for="semestre" class="form-label fw-semibold">Semestre</label>
                            <select class="form-select modern-select" id="semestre" name="semestre">
                                <option value="">Tous</option>
                                <option value="S1" {{ request('semestre') === 'S1' ? 'selected' : '' }}>S1</option>
                                <option value="S2" {{ request('semestre') === 'S2' ? 'selected' : '' }}>S2</option>
                                <option value="S3" {{ request('semestre') === 'S3' ? 'selected' : '' }}>S3</option>
                                <option value="S4" {{ request('semestre') === 'S4' ? 'selected' : '' }}>S4</option>
                                <option value="S5" {{ request('semestre') === 'S5' ? 'selected' : '' }}>S5</option>
                                <option value="S6" {{ request('semestre') === 'S6' ? 'selected' : '' }}>S6</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <label for="status" class="form-label fw-semibold">Statut</label>
                            <select class="form-select modern-select" id="status" name="status">
                                <option value="">Tous</option>
                                <option value="affecte" {{ request('status') === 'affecte' ? 'selected' : '' }}>Affecté</option>
                                <option value="vacant" {{ request('status') === 'vacant' ? 'selected' : '' }}>Vacant</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-6 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary btn-lg w-100 modern-btn">
                                <i class="bi bi-search me-2"></i>Filtrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- History Table -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg modern-form-card">
                <div class="card-header bg-gradient-info">
                    <h5 class="card-title text-white mb-0">
                        <i class="bi bi-table me-2"></i>Historique détaillé
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 600px;">
                        <table class="table table-hover mb-0 modern-table">
                            <thead class="table-light sticky-top">
                                <tr>
                                    <th class="border-0 px-4 py-3">
                                        <i class="bi bi-book me-2"></i>Unité d'Enseignement
                                    </th>
                                    <th class="border-0 px-4 py-3">
                                        <i class="bi bi-code-square me-2"></i>Code UE
                                    </th>
                                    <th class="border-0 px-4 py-3">
                                        <i class="bi bi-diagram-3 me-2"></i>Filière
                                    </th>
                                    <th class="border-0 px-4 py-3">
                                        <i class="bi bi-calendar-week me-2"></i>Semestre
                                    </th>
                                    <th class="border-0 px-4 py-3">
                                        <i class="bi bi-calendar me-2"></i>Année universitaire
                                    </th>
                                    <th class="border-0 px-4 py-3">
                                        <i class="bi bi-person me-2"></i>Responsable
                                    </th>
                                    <th class="border-0 px-4 py-3">
                                        <i class="bi bi-clock me-2"></i>Volume horaire
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($logs ?? [] as $ue)
                                    <tr class="border-0 history-row">
                                        <td class="px-4 py-3">
                                            <div class="ue-name-container">
                                                <div class="fw-semibold text-primary ue-name-scrollable" title="{{ $ue->nom }}">
                                                    {{ $ue->nom }}
                                                </div>
                                                <small class="text-muted">
                                                    <i class="bi bi-layers me-1"></i>
                                                    @if($ue->est_vacant)
                                                        <span class="text-warning">Vacant</span>
                                                    @else
                                                        <span class="text-success">Affecté</span>
                                                    @endif
                                                </small>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="code-badge">
                                                <span class="badge bg-primary bg-gradient">{{ $ue->code }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div>
                                                <div class="fw-semibold">{{ $ue->filiere->nom ?? 'Non définie' }}</div>
                                                <small class="text-muted">
                                                    @if($ue->niveau)
                                                        Niveau: {{ $ue->niveau->nom }}
                                                    @else
                                                        Niveau non défini
                                                    @endif
                                                </small>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="badge
                                                @if(in_array($ue->semestre, ['S1', 'S2'])) bg-info bg-gradient
                                                @elseif(in_array($ue->semestre, ['S3', 'S4'])) bg-warning bg-gradient
                                                @else bg-success bg-gradient
                                                @endif">
                                                {{ $ue->semestre }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <div class="year-badge bg-info bg-gradient text-white me-2">
                                                    {{ substr($ue->annee_universitaire, 0, 4) }}
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">{{ $ue->annee_universitaire }}</div>
                                                    <small class="text-muted">Année académique</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            @if($ue->responsable)
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle bg-success bg-gradient text-white me-2">
                                                        {{ strtoupper(substr($ue->responsable->firstName, 0, 1) . substr($ue->responsable->lastName, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold">{{ $ue->responsable->firstName }} {{ $ue->responsable->lastName }}</div>
                                                        <small class="text-muted">Responsable UE</small>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="text-muted">
                                                    <i class="bi bi-person-x me-1"></i>
                                                    Non assigné
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="volume-horaire">
                                                <div class="row g-1">
                                                    @if($ue->heures_cm > 0)
                                                        <div class="col-12">
                                                            <small class="badge bg-primary bg-gradient">CM: {{ $ue->heures_cm }}h</small>
                                                        </div>
                                                    @endif
                                                    @if($ue->heures_td > 0)
                                                        <div class="col-12">
                                                            <small class="badge bg-warning bg-gradient">TD: {{ $ue->heures_td }}h</small>
                                                        </div>
                                                    @endif
                                                    @if($ue->heures_tp > 0)
                                                        <div class="col-12">
                                                            <small class="badge bg-success bg-gradient">TP: {{ $ue->heures_tp }}h</small>
                                                        </div>
                                                    @endif
                                                </div>
                                                <small class="text-muted">
                                                    Total: {{ $ue->heures_cm + $ue->heures_td + $ue->heures_tp }}h
                                                </small>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="empty-state">
                                                <i class="bi bi-inbox display-1 text-muted mb-3"></i>
                                                <h5 class="text-muted">Aucune UE trouvée</h5>
                                                <p class="text-muted">Il n'y a pas d'UE disponible dans ce département pour le moment.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($logs && $logs->hasPages())
                        <div class="card-footer bg-transparent border-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="pagination-info">
                                    <small class="text-muted">
                                        Affichage de {{ $logs->firstItem() }} à {{ $logs->lastItem() }}
                                        sur {{ $logs->total() }} UEs
                                    </small>
                                </div>
                                <nav aria-label="Pagination des UEs">
                                    {{ $logs->links('pagination::bootstrap-4') }}
                                </nav>
                            </div>
                        </div>
                    @endif
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

/* Modern Form Card */
.modern-form-card {
    border-radius: 20px !important;
    overflow: hidden;
}

.bg-gradient-info {
    background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%) !important;
}

/* Year Badge */
.year-badge {
    width: 45px;
    height: 45px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.8rem;
}

/* Avatar Circle */
.avatar-circle {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.75rem;
}

/* Code Badge */
.code-badge .badge {
    font-size: 0.8rem;
    padding: 0.5rem 0.75rem;
}

/* Volume Horaire */
.volume-horaire .badge {
    font-size: 0.7rem;
    margin-bottom: 0.25rem;
    display: inline-block;
    width: 100%;
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
    background-color: rgba(66, 153, 225, 0.05);
    transform: translateX(5px);
}

/* UE Name Scrollable */
.ue-name-container {
    max-width: 300px;
    position: relative;
}

.ue-name-scrollable {
    max-width: 100%;
    max-height: 60px;
    overflow-y: auto;
    overflow-x: hidden;
    word-wrap: break-word;
    white-space: normal;
    padding: 0.5rem;
    border-radius: 8px;
    background-color: rgba(66, 153, 225, 0.05);
    border: 1px solid rgba(66, 153, 225, 0.1);
    transition: all 0.3s ease;
    cursor: pointer;
    line-height: 1.4;
}

.ue-name-scrollable:hover {
    background-color: rgba(66, 153, 225, 0.1);
    border-color: rgba(66, 153, 225, 0.3);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    max-height: 120px;
}

/* Custom Scrollbar for UE Names */
.ue-name-scrollable::-webkit-scrollbar {
    width: 4px;
}

.ue-name-scrollable::-webkit-scrollbar-track {
    background: rgba(0, 0, 0, 0.1);
    border-radius: 4px;
}

.ue-name-scrollable::-webkit-scrollbar-thumb {
    background: rgba(66, 153, 225, 0.5);
    border-radius: 4px;
}

.ue-name-scrollable::-webkit-scrollbar-thumb:hover {
    background: rgba(66, 153, 225, 0.8);
}

/* Statistics Cards */
.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    font-size: 1.5rem;
}

/* Empty State */
.empty-state {
    padding: 3rem 2rem;
}

/* Pagination */
.pagination-info {
    color: #6b7280;
    font-size: 0.875rem;
}

.pagination .page-link {
    border-radius: 8px;
    margin: 0 2px;
    border: 1px solid #e2e8f0;
    color: #4a5568;
    font-weight: 500;
}

.pagination .page-link:hover {
    background-color: #4299e1;
    border-color: #4299e1;
    color: white;
}

.pagination .page-item.active .page-link {
    background-color: #4299e1;
    border-color: #4299e1;
    color: white;
}

.pagination .page-item.disabled .page-link {
    color: #a0aec0;
    background-color: #f7fafc;
}

/* Responsive Design */
@media (max-width: 768px) {
    .year-badge {
        width: 40px;
        height: 40px;
        font-size: 0.75rem;
    }

    .ue-info {
        max-width: 150px;
    }

    .avatar-circle {
        width: 30px;
        height: 30px;
        font-size: 0.7rem;
    }

    .pagination-info {
        font-size: 0.75rem;
        margin-bottom: 1rem;
    }

    .d-flex.justify-content-between {
        flex-direction: column;
        align-items: center;
    }
}

/* Animations */
.modern-form-card {
    animation: slideInUp 0.6s ease-out;
}

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
</style>
@endpush
