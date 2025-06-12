@extends('layouts.app')

@section('title', 'Création d\'Unité d\'Enseignement')

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
                                <i class="bi bi-plus-circle text-success me-3"></i>
                                Nouvelle Unité d'Enseignement
                            </h1>
                            <p class="text-muted mb-0 fs-5">
                                Créer une nouvelle UE pour <span class="text-primary fw-bold">{{ $filiere->nom }}</span>
                            </p>
                        </div>
                        <div class="text-end">
                            <div class="badge bg-primary bg-gradient fs-6 px-3 py-2 mb-2">{{ $departement->nom }}</div>
                            <div class="small text-muted">Département</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg modern-form-card">
                <div class="card-header bg-gradient-primary">
                    <h5 class="card-title text-white mb-0">
                        <i class="bi bi-form-text me-2"></i>Informations de l'UE
                    </h5>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('coordinateur.ues.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                        <div class="row g-4">
                            <!-- Left Column -->
                            <div class="col-lg-6">
                                <!-- Code UE Section -->
                                <div class="form-section">
                                    <h6 class="section-title">
                                        <i class="bi bi-tag-fill text-primary me-2"></i>Identification
                                    </h6>
                                    <div class="mb-4">
                                        <label for="code" class="form-label fw-semibold">Code UE (Généré automatiquement)</label>
                                        <div class="input-group modern-input">
                                            <span class="input-group-text">
                                               <i class="bi bi-tags-fill text-primary"></i>
                                            </span>
                                            <input type="text" class="form-control" id="code" name="code"
                                                   value="{{ old('code') }}" placeholder="Format: DEP-SEM-AA-NNN" readonly>
                                        </div>
                                        <small class="form-text text-muted">Le code sera généré automatiquement selon le format</small>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">Filière</label>
                                        <div class="info-display">
                                            <i class="bi bi-building text-primary me-2"></i>
                                            {{ $filiere->nom }}
                                        </div>
                                        <small class="form-text text-muted">Cette UE sera automatiquement associée à votre filière</small>
                                    </div>
                                </div>

                                <!-- Basic Info Section -->
                                <div class="form-section">
                                    <h6 class="section-title">
                                        <i class="bi bi-info-circle-fill text-info me-2"></i>Informations générales
                                    </h6>
                                    <div class="mb-4">
                                        <label for="nom" class="form-label fw-semibold">Nom de l'UE <span class="text-danger">*</span></label>
                                        <div class="input-group modern-input">
                                            <span class="input-group-text">
                                               <i class="bi bi-fonts text-primary"></i>
                                            </span>
                                            <input type="text" class="form-control" id="nom" name="nom"
                                                   value="{{ old('nom') }}" placeholder="Ex: Programmation Orientée Objet" required>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="semestre" class="form-label fw-semibold">Semestre <span class="text-danger">*</span></label>
                                            <select class="form-select modern-select" id="semestre" name="semestre" required>
                                                <option value="" disabled selected>Choisir un semestre</option>
                                                @foreach(['S1', 'S2', 'S3', 'S4', 'S5', 'S6'] as $sem)
                                                    <option value="{{ $sem }}" {{ old('semestre') == $sem ? 'selected' : '' }}>
                                                        Semestre {{ $sem }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="niveau_id" class="form-label fw-semibold">Niveau <span class="text-danger">*</span></label>
                                            <select class="form-select modern-select" id="niveau_id" name="niveau_id" required>
                                                <option value="" disabled selected>Choisir un niveau</option>
                                                @foreach($niveaux as $niveau)
                                                    <option value="{{ $niveau->id }}" {{ old('niveau_id') == $niveau->id ? 'selected' : '' }}>
                                                        {{ $niveau->nom }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-4 mt-3">
                                        <label for="annee_universitaire" class="form-label fw-semibold">Année Universitaire <span class="text-danger">*</span></label>
                                        <div class="input-group modern-input">
                                            <span class="input-group-text">
                                               <i class="bi bi-calendar text-primary"></i>
                                            </span>
                                            <input type="text" class="form-control" id="annee_universitaire"
                                                   name="annee_universitaire" value="{{ old('annee_universitaire', date('Y').'-'.(date('Y')+1)) }}"
                                                   placeholder="2023-2024" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-lg-6">
                                <!-- Volume Horaire Section -->
                                <div class="form-section">
                                    <h6 class="section-title">
                                        <i class="bi bi-clock-fill text-warning me-2"></i>Volume Horaire
                                    </h6>
                                    <div class="hours-grid">
                                        <div class="hour-card cm">
                                            <div class="hour-header">
                                                <i class="bi bi-person-video3"></i>
                                                <span>Cours Magistral</span>
                                            </div>
                                            <div class="input-group modern-input">
                                                <input type="number" class="form-control text-center" id="heures_cm"
                                                       name="heures_cm" value="{{ old('heures_cm', 0) }}" min="0" required>
                                                <span class="input-group-text">heures</span>
                                            </div>
                                        </div>

                                        <div class="hour-card td">
                                            <div class="hour-header">
                                                <i class="bi bi-people-fill"></i>
                                                <span>Travaux Dirigés</span>
                                            </div>
                                            <div class="input-group modern-input">
                                                <input type="number" class="form-control text-center" id="heures_td"
                                                       name="heures_td" value="{{ old('heures_td', 0) }}" min="0" required>
                                                <span class="input-group-text">heures</span>
                                            </div>
                                        </div>

                                        <div class="hour-card tp">
                                            <div class="hour-header">
                                                <i class="bi bi-laptop"></i>
                                                <span>Travaux Pratiques</span>
                                            </div>
                                            <div class="input-group modern-input">
                                                <input type="number" class="form-control text-center" id="heures_tp"
                                                       name="heures_tp" value="{{ old('heures_tp', 0) }}" min="0" required>
                                                <span class="input-group-text">heures</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Groupes Section -->
                                <div class="form-section">
                                    <h6 class="section-title">
                                        <i class="bi bi-diagram-3-fill text-success me-2"></i>Organisation des groupes
                                    </h6>
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <label for="groupes_td" class="form-label fw-semibold">Groupes TD</label>
                                            <div class="input-group modern-input">
                                                <span class="input-group-text">
                                                    <i class="bi bi-people text-primary"></i>
                                                </span>
                                                <input type="number" class="form-control text-center" id="groupes_td"
                                                       name="groupes_td" value="{{ old('groupes_td', 0) }}" min="0" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="groupes_tp" class="form-label fw-semibold">Groupes TP</label>
                                            <div class="input-group modern-input">
                                                <span class="input-group-text">
                                                    <i class="bi bi-laptop text-primary"></i>
                                                </span>
                                                <input type="number" class="form-control text-center" id="groupes_tp"
                                                       name="groupes_tp" value="{{ old('groupes_tp', 0) }}" min="0" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="form-actions">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('coordinateur.ues.index') }}" class="btn btn-outline-secondary btn-lg modern-btn">
                                    <i class="bi bi-arrow-left me-2"></i>Retour à la liste
                                </a>
                                <button type="submit" class="btn btn-success btn-lg modern-btn">
                                    <i class="bi bi-check-circle me-2"></i>Créer l'UE
                                </button>
                            </div>
                        </div>
                    </form>
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

/* Info Display */
.info-display {
    background: white;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    padding: 0.875rem 1rem;
    display: flex;
    align-items: center;
    color: #4a5568;
    font-weight: 500;
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
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.modern-input .form-control:focus + .input-group-text,
.modern-input .input-group-text:has(+ .form-control:focus) {
    border-color: #667eea;
}

/* Modern Select */
.modern-select {
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    padding: 0.875rem 1rem;
    font-weight: 500;
}

.modern-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

/* Hours Grid */
.hours-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1rem;
}

.hour-card {
    background: white;
    border-radius: 12px;
    padding: 1rem;
    border: 2px solid #e2e8f0;
    transition: all 0.3s ease;
}

.hour-card:hover {
    border-color: #cbd5e0;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.hour-card.cm {
    border-left: 4px solid #3182ce;
}

.hour-card.td {
    border-left: 4px solid #38a169;
}

.hour-card.tp {
    border-left: 4px solid #d69e2e;
}

.hour-header {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.75rem;
    font-weight: 600;
    color: #2d3748;
}

.hour-header i {
    font-size: 1.1rem;
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
}

/* Responsive Design */
@media (max-width: 768px) {
    .form-section {
        padding: 1rem;
    }

    .hours-grid {
        grid-template-columns: 1fr;
    }

    .form-actions .d-flex {
        flex-direction: column;
        gap: 1rem;
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
    // Auto-generate code when semestre changes
    const semestreSelect = document.getElementById('semestre');
    const codeInput = document.getElementById('code');

    semestreSelect.addEventListener('change', function() {
        const semestre = this.value;
        if (semestre) {
            const year = new Date().getFullYear().toString().slice(-2);
            codeInput.value = 'DEP-' + semestre + '-' + year + '-XXX';
        } else {
            codeInput.value = '';
        }
    });

    // Add visual feedback for form validation
    const form = document.querySelector('.needs-validation');
    const inputs = form.querySelectorAll('input[required], select[required]');

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

    // Calculate total hours
    const hourInputs = ['heures_cm', 'heures_td', 'heures_tp'];
    const totalDisplay = document.createElement('div');
    totalDisplay.className = 'alert alert-info mt-3';
    totalDisplay.innerHTML = '<strong>Volume total: <span id="total-hours">0</span> heures</strong>';

    const hoursSection = document.querySelector('.hours-grid').parentNode;
    hoursSection.appendChild(totalDisplay);

    function updateTotal() {
        let total = 0;
        hourInputs.forEach(id => {
            const input = document.getElementById(id);
            total += parseInt(input.value) || 0;
        });
        document.getElementById('total-hours').textContent = total;
    }

    hourInputs.forEach(id => {
        document.getElementById(id).addEventListener('input', updateTotal);
    });

    // Initial calculation
    updateTotal();

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
