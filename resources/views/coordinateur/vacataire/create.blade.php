@extends('layouts.app')

@section('title', 'Gestion des Vacataires')

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
                                <i class="bi bi-people-fill text-success me-3"></i>
                                Gestion des Vacataires
                            </h1>
                            <p class="text-muted mb-0 fs-5">
                                Création et gestion des comptes vacataires • <span class="text-success fw-bold">{{ $vacataires->count() }}</span> vacataires enregistrés
                            </p>
                        </div>
                        <div class="text-end">
                            <div class="badge bg-success bg-gradient fs-6 px-3 py-2 mb-2">{{ Auth::user()->deparetement ?? 'Département' }}</div>
                            <div class="small text-muted">{{ now()->format('d/m/Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <!-- Form Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg modern-form-card">
                <div class="card-header bg-gradient-success">
                    <h5 class="card-title text-white mb-0">
                        <i class="bi bi-person-plus-fill me-2"></i>Nouveau Vacataire
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form id="vacataireForm" method="POST" action="{{ route('vacataire.create') }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="row g-4">
                            <!-- Left Column -->
                            <div class="col-lg-6">
                                <!-- Personal Info Section -->
                                <div class="form-section">
                                    <h6 class="section-title">
                                        <i class="bi bi-person-fill text-info me-2"></i>Informations personnelles
                                    </h6>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="firstName" class="form-label fw-semibold">Prénom <span class="text-danger">*</span></label>
                                            <div class="input-group modern-input">
                                                <span class="input-group-text">
                                                   <i class="bi bi-person text-primary"></i>
                                                </span>
                                                <input type="text" class="form-control" id="firstName" name="firstName" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lastName" class="form-label fw-semibold">Nom <span class="text-danger">*</span></label>
                                            <div class="input-group modern-input">
                                                <span class="input-group-text">
                                                   <i class="bi bi-person text-primary"></i>
                                                </span>
                                                <input type="text" class="form-control" id="lastName" name="lastName" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="CIN" class="form-label fw-semibold">Numéro de la Carte Nationale</label>
                                        <div class="input-group modern-input">
                                            <span class="input-group-text">
                                               <i class="bi bi-credit-card text-primary"></i>
                                            </span>
                                            <input type="text" class="form-control" id="CIN" name="CIN" placeholder="Ex: AB123456">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-lg-6">
                                <!-- Contact Info Section -->
                                <div class="form-section">
                                    <h6 class="section-title">
                                        <i class="bi bi-telephone-fill text-warning me-2"></i>Informations de contact
                                    </h6>

                                    <div class="mb-4">
                                        <label for="emailpersonel" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                        <div class="input-group modern-input">
                                            <span class="input-group-text">
                                               <i class="bi bi-envelope text-primary"></i>
                                            </span>
                                            <input type="email" class="form-control" id="emailpersonel" name="emailpersonel" required>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="Numerotelephone" class="form-label fw-semibold">Téléphone</label>
                                            <div class="input-group modern-input">
                                                <span class="input-group-text">
                                                   <i class="bi bi-telephone text-primary"></i>
                                                </span>
                                                <input type="tel" class="form-control" id="Numerotelephone" name="Numerotelephone" placeholder="06 XX XX XX XX">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="ville" class="form-label fw-semibold">Ville</label>
                                            <div class="input-group modern-input">
                                                <span class="input-group-text">
                                                   <i class="bi bi-geo-alt text-primary"></i>
                                                </span>
                                                <input type="text" class="form-control" id="ville" name="ville" placeholder="Ex: Casablanca">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Options Section -->
                                    <div class="mt-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="sendCredentials">
                                            <label class="form-check-label fw-semibold" for="sendCredentials">
                                                <i class="bi bi-envelope-check text-success me-2"></i>
                                                Envoyer les identifiants par email
                                            </label>
                                        </div>
                                        <small class="form-text text-muted">Les identifiants de connexion seront envoyés automatiquement</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="form-actions">
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="reset" class="btn btn-outline-secondary btn-lg modern-btn">
                                    <i class="bi bi-arrow-counterclockwise me-2"></i>Réinitialiser
                                </button>
                                <button type="submit" class="btn btn-success btn-lg modern-btn">
                                    <i class="bi bi-person-plus me-2"></i>Créer le Vacataire
                                </button>
                            </div>
                        </div>

                        <input type="hidden" name="role" value="vacataire">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Vacataires List -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg modern-form-card">
                <div class="card-header bg-gradient-primary">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title text-white mb-0">
                            <i class="bi bi-list-ul me-2"></i>Liste des Vacataires
                        </h5>
                        <span class="badge bg-light text-primary fs-6">{{ $vacataires->count() }} vacataires</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 modern-table">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0 px-4 py-3">ID</th>
                                    <th class="border-0 px-4 py-3">Nom Complet</th>
                                    <th class="border-0 px-4 py-3">Contact</th>
                                    <th class="border-0 px-4 py-3">Localisation</th>
                                    <th class="border-0 px-4 py-3">Statut</th>
                                    <th class="border-0 px-4 py-3">Responsabilités</th>
                                    <th class="border-0 px-4 py-3 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vacataires as $vacataire)
                                <tr class="border-0" data-vacataire-id="{{ $vacataire->id }}">
                                    <td class="px-4 py-3">
                                        <span class="fw-bold text-primary">VAC-{{ str_pad($vacataire->id, 3, '0', STR_PAD_LEFT) }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle bg-success bg-gradient text-white me-3">
                                                {{ strtoupper(substr($vacataire->firstName, 0, 1) . substr($vacataire->lastName, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $vacataire->firstName }} {{ $vacataire->lastName }}</div>
                                                <small class="text-muted">{{ $vacataire->CIN ?? 'CIN non renseignée' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div>
                                            <div class="fw-semibold">{{ $vacataire->emailpersonel ?? $vacataire->email }}</div>
                                            <small class="text-muted">
                                                <i class="bi bi-telephone me-1"></i>{{ $vacataire->Numerotelephone ?? 'Non renseigné' }}
                                            </small>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge bg-info bg-gradient">
                                            <i class="bi bi-geo-alt me-1"></i>{{ $vacataire->ville ?? 'Non renseignée' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge
                                            @if($vacataire->status === 'active') bg-success bg-gradient
                                            @elseif($vacataire->status === 'inactive') bg-danger bg-gradient
                                            @else bg-warning bg-gradient text-dark
                                            @endif">
                                            <i class="bi
                                                @if($vacataire->status === 'active') bi-check-circle
                                                @elseif($vacataire->status === 'inactive') bi-x-circle
                                                @else bi-clock
                                                @endif me-1"></i>
                                            {{ ucfirst($vacataire->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($vacataire->responsabilites && $vacataire->responsabilites->count() > 0)
                                            @foreach($vacataire->responsabilites as $responsabilite)
                                                <span class="badge bg-secondary bg-gradient mb-1 d-block">
                                                    <i class="bi bi-building me-1"></i>
                                                    {{ $responsabilite->filiere->nom ?? 'Filière' }}
                                                    <small>({{ $responsabilite->date_debut->format('d/m/Y') }} - {{ $responsabilite->date_fin->format('d/m/Y') }})</small>
                                                </span>
                                            @endforeach
                                        @else
                                            <span class="text-muted small">Aucune responsabilité</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-end">
                                        <div class="btn-group">
                                            <!-- Status Change Dropdown -->
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                                        id="statusDropdown{{ $vacataire->id }}" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                    <i class="bi bi-gear"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="statusDropdown{{ $vacataire->id }}">
                                                    <li><h6 class="dropdown-header">Changer le statut</h6></li>
                                                    <li><a class="dropdown-item status-change" href="#"
                                                           data-id="{{ $vacataire->id }}" data-status="active">
                                                        <i class="bi bi-check-circle text-success me-2"></i>Activer</a></li>
                                                    <li><a class="dropdown-item status-change" href="#"
                                                           data-id="{{ $vacataire->id }}" data-status="inactive">
                                                        <i class="bi bi-x-circle text-danger me-2"></i>Désactiver</a></li>
                                                    <li><a class="dropdown-item status-change" href="#"
                                                           data-id="{{ $vacataire->id }}" data-status="pending">
                                                        <i class="bi bi-clock text-warning me-2"></i>En attente</a></li>
                                                </ul>
                                            </div>

                                            <button class="btn btn-sm btn-outline-danger delete-vacataire"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteVacataireModal"
                                                    data-id="{{ $vacataire->id }}"
                                                    data-url="{{ route('vacataire.destroy', $vacataire->id) }}"
                                                    data-name="{{ $vacataire->firstName }} {{ $vacataire->lastName }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($vacataires->hasPages())
                        <div class="card-footer bg-transparent border-0">
                            <div class="d-flex justify-content-center">
                                {{ $vacataires->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteVacataireModal" tabindex="-1" aria-labelledby="deleteVacataireModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteVacataireModalLabel">
                    <i class="bi bi-trash3 me-2"></i>Supprimer le Vacataire
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="bi bi-question-circle-fill text-warning mb-3" style="font-size: 3rem;"></i>
                <p>Êtes-vous sûr de vouloir supprimer le vacataire <strong id="vacataire-name"></strong> ?</p>
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Cette action supprimera également toutes les affectations et données associées.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form id="deleteVacataireForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash3 me-2"></i>Supprimer
                    </button>
                </form>
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

.bg-gradient-success {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%) !important;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
}

/* Form Sections */
.form-section {
    background: #f8fafc;
    border-radius: 15px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    border: 1px solid #e2e8f0;
}

.section-title {
    color: #2d3748;
    font-weight: 600;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e2e8f0;
    display: flex;
    align-items: center;
}

/* Modern Inputs */
.modern-input {
    border-radius: 10px;
    overflow: hidden;
}

.modern-input .input-group-text {
    background: #f7fafc;
    border: 2px solid #e2e8f0;
    border-right: none;
    color: #4a5568;
}

.modern-input .form-control {
    border: 2px solid #e2e8f0;
    border-left: none;
    padding: 0.875rem 1rem;
    font-weight: 500;
}

.modern-input .form-control:focus {
    border-color: #48bb78;
    box-shadow: 0 0 0 0.2rem rgba(72, 187, 120, 0.25);
}

/* Avatar Circle */
.avatar-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.875rem;
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
    background-color: rgba(72, 187, 120, 0.05);
    transform: translateX(5px);
}

/* Form Actions */
.form-actions {
    background: #f7fafc;
    border-radius: 15px;
    padding: 2rem;
    margin-top: 2rem;
    border: 1px solid #e2e8f0;
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

.btn-outline-secondary.modern-btn {
    border-color: #e2e8f0;
    color: #4a5568;
}

.btn-outline-secondary.modern-btn:hover {
    background: #f7fafc;
    border-color: #cbd5e0;
    color: #2d3748;
}

.btn-success.modern-btn {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
    border: none;
    color: white;
}

/* Modal Enhancements */
.modal-content {
    border-radius: 15px;
    overflow: hidden;
}

/* Responsive Design */
@media (max-width: 768px) {
    .form-section {
        padding: 1rem;
    }

    .form-actions .d-flex {
        flex-direction: column;
        gap: 1rem;
    }

    .avatar-circle {
        width: 35px;
        height: 35px;
        font-size: 0.75rem;
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

/* Toast Animations */
.toast {
    animation: slideInRight 0.3s ease-out;
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(100%);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Spin Animation */
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

function showErrorToast(message) {
    const toastHtml = `
        <div class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    `;

    document.body.insertAdjacentHTML('beforeend', toastHtml);

    // Auto remove after 7 seconds (longer for errors)
    setTimeout(() => {
        const toast = document.querySelector('.toast:last-of-type');
        if (toast) {
            const bsToast = new bootstrap.Toast(toast);
            bsToast.hide();
            setTimeout(() => toast.remove(), 500);
        }
    }, 7000);
}

document.addEventListener('DOMContentLoaded', function() {
    // Show success toast if there's a session success message
    @if(session('success'))
        showSuccessToast('{{ session('success') }}');
    @endif

    @if(session('error'))
        showErrorToast('{{ session('error') }}');
    @endif

    // Form validation
    const form = document.querySelector('.needs-validation');
    const inputs = form.querySelectorAll('input[required]');

    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.checkValidity()) {
                this.classList.add('is-valid');
                this.classList.remove('is-invalid');
            } else {
                this.classList.add('is-invalid');
                this.classList.remove('is-valid');
            }
        });
    });

    // Enhanced form submission
    form.addEventListener('submit', function(e) {
        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        } else {
            // Add loading state to submit button
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalContent = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="bi bi-arrow-clockwise spin me-2"></i>Création en cours...';
            submitBtn.disabled = true;

            // Re-enable after 5 seconds as fallback
            setTimeout(() => {
                submitBtn.innerHTML = originalContent;
                submitBtn.disabled = false;
            }, 5000);
        }
        form.classList.add('was-validated');
    });

    // Delete modal handler
    const deleteModal = document.getElementById('deleteVacataireModal');
    const deleteForm = document.getElementById('deleteVacataireForm');
    const vacataireName = document.getElementById('vacataire-name');

    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const url = button.getAttribute('data-url');
            const name = button.getAttribute('data-name');

            vacataireName.textContent = name;
            deleteForm.action = url;
        });

        // Handle delete form submission
        deleteForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const submitBtn = this.querySelector('button[type="submit"]');
            const originalContent = submitBtn.innerHTML;

            // Show loading state
            submitBtn.innerHTML = '<i class="bi bi-arrow-clockwise spin me-2"></i>Suppression...';
            submitBtn.disabled = true;

            // Get form data
            const formData = new FormData(this);
            const url = this.action;

            // Send AJAX request
            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': formData.get('_token'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Hide modal
                    const modal = bootstrap.Modal.getInstance(deleteModal);
                    modal.hide();

                    // Remove row from table
                    const row = document.querySelector(`tr[data-vacataire-id="${data.id}"]`);
                    if (row) {
                        row.style.transition = 'all 0.3s ease';
                        row.style.opacity = '0';
                        row.style.transform = 'translateX(-100%)';
                        setTimeout(() => row.remove(), 300);
                    }

                    // Show success toast
                    showSuccessToast(data.message);
                } else {
                    // Show error toast
                    showErrorToast(data.message || 'Erreur lors de la suppression');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showErrorToast('Erreur de connexion lors de la suppression');
            })
            .finally(() => {
                // Reset button
                submitBtn.innerHTML = originalContent;
                submitBtn.disabled = false;
            });
        });
    }

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

    function showErrorToast(message) {
        const toastHtml = `
            <div class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', toastHtml);

        // Auto remove after 7 seconds (longer for errors)
        setTimeout(() => {
            const toast = document.querySelector('.toast:last-of-type');
            if (toast) {
                const bsToast = new bootstrap.Toast(toast);
                bsToast.hide();
                setTimeout(() => toast.remove(), 500);
            }
        }, 7000);
    }
});
</script>

<style>
.spin {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.is-valid {
    border-color: #38a169 !important;
}

.is-invalid {
    border-color: #e53e3e !important;
}
</style>
@endpush