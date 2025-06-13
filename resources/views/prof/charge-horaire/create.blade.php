@extends('layouts.app')

@section('title', 'Nouvelle Affectation & Charge Horaire')

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
                                <i class="bi bi-calendar-plus text-success me-3"></i>
                                Nouvelle Affectation & Charge Horaire
                            </h1>
                            <p class="text-muted mb-0 fs-5">
                                Créez une <span class="text-success fw-bold">nouvelle affectation</span> et planifiez la charge horaire correspondante
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

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-2 fs-4"></i>
                    <div>
                        <h5 class="alert-heading mb-1">Affectation réussie!</h5>
                        <p class="mb-0">{{ session('success') }}</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    </div>
    @endif

    @if($errors->any())
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm">
                <div class="d-flex align-items-center">
                    <i class="bi bi-exclamation-triangle-fill me-2 fs-4"></i>
                    <div>
                        <h5 class="alert-heading mb-1">Erreurs de validation</h5>
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    </div>
    @endif

    <!-- Main Form -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg modern-form-card">
                <div class="card-header bg-gradient-success">
                    <h5 class="card-title text-white mb-0">
                        <i class="bi bi-pencil-square me-2"></i>Formulaire d'Affectation
                    </h5>
                </div>
                <div class="card-body p-4">
                    <!-- Step 1: Niveau and Semester Selection -->
                    <form action="{{ route('charge-horaire.create') }}" method="GET" id="filterForm">
                        <div class="mb-4 p-3 bg-primary bg-opacity-10 rounded">
                            <h5 class="text-primary mb-3">
                                <i class="bi bi-funnel me-2"></i>Étape 1: Sélection de la Filière et du Semestre
                            </h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="filiere_id" class="form-label fw-bold">Filière</label>
                                    <select name="filiere_id" id="filiere_id" class="form-select" required onchange="this.form.submit()">
                                        <option value="">-- Choisir la filière --</option>
                                        @foreach($filieres as $filiere)
                                            <option value="{{ $filiere->id }}" @selected($selectedFiliere == $filiere->id)>
                                                {{ $filiere->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="semestre" class="form-label fw-bold">Semestre</label>
                                    <select name="semestre" id="semestre" class="form-select" required onchange="this.form.submit()">
                                        <option value="">-- Choisir le semestre --</option>
                                        <option value="S1" @selected($selectedSemester == 'S1')>Semestre 1 (L1)</option>
                                        <option value="S2" @selected($selectedSemester == 'S2')>Semestre 2 (L1)</option>
                                        <option value="S3" @selected($selectedSemester == 'S3')>Semestre 3 (L2)</option>
                                        <option value="S4" @selected($selectedSemester == 'S4')>Semestre 4 (L2)</option>
                                        <option value="S5" @selected($selectedSemester == 'S5')>Semestre 5 (L3)</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <div class="alert alert-info mb-0">
                                        <i class="bi bi-info-circle me-2"></i>
                                        <strong>Département:</strong> {{ $departementName ?? 'Non défini' }}
                                        <br><small>{{ $filieres->count() }} filière(s) disponible(s)</small>
                                    </div>
                                </div>
                            </div>

                            @if(!$selectedFiliere || !$selectedSemester)
                            <div class="alert alert-info mt-3 mb-0">
                                <i class="bi bi-info-circle me-2"></i>
                                Veuillez sélectionner une filière et un semestre pour voir les UEs disponibles.
                            </div>
                            @endif
                        </div>
                    </form>

                    @if($selectedFiliere && $selectedSemester)
                    <!-- Step 2: Affectation Form -->
                    <form action="{{ route('charge-horaire.store') }}" method="POST" id="affectationForm">
                        @csrf
                        <input type="hidden" name="filiere_id" value="{{ $selectedFiliere }}">
                        <input type="hidden" name="semestre" value="{{ $selectedSemester }}">
                        <input type="hidden" name="affecter_par" value="{{ auth()->id() }}">

                        <!-- Affectation Details -->
                        <div class="mb-4 p-3 bg-success bg-opacity-10 rounded">
                            <h5 class="text-success mb-3">
                                <i class="bi bi-person-check me-2"></i>Étape 2: Détails de l'Affectation
                            </h5>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="prof_id" class="form-label fw-bold">Enseignant</label>
                                    <select name="prof_id" id="prof_id" class="form-select" required>
                                        <option value="">-- Sélectionner un enseignant --</option>
                                        @foreach($enseignants as $enseignant)
                                            <option value="{{ $enseignant->id }}" @selected(old('prof_id') == $enseignant->id)>
                                                {{ $enseignant->firstName }} {{ $enseignant->lastName }}
                                                ({{ ucfirst($enseignant->role) }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="type_enseignement" class="form-label fw-bold">Type d'enseignement</label>
                                    <select name="type_enseignement" id="type_enseignement" class="form-select" required>
                                        <option value="">-- Choisir le type --</option>
                                        <option value="cours" @selected(old('type_enseignement') == 'cours')>
                                            Cours Magistral (CM)
                                        </option>
                                        <option value="td" @selected(old('type_enseignement') == 'td')>
                                            Travaux Dirigés (TD)
                                        </option>
                                        <option value="tp" @selected(old('type_enseignement') == 'tp')>
                                            Travaux Pratiques (TP)
                                        </option>
                                    </select>
                                </div>
                                    
                                <div class="col-12">
                                    <label for="ue_id" class="form-label fw-bold">Unité d'enseignement</label>
                                    <select name="ue_id" id="ue_id" class="form-select" required>
                                        <option value="">-- Choisir une UE --</option>
                                        @forelse($ues as $ue)
                                            <option value="{{ $ue->id }}"
                                                data-cm="{{ $ue->remaining_cm ?? $ue->heures_cm }}"
                                                data-td="{{ $ue->remaining_td ?? $ue->heures_td }}"
                                                data-tp="{{ $ue->remaining_tp ?? $ue->heures_tp }}"
                                                data-code="{{ $ue->code }}"
                                                data-total-cm="{{ $ue->heures_cm }}"
                                                data-total-td="{{ $ue->heures_td }}"
                                                data-total-tp="{{ $ue->heures_tp }}"
                                                @selected(old('ue_id') == $ue->id)>
                                                {{ $ue->code }} - {{ $ue->nom }}
                                                @if(isset($ue->remaining_cm))
                                                    (Restant: CM:{{ $ue->remaining_cm }}h | TD:{{ $ue->remaining_td }}h | TP:{{ $ue->remaining_tp }}h)
                                                @else
                                                    (Total: CM:{{ $ue->heures_cm }}h | TD:{{ $ue->heures_td }}h | TP:{{ $ue->heures_tp }}h)
                                                @endif
                                                @if($ue->responsable)
                                                    - Resp: {{ $ue->responsable->firstName }} {{ $ue->responsable->lastName }}
                                                @else
                                                    - Vacant
                                                @endif
                                            </option>
                                        @empty
                                            <option value="" disabled>Aucune UE disponible pour ce niveau et semestre</option>
                                        @endforelse
                                    </select>
                                    @if($ues->isEmpty())
                                        <div class="alert alert-warning mt-2">
                                            <i class="bi bi-exclamation-triangle me-2"></i>
                                            Aucune UE trouvée pour <strong>{{ $filieres->find($selectedFiliere)->nom ?? 'cette filière' }}</strong>
                                            - <strong>{{ $selectedSemester }}</strong>.
                                            <br><small>Vérifiez que des UEs sont configurées pour cette combinaison filière/semestre.</small>
                                        </div>
                                    @else
                                        <div class="form-text text-success">
                                            <i class="bi bi-check-circle me-1"></i>
                                            {{ $ues->count() }} UE(s) disponible(s) pour
                                            <strong>{{ $filieres->find($selectedFiliere)->nom ?? 'cette filière' }}</strong>
                                            - <strong>{{ $selectedSemester }}</strong>
                                        </div>
                                    @endif
                                </div>

                                @if(isset($groupes) && $groupes->isNotEmpty())
                                <div class="col-md-6" id="groupe-section" style="display: none;">
                                    <label for="groupe_id" class="form-label fw-bold">Groupe</label>
                                    <select name="groupe_id" id="groupe_id" class="form-select">
                                        <option value="">-- Sélectionner un groupe --</option>
                                        @foreach($groupes as $groupe)
                                            <option value="{{ $groupe->id }}" @selected(old('groupe_id') == $groupe->id)>
                                                {{ $groupe->nom }} ({{ ucfirst($groupe->type) }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="form-text text-muted">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Requis pour les TD et TP uniquement.
                                    </div>
                                </div>
                                @endif

                                <div class="col-md-6">
                                    <label for="annee_universitaire" class="form-label fw-bold">Année Universitaire</label>
                                    <input type="text" name="annee_universitaire" class="form-control"
                                        placeholder="2024-2025" value="{{ old('annee_universitaire', date('Y') . '-' . (date('Y') + 1)) }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Charge Horaire Section -->
                        <div class="mb-4 p-3 bg-light rounded">
                            <h5 class="text-success mb-3 d-flex align-items-center">
                                <i class="bi bi-clock-history me-2"></i>
                                Détails de la Charge Horaire
                            </h5>

                            <div class="alert alert-info mb-3">
                                <i class="bi bi-info-circle me-2"></i>
                                <strong>Volume horaire automatique:</strong> Le système assignera automatiquement toutes les heures disponibles pour le type d'enseignement sélectionné.
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="heures_semaine" class="form-label fw-bold">Heures par semaine (h)</label>
                                    <div class="input-group">
                                        <input type="number" name="heures_semaine"
                                            id="heures_semaine"
                                            class="form-control" min="1" max="10"
                                            value="{{ old('heures_semaine') }}" required>
                                        <span class="input-group-text">heures</span>
                                    </div>
                                    <div class="form-text text-muted">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Nombre d'heures par semaine (généralement 1-4h).
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="date_debut" class="form-label fw-bold">Date de début</label>
                                    <input type="date" name="date_debut"
                                        id="date_debut"
                                        class="form-control"
                                        value="{{ old('date_debut', date('Y-m-d')) }}" required>
                                    <div class="form-text text-muted">
                                        <i class="bi bi-calendar me-1"></i>
                                        Date de début des cours (la fin sera calculée automatiquement).
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label for="commentaires" class="form-label fw-bold">Commentaires</label>
                                <textarea name="commentaires" 
                                    id="commentaires" 
                                    class="form-control" rows="3"
                                    placeholder="Notes supplémentaires...">{{ old('commentaires') }}</textarea>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success btn-lg modern-btn px-5">
                                <i class="bi bi-save me-2"></i> Créer l'Affectation
                            </button>
                            <a href="{{ route('prof.chargehoraire') }}" class="btn btn-outline-secondary btn-lg ms-3">
                                <i class="bi bi-arrow-left me-1"></i> Retour
                            </a>
                        </div>
                    </form>
                    @else
                    <!-- Message when no filiere/semester selected -->
                    <div class="text-center py-5">
                        <div class="icon-circle bg-muted-light mx-auto mb-3">
                            <i class="bi bi-funnel text-muted fs-1"></i>
                        </div>
                        <h5 class="text-muted">Sélection requise</h5>
                        <p class="text-muted mb-0">
                            Veuillez d'abord sélectionner une filière et un semestre pour continuer avec l'affectation.
                        </p>
                    </div>
                    @endif
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

.form-control, .form-select {
    border-radius: 12px !important;
    border: 2px solid #e9ecef;
    padding: 12px 16px;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}

.input-group-text {
    border-radius: 0 12px 12px 0 !important;
    border: 2px solid #e9ecef;
    border-left: none;
    background: #f8f9fa;
}

.card-header {
    border-bottom: none !important;
}

.alert {
    border-radius: 15px !important;
}

.badge {
    border-radius: 8px;
    font-weight: 600;
}

.icon-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.bg-muted-light {
    background-color: rgba(108, 117, 125, 0.1);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeEnseignement = document.getElementById('type_enseignement');
    const ueSelect = document.getElementById('ue_id');
    const groupeSection = document.getElementById('groupe-section');
    const groupeSelect = document.getElementById('groupe_id');

    // Show/hide groupe section based on type d'enseignement
    if (typeEnseignement) {
        typeEnseignement.addEventListener('change', function() {
            const selectedType = this.value;

            if (groupeSection) {
                if (selectedType === 'td' || selectedType === 'tp') {
                    groupeSection.style.display = 'block';
                    groupeSelect.required = true;
                } else {
                    groupeSection.style.display = 'none';
                    groupeSelect.required = false;
                    groupeSelect.value = '';
                }
            }

            // Show available hours info
            showAvailableHours();
        });

        // Trigger change event on page load
        typeEnseignement.dispatchEvent(new Event('change'));
    }

    // Update available hours info when UE changes
    if (ueSelect) {
        ueSelect.addEventListener('change', showAvailableHours);
    }

    function showAvailableHours() {
        const selectedUe = ueSelect.options[ueSelect.selectedIndex];
        const selectedType = typeEnseignement.value;

        if (selectedUe && selectedType) {
            let availableHours = 0;

            switch(selectedType) {
                case 'cours':
                    availableHours = selectedUe.dataset.cm || 0;
                    break;
                case 'td':
                    availableHours = selectedUe.dataset.td || 0;
                    break;
                case 'tp':
                    availableHours = selectedUe.dataset.tp || 0;
                    break;
            }

            // Update the info alert
            const infoAlert = document.querySelector('.alert-info');
            if (infoAlert && availableHours > 0) {
                infoAlert.innerHTML = `
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Volume horaire automatique:</strong> ${availableHours} heures seront assignées pour ${selectedType.toUpperCase()}.
                `;
            }
        }
    }

    // Form validation
    const form = document.getElementById('affectationForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            // Check if groupe is required
            if ((typeEnseignement.value === 'td' || typeEnseignement.value === 'tp') && !groupeSelect.value) {
                e.preventDefault();
                alert('Veuillez sélectionner un groupe pour les TD/TP.');
                groupeSelect.focus();
                return false;
            }
        });
    }
});
</script>
@endsection