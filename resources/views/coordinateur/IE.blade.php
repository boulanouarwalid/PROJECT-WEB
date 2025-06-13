@extends('layouts.app')

@section('title', 'Export de Données')

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
                                <i class="bi bi-download text-success me-3"></i>
                                Export de Données
                            </h1>
                            <p class="text-muted mb-0 fs-5">
                                Exportation des données • <span class="text-success fw-bold">Téléchargement</span> simplifié et sécurisé
                            </p>
                        </div>
                        <div class="text-end">
                            <div class="badge bg-success bg-gradient fs-6 px-3 py-2 mb-2">Export</div>
                            <div class="small text-muted">{{ now()->format('d/m/Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Export Section -->
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
            <div class="card border-0 shadow-lg modern-form-card">
                <div class="card-header bg-gradient-success">
                    <h5 class="card-title text-white mb-0">
                        <i class="bi bi-download me-2"></i>Configuration de l'Export
                    </h5>
                </div>
                <div class="card-body p-5">
                    <form id="exportForm" action="{{ route('export.process') }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                        <!-- Data Type Selection -->
                        <div class="form-section">
                            <h6 class="section-title">
                                <i class="bi bi-database text-success me-2"></i>
                                Sélection des données
                            </h6>

                            <div class="mb-4">
                                <label for="exportDataType" class="form-label fw-semibold">Type de données à exporter <span class="text-danger">*</span></label>
                                <select class="form-select modern-select" name="type" id="exportDataType" required>
                                    <option value="" selected disabled>Choisir le type de données</option>
                                    <option value="unites">📚 Unités d'Enseignement</option>
                                    <option value="vacataires">👨‍🏫 Liste des Vacataires</option>
                                    <option value="affectations">🔗 Affectations UE-Enseignant (Charges Horaires)</option>
                                    <option value="emplois">📅 Emplois du Temps</option>
                                </select>
                                <div class="form-text">Sélectionnez le type de données que vous souhaitez exporter</div>
                            </div>
                        </div>

                        <!-- Format Selection -->
                        <div class="form-section">
                            <h6 class="section-title">
                                <i class="bi bi-file-earmark text-success me-2"></i>
                                Format d'export
                            </h6>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Choisir le format de fichier <span class="text-danger">*</span></label>
                                <div class="row g-3 justify-content-center">
                                    <div class="col-md-6">
                                        <div class="format-option">
                                            <input type="radio" class="btn-check" name="format" id="formatCSV" value="csv" checked>
                                            <label class="btn btn-outline-success w-100 format-btn" for="formatCSV">
                                                <i class="bi bi-file-earmark-text format-icon"></i>
                                                <div class="format-title">CSV</div>
                                                <small class="format-desc">Valeurs séparées par virgules</small>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="format-option">
                                            <input type="radio" class="btn-check" name="format" id="formatPDF" value="pdf">
                                            <label class="btn btn-outline-success w-100 format-btn" for="formatPDF">
                                                <i class="bi bi-file-earmark-pdf format-icon"></i>
                                                <div class="format-title">PDF</div>
                                                <small class="format-desc">Document portable</small>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Export Options -->
                        <div class="form-section">
                            <h6 class="section-title">
                                <i class="bi bi-gear text-success me-2"></i>
                                Options avancées
                            </h6>

                            <div class="mb-4">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-check form-switch option-switch">
                                            <input class="form-check-input" type="checkbox" name="headers" id="includeHeaders" checked>
                                            <label class="form-check-label" for="includeHeaders">
                                                <i class="bi bi-list-columns text-info me-2"></i>
                                                <strong>Inclure les en-têtes</strong>
                                                <div class="option-desc">Ajouter les noms de colonnes</div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-switch option-switch">
                                            <input class="form-check-input" type="checkbox" name="all_data" id="exportAll" checked>
                                            <label class="form-check-label" for="exportAll">
                                                <i class="bi bi-database text-warning me-2"></i>
                                                <strong>Toutes les données</strong>
                                                <div class="option-desc">Exporter l'ensemble complet</div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-actions text-center">
                            <button type="submit" class="btn btn-success btn-lg modern-btn export-btn">
                                <i class="bi bi-download me-2"></i>Générer et Télécharger
                            </button>
                            <div class="mt-3">
                                <small class="text-muted">
                                    <i class="bi bi-shield-check me-1"></i>
                                    Export sécurisé • Données chiffrées
                                </small>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Templates Section -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg modern-form-card">
                <div class="card-header bg-gradient-info">
                    <h5 class="card-title text-white mb-0">
                        <i class="bi bi-file-earmark-arrow-down me-2"></i>Modèles de Données
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-3">
                        <div class="col-12">
                            <p class="text-muted mb-4">
                                <i class="bi bi-info-circle text-info me-2"></i>
                                Téléchargez nos modèles pré-formatés pour comprendre la structure des données requise pour l'import.
                            </p>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-lg-3 col-md-6">
                            <div class="template-card">
                                <a href="{{ asset('templates/unites_template.csv') }}" class="btn btn-outline-info w-100 template-btn">
                                    <div class="template-icon">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </div>
                                    <div class="template-title">Unités d'Enseignement</div>
                                    <small class="template-desc">Structure des UEs</small>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="template-card">
                                <a href="{{ asset('templates/vacataires_template.csv') }}" class="btn btn-outline-info w-100 template-btn">
                                    <div class="template-icon">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </div>
                                    <div class="template-title">Vacataires</div>
                                    <small class="template-desc">Liste des enseignants</small>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="template-card">
                                <a href="{{ asset('templates/affectations_template.csv') }}" class="btn btn-outline-info w-100 template-btn">
                                    <div class="template-icon">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </div>
                                    <div class="template-title">Affectations</div>
                                    <small class="template-desc">Relations UE-Enseignant avec charges horaires</small>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="template-card">
                                <a href="{{ asset('templates/emplois_template.csv') }}" class="btn btn-outline-info w-100 template-btn">
                                    <div class="template-icon">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </div>
                                    <div class="template-title">Emplois du Temps</div>
                                    <small class="template-desc">Planning des cours</small>
                                </a>
                            </div>
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

/* Modern Select */
.modern-select {
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    padding: 0.875rem 1rem;
    font-weight: 500;
}

.modern-select:focus {
    border-color: #4299e1;
    box-shadow: 0 0 0 0.2rem rgba(66, 153, 225, 0.25);
}

/* File Upload Area */
.file-upload-area {
    position: relative;
}

.file-upload-area .form-control {
    border: 2px dashed #e2e8f0;
    border-radius: 10px;
    padding: 1rem;
    transition: all 0.3s ease;
}

.file-upload-area .form-control:hover {
    border-color: #4299e1;
    background-color: rgba(66, 153, 225, 0.05);
}

.file-upload-help {
    margin-top: 0.5rem;
    font-size: 0.875rem;
    color: #6b7280;
}

/* Format Options */
.format-option {
    height: 100%;
}

.format-btn {
    padding: 1.5rem 1rem;
    height: 100%;
    border-radius: 15px;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    border: 2px solid #e2e8f0;
}

.format-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    border-color: #48bb78;
}

.format-btn .format-icon {
    font-size: 2.5rem;
    margin-bottom: 0.75rem;
    color: #48bb78;
}

.format-btn .format-title {
    font-weight: 700;
    font-size: 1.1rem;
    margin-bottom: 0.25rem;
    color: #2d3748;
}

.format-btn .format-desc {
    color: #6b7280;
    font-size: 0.8rem;
}

.format-option .btn-check:checked + .format-btn {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
    border-color: #48bb78;
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(72, 187, 120, 0.3);
}

.format-option .btn-check:checked + .format-btn .format-icon,
.format-option .btn-check:checked + .format-btn .format-title,
.format-option .btn-check:checked + .format-btn .format-desc {
    color: white;
}

/* Option Switches */
.option-switch {
    background: #f8fafc;
    border-radius: 12px;
    padding: 1.25rem;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}

.option-switch:hover {
    background: #f1f5f9;
    border-color: #cbd5e0;
}

.option-switch .form-check-label {
    cursor: pointer;
    width: 100%;
}

.option-switch .option-desc {
    font-size: 0.8rem;
    color: #6b7280;
    margin-top: 0.25rem;
}

/* Export Button */
.export-btn {
    padding: 1rem 3rem;
    font-size: 1.1rem;
    font-weight: 700;
    border-radius: 15px;
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
    border: none;
    box-shadow: 0 4px 15px rgba(72, 187, 120, 0.3);
}

.export-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(72, 187, 120, 0.4);
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

/* Template Cards */
.template-card {
    height: 100%;
}

.template-btn {
    padding: 1.5rem 1rem;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    border-radius: 15px;
    transition: all 0.3s ease;
}

.template-btn:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    border-color: #4299e1;
}

.template-icon {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    color: #48bb78;
}

.template-title {
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #2d3748;
}

.template-desc {
    color: #6b7280;
    font-size: 0.75rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .form-section {
        padding: 1rem;
    }

    .form-actions {
        padding: 1.5rem;
    }

    .template-btn {
        padding: 1rem 0.5rem;
    }

    .template-icon {
        font-size: 2rem;
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const exportForm = document.getElementById('exportForm');
    const exportBtn = document.querySelector('.export-btn');
    const dataTypeSelect = document.getElementById('exportDataType');

    // Form validation and submission
    exportForm.addEventListener('submit', function(e) {
        if (!exportForm.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();

            // Show validation feedback
            showErrorToast('Veuillez sélectionner un type de données à exporter');
        } else {
            // Show loading state
            const originalContent = exportBtn.innerHTML;
            exportBtn.innerHTML = '<i class="bi bi-arrow-clockwise spin me-2"></i>Génération en cours...';
            exportBtn.disabled = true;

            // Show success message
            setTimeout(() => {
                showSuccessToast('Export généré avec succès ! Téléchargement en cours...');

                // Reset button after delay
                setTimeout(() => {
                    exportBtn.innerHTML = originalContent;
                    exportBtn.disabled = false;
                }, 3000);
            }, 1000);
        }

        exportForm.classList.add('was-validated');
    });

    // Dynamic form updates based on data type
    dataTypeSelect.addEventListener('change', function() {
        const selectedType = this.value;
        const formText = document.querySelector('.form-text');

        switch(selectedType) {
            case 'unites':
                formText.textContent = 'Export des UEs avec codes, noms, crédits et responsables';
                break;
            case 'vacataires':
                formText.textContent = 'Export des vacataires avec informations personnelles et affectations';
                break;
            case 'affectations':
                formText.textContent = 'Export des affectations UE-Enseignant avec charges horaires, volumes CM/TD/TP et responsabilités';
                break;
            case 'emplois':
                formText.textContent = 'Export des plannings avec créneaux et salles';
                break;
            default:
                formText.textContent = 'Sélectionnez le type de données que vous souhaitez exporter';
        }
    });
});

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

    setTimeout(() => {
        const toast = document.querySelector('.toast:last-of-type');
        if (toast) {
            const bsToast = new bootstrap.Toast(toast);
            bsToast.hide();
            setTimeout(() => toast.remove(), 500);
        }
    }, 7000);
}
</script>
@endpush



