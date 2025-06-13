@extends('layouts.app')
@section('title', 'Validation des Notes')

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
                                <i class="bi bi-clipboard-check text-warning me-3"></i>
                                Validation des Notes
                            </h1>
                            <p class="text-muted mb-0 fs-5">
                                Gestion des notes en attente • <span class="text-warning fw-bold">{{ $pendingNotes->count() }}</span> notes à valider
                            </p>
                        </div>
                        <div class="text-end">
                            <div class="badge bg-warning bg-gradient fs-6 px-3 py-2 mb-2">En attente</div>
                            <div class="small text-muted">{{ now()->format('d/m/Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show modern-alert" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <!-- Notes Table -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg modern-form-card">
                <div class="card-header bg-gradient-warning">
                    <h5 class="card-title text-dark mb-0">
                        <i class="bi bi-table me-2"></i>Notes en attente de validation
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
                                        <i class="bi bi-calendar-event me-2"></i>Session
                                    </th>
                                    <th class="border-0 px-4 py-3">
                                        <i class="bi bi-calendar-range me-2"></i>Année universitaire
                                    </th>
                                    <th class="border-0 px-4 py-3">
                                        <i class="bi bi-file-earmark me-2"></i>Fichier
                                    </th>
                                    <th class="border-0 px-4 py-3">
                                        <i class="bi bi-person me-2"></i>Enseignant
                                    </th>
                                    <th class="border-0 px-4 py-3 text-end">
                                        <i class="bi bi-gear me-2"></i>Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendingNotes as $note)
                                <tr class="border-0 note-row" data-note-id="{{ $note->id }}">
                                    <td class="px-4 py-3">
                                        <div class="ue-info">
                                            <div class="fw-semibold text-primary ue-name-scrollable" title="{{ $note->ue->nom ?? '-' }}">
                                                {{ $note->ue->nom ?? '-' }}
                                            </div>
                                            <small class="text-muted">
                                                @if($note->ue->code ?? false)
                                                    Code: {{ $note->ue->code }}
                                                @else
                                                    UE ID: {{ $note->ue->id ?? '-' }}
                                                @endif
                                            </small>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge
                                            @if($note->session_type === 'normal') bg-primary bg-gradient
                                            @else bg-secondary bg-gradient
                                            @endif">
                                            <i class="bi
                                                @if($note->session_type === 'normal') bi-1-circle
                                                @else bi-2-circle
                                                @endif me-1"></i>
                                            {{ ucfirst($note->session_type) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div>
                                            <div class="fw-semibold">{{ $note->academic_year ?? '2023-2024' }}</div>
                                            <small class="text-muted">
                                                <i class="bi bi-calendar me-1"></i>Année en cours
                                            </small>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('notes.download', $note) }}" class="btn btn-sm btn-outline-info modern-btn-sm">
                                            <i class="bi bi-file-earmark-excel me-1"></i>
                                            Télécharger
                                        </a>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle bg-info bg-gradient text-white me-2">
                                                {{ strtoupper(substr($note->ue->responsable->firstName ?? 'U', 0, 1) . substr($note->ue->responsable->lastName ?? 'N', 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $note->ue->responsable->firstName ?? 'Non' }} {{ $note->ue->responsable->lastName ?? 'assigné' }}</div>
                                                <small class="text-muted">Responsable UE</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-end">
                                        <form method="POST" action="{{ route('coordinateur.notes.publish', $note) }}" class="publish-form d-inline">
                                            @csrf
                                            <button type="button" class="btn btn-success btn-sm modern-btn-sm publish-btn" data-note-id="{{ $note->id }}">
                                                <i class="bi bi-check-circle me-1"></i>Publier
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="bi bi-clipboard-check display-1 text-muted mb-3"></i>
                                            <h5 class="text-muted">Aucune note en attente</h5>
                                            <p class="text-muted">Toutes les notes ont été validées ou aucune note n'a été soumise.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmPublishModal" tabindex="-1" aria-labelledby="confirmPublishModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="confirmPublishModalLabel">
                    <i class="bi bi-check-circle me-2"></i>Publier les Notes
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="bi bi-question-circle-fill text-warning mb-3" style="font-size: 3rem;"></i>
                <p class="fs-5">Êtes-vous sûr de vouloir publier ces notes ?</p>
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    Une fois publiées, les notes seront visibles par les étudiants et ne pourront plus être modifiées.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary modern-btn" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-success modern-btn" id="confirmPublishBtn">
                    <i class="bi bi-check-circle me-2"></i>Confirmer la Publication
                </button>
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

.bg-gradient-warning {
    background: linear-gradient(135deg, #f6ad55 0%, #ed8936 100%) !important;
}

/* Modern Alert */
.modern-alert {
    border-radius: 15px;
    border: none;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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

/* UE Name Scrollable */
.ue-info {
    max-width: 200px;
}

.ue-name-scrollable {
    max-width: 100%;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    transition: all 0.3s ease;
    cursor: pointer;
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
}

.ue-name-scrollable:hover {
    background-color: rgba(66, 153, 225, 0.1);
    white-space: normal;
    overflow: visible;
    word-wrap: break-word;
    max-height: none;
    z-index: 10;
    position: relative;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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
    background-color: rgba(246, 173, 85, 0.05);
    transform: translateX(5px);
}

/* Modern Buttons */
.modern-btn {
    border-radius: 12px;
    font-weight: 600;
    padding: 0.875rem 2rem;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.modern-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.modern-btn-sm {
    border-radius: 8px;
    font-weight: 600;
    padding: 0.5rem 1rem;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.modern-btn-sm:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* Empty State */
.empty-state {
    padding: 3rem 2rem;
}

/* Modal Enhancements */
.modal-content {
    border-radius: 15px;
    overflow: hidden;
}

/* Responsive Design */
@media (max-width: 768px) {
    .ue-info {
        max-width: 150px;
    }

    .avatar-circle {
        width: 30px;
        height: 30px;
        font-size: 0.7rem;
    }

    .modern-btn-sm {
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
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

/* Loading Animation */
.spin {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
</style>
@endpush

@push('scripts')
<script>
let formToSubmit = null;

// Toast functions
function showSuccessToast(message) {
    const toastHtml = `
        <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    `;

    document.body.insertAdjacentHTML('beforeend', toastHtml);

    // Auto remove after 5 seconds
    setTimeout(() => {
        const toast = document.querySelector('.toast:last-of-type');
        if (toast) {
            const bsToast = new bootstrap.Toast(toast);
            bsToast.hide();
            setTimeout(() => toast.remove(), 500);
        }
    }, 5000);
}

document.addEventListener('DOMContentLoaded', function () {
    // Show success toast if there's a session success message
    @if(session('success'))
        showSuccessToast('{{ session('success') }}');
    @endif

    // Attach click event to all publish buttons
    document.querySelectorAll('.publish-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            formToSubmit = btn.closest('form');
            var modal = new bootstrap.Modal(document.getElementById('confirmPublishModal'));
            modal.show();
        });
    });

    // Confirm button in modal
    document.getElementById('confirmPublishBtn').addEventListener('click', function() {
        if (formToSubmit) {
            const submitBtn = this;
            const originalContent = submitBtn.innerHTML;

            // Show loading state
            submitBtn.innerHTML = '<i class="bi bi-arrow-clockwise spin me-2"></i>Publication...';
            submitBtn.disabled = true;

            // Submit form
            formToSubmit.submit();
        }
    });
});
</script>
@endpush
