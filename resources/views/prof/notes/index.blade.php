@extends('layouts.app')

@section('title', 'Gestion des Notes')

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
                                <i class="bi bi-file-earmark-text text-success me-3"></i>
                                Gestion des Notes
                            </h1>
                            <p class="text-muted mb-0 fs-5">
                                Uploadez et gérez les <span class="text-success fw-bold">notes</span> de vos modules d'enseignement
                            </p>
                        </div>
                        <div class="text-end">
                            <div class="badge bg-success bg-gradient fs-6 px-3 py-2 mb-2">{{ auth()->user()->deparetement ?? 'Enseignant' }}</div>
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
                <div class="card-header bg-gradient-success">
                    <h5 class="card-title text-white mb-0">
                        <i class="bi bi-lightning-fill me-2"></i>Actions Rapides
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <a href="{{ route('notes.template') }}" class="btn btn-outline-success btn-lg w-100 modern-btn">
                                <i class="bi bi-download mb-2 d-block" style="font-size: 1.5rem;"></i>
                                <span class="small">Template Excel</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <button class="btn btn-outline-primary btn-lg w-100 modern-btn" data-bs-toggle="modal" data-bs-target="#bulkUploadModal">
                                <i class="bi bi-upload mb-2 d-block" style="font-size: 1.5rem;"></i>
                                <span class="small">Upload Multiple</span>
                            </button>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <button class="btn btn-outline-info btn-lg w-100 modern-btn">
                                <i class="bi bi-file-earmark-excel mb-2 d-block" style="font-size: 1.5rem;"></i>
                                <span class="small">Exporter Notes</span>
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
                        <div class="stat-icon bg-primary bg-gradient">
                            <i class="bi bi-journal-bookmark text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h3 class="mb-0 fw-bold text-dark">{{ $ues->count() }}</h3>
                            <p class="text-muted mb-0 small">Total Modules</p>
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
                            <i class="bi bi-check-circle text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h3 class="mb-0 fw-bold text-dark">
                                {{ $ues->sum(function($ue) { return $ue->notes->count(); }) }}
                            </h3>
                            <p class="text-muted mb-0 small">Notes Uploadées</p>
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
                        <div class="stat-icon bg-warning bg-gradient">
                            <i class="bi bi-hourglass-split text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h3 class="mb-0 fw-bold text-dark">
                                {{ $ues->count() * 2 - $ues->sum(function($ue) { return $ue->notes->count(); }) }}
                            </h3>
                            <p class="text-muted mb-0 small">En Attente</p>
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
                            <i class="bi bi-graph-up text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h3 class="mb-0 fw-bold text-dark">
                                {{ $ues->count() > 0 ? round(($ues->sum(function($ue) { return $ue->notes->count(); }) / ($ues->count() * 2)) * 100) : 0 }}%
                            </h3>
                            <p class="text-muted mb-0 small">Progression</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-info" style="width: {{ $ues->count() > 0 ? round(($ues->sum(function($ue) { return $ue->notes->count(); }) / ($ues->count() * 2)) * 100) : 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modules Cards -->
    <div class="row g-4">
        @forelse($ues as $ue)
        <div class="col-lg-6 col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <div>
                        <span class="badge bg-primary-light text-primary">{{ $ue->code }}</span>
                        <h6 class="mb-0 mt-2">{{ $ue->nom }}</h6>
                    </div>
                    <span class="badge bg-secondary">S{{ $ue->semestre }}</span>
                </div>
                <div class="card-body">
                    <!-- Session Normale -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0 text-success">
                                <i class="bi bi-1-circle me-1"></i>Session Normale
                            </h6>
                            @if($note = $ue->notes->firstWhere('session_type', 'normal'))
                                <span class="badge bg-success-light text-success">
                                    <i class="bi bi-check-circle me-1"></i>Uploadé
                                </span>
                            @else
                                <span class="badge bg-warning-light text-warning">
                                    <i class="bi bi-clock me-1"></i>En attente
                                </span>
                            @endif
                        </div>

                        @if($note = $ue->notes->firstWhere('session_type', 'normal'))
                            <div class="d-flex gap-2">
                                <a href="{{ route('notes.download', $note) }}"
                                   class="btn btn-sm btn-outline-success flex-fill"
                                   title="{{ basename($note->file_path) }}">
                                    <i class="bi bi-download me-1"></i>Télécharger
                                </a>
                                <button class="btn btn-sm btn-outline-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#uploadModal"
                                        data-ue-id="{{ $ue->id }}"
                                        data-ue-name="{{ $ue->nom }}"
                                        data-session-type="normal"
                                        title="Remplacer">
                                    <i class="bi bi-arrow-clockwise"></i>
                                </button>
                            </div>
                        @else
                            <button class="btn btn-sm btn-outline-primary w-100"
                                    data-bs-toggle="modal"
                                    data-bs-target="#uploadModal"
                                    data-ue-id="{{ $ue->id }}"
                                    data-ue-name="{{ $ue->nom }}"
                                    data-session-type="normal">
                                <i class="bi bi-upload me-1"></i>Uploader Notes
                            </button>
                        @endif
                    </div>

                    <!-- Session Rattrapage -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0 text-info">
                                <i class="bi bi-2-circle me-1"></i>Session Rattrapage
                            </h6>
                            @if($note = $ue->notes->firstWhere('session_type', 'retake'))
                                <span class="badge bg-success-light text-success">
                                    <i class="bi bi-check-circle me-1"></i>Uploadé
                                </span>
                            @else
                                <span class="badge bg-warning-light text-warning">
                                    <i class="bi bi-clock me-1"></i>En attente
                                </span>
                            @endif
                        </div>

                        @if($note = $ue->notes->firstWhere('session_type', 'retake'))
                            <div class="d-flex gap-2">
                                <a href="{{ route('notes.download', $note) }}"
                                   class="btn btn-sm btn-outline-success flex-fill"
                                   title="{{ basename($note->file_path) }}">
                                    <i class="bi bi-download me-1"></i>Télécharger
                                </a>
                                <button class="btn btn-sm btn-outline-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#uploadModal"
                                        data-ue-id="{{ $ue->id }}"
                                        data-ue-name="{{ $ue->nom }}"
                                        data-session-type="retake"
                                        title="Remplacer">
                                    <i class="bi bi-arrow-clockwise"></i>
                                </button>
                            </div>
                        @else
                            <button class="btn btn-sm btn-outline-primary w-100"
                                    data-bs-toggle="modal"
                                    data-bs-target="#uploadModal"
                                    data-ue-id="{{ $ue->id }}"
                                    data-ue-name="{{ $ue->nom }}"
                                    data-session-type="retake">
                                <i class="bi bi-upload me-1"></i>Uploader Notes
                            </button>
                        @endif
                    </div>

                    <!-- Progress Bar -->
                    <div class="mt-3">
                        @php
                            $progress = ($ue->notes->count() / 2) * 100;
                        @endphp
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <small class="text-muted">Progression</small>
                            <small class="text-muted">{{ round($progress) }}%</small>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-{{ $progress == 100 ? 'success' : 'primary' }}"
                                 style="width: {{ $progress }}%"></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 pt-0">
                    <div class="d-flex gap-2">
                        <a href="{{ route('notes.template') }}"
                           class="btn btn-sm btn-outline-secondary flex-fill">
                            <i class="bi bi-file-earmark-excel me-1"></i>Template
                        </a>
                        <button class="btn btn-sm btn-outline-info" title="Historique">
                            <i class="bi bi-clock-history"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <div class="icon-circle bg-muted-light mx-auto mb-3">
                        <i class="bi bi-journal-x text-muted fs-1"></i>
                    </div>
                    <h5 class="text-muted">Aucun module assigné</h5>
                    <p class="text-muted mb-0">Vous n'avez aucun module d'enseignement assigné pour cette année.</p>
                </div>
            </div>
        </div>
        @endforelse
    </div>
</div>

<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="uploadForm" method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-upload me-2"></i>Uploader les Notes
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="ue_id" id="modalUeId">

                    <!-- Module Info -->
                    <div class="alert alert-info">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-info-circle me-2"></i>
                            <div>
                                <strong>Module:</strong> <span id="modalUeName"></span><br>
                                <strong>Session:</strong> <span id="modalSessionType"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Type de Session</label>
                            <select name="session_type" id="sessionSelect" class="form-select" required>
                                <option value="normal">Session Normale</option>
                                <option value="retake">Session de Rattrapage</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Année Universitaire</label>
                            <input type="text" class="form-control" value="{{ date('Y') }}-{{ date('Y')+1 }}" readonly>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Fichier Excel</label>
                            <div class="input-group">
                                <input type="file" name="file" class="form-control" accept=".xlsx,.xls,.csv" required>
                                <a href="{{ route('notes.template') }}" class="btn btn-outline-secondary" target="_blank">
                                    <i class="bi bi-download me-1"></i>Template
                                </a>
                            </div>
                            <div class="form-text">
                                <i class="bi bi-info-circle me-1"></i>
                                Formats acceptés: .xlsx, .xls, .csv (Max: 5MB)
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Commentaires (optionnel)</label>
                            <textarea name="comments" class="form-control" rows="3"
                                    placeholder="Ajoutez des commentaires sur cette évaluation..."></textarea>
                        </div>
                    </div>

                    <!-- Upload Guidelines -->
                    <div class="mt-4">
                        <h6 class="text-primary">
                            <i class="bi bi-lightbulb me-1"></i>Instructions d'upload
                        </h6>
                        <ul class="list-unstyled small text-muted">
                            <li><i class="bi bi-check text-success me-2"></i>Utilisez le template Excel fourni</li>
                            <li><i class="bi bi-check text-success me-2"></i>Vérifiez que tous les étudiants sont inclus</li>
                            <li><i class="bi bi-check text-success me-2"></i>Les notes doivent être entre 0 et 20</li>
                            <li><i class="bi bi-check text-success me-2"></i>Sauvegardez en format .xlsx ou .csv</li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>Annuler
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-upload me-1"></i>Uploader les Notes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bulk Upload Modal -->
<div class="modal fade" id="bulkUploadModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="bi bi-files me-2"></i>Upload Multiple - Tous les Modules
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    Uploadez les notes pour plusieurs modules en une seule fois.
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Module</th>
                                <th>Session Normale</th>
                                <th>Session Rattrapage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ues as $ue)
                            <tr>
                                <td>
                                    <div>
                                        <strong>{{ $ue->nom }}</strong>
                                        <br><small class="text-muted">{{ $ue->code }}</small>
                                    </div>
                                </td>
                                <td>
                                    <input type="file" class="form-control form-control-sm"
                                           accept=".xlsx,.xls,.csv"
                                           data-ue-id="{{ $ue->id }}"
                                           data-session="normal">
                                </td>
                                <td>
                                    <input type="file" class="form-control form-control-sm"
                                           accept=".xlsx,.xls,.csv"
                                           data-ue-id="{{ $ue->id }}"
                                           data-session="retake">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-success" id="bulkUploadBtn">
                    <i class="bi bi-upload me-1"></i>Uploader Tout
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
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Upload Modal Handler
    var uploadModal = document.getElementById('uploadModal');
    if (uploadModal) {
        uploadModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var ueId = button.getAttribute('data-ue-id');
            var ueName = button.getAttribute('data-ue-name');
            var sessionType = button.getAttribute('data-session-type');

            var form = document.getElementById('uploadForm');
            if (form && ueId) {
                form.action = '/prof/notes/' + ueId + '/upload';
                document.getElementById('modalUeId').value = ueId;
                document.getElementById('modalUeName').textContent = ueName;
                document.getElementById('modalSessionType').textContent =
                    sessionType === 'normal' ? 'Session Normale' : 'Session de Rattrapage';
                document.getElementById('sessionSelect').value = sessionType;
            }
        });
    }

    // File input validation
    document.querySelectorAll('input[type="file"]').forEach(function(input) {
        input.addEventListener('change', function() {
            var file = this.files[0];
            if (file) {
                var maxSize = 5 * 1024 * 1024; // 5MB
                if (file.size > maxSize) {
                    alert('Le fichier est trop volumineux. Taille maximale: 5MB');
                    this.value = '';
                }
            }
        });
    });

    // Bulk upload handler
    document.getElementById('bulkUploadBtn')?.addEventListener('click', function() {
        // Implementation for bulk upload
        alert('Fonctionnalité d\'upload multiple en cours de développement');
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

.bg-gradient-success {
    background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%) !important;
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

.form-control, .form-select {
    border-radius: 12px !important;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}
</style>
@endsection