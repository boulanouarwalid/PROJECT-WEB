@extends('layouts.app')

@section('title', 'Modifier UE: ' . $ue->nom)

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="h4 mb-0">
                    <i class="bi bi-book-fill me-2"></i>Modifier UE: {{ $ue->nom }}
                </h2>
                <div>
                    <span class="badge bg-light text-primary fs-6 me-2">{{ $filiere->nom }}</span>
                    <span class="badge bg-light text-primary fs-6">{{ $departement->nom }}</span>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('coordinateur.ues.update', $ue->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="code" class="form-label fw-bold">Code UE</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                   <i class="bi bi-tags-fill"></i>
                                </span>
                                <input type="text" class="form-control" id="code" 
                                       value="{{ $ue->code }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="nom" class="form-label fw-bold">Nom de l'UE <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                   <i class="bi bi-fonts"></i>
                                </span>
                                <input type="text" class="form-control" id="nom" name="nom" 
                                       value="{{ old('nom', $ue->nom) }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="semestre" class="form-label fw-bold">Semestre <span class="text-danger">*</span></label>
                            <select class="form-select" id="semestre" name="semestre" required>
                                <option value="" disabled>Sélectionnez un semestre</option>
                                @foreach(['S1', 'S2', 'S3', 'S4', 'S5', 'S6'] as $sem)
                                    <option value="{{ $sem }}" {{ old('semestre', $ue->semestre) == $sem ? 'selected' : '' }}>
                                        Semestre {{ $sem }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="annee_universitaire" class="form-label fw-bold">Année Universitaire <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                   <i class="bi bi-calendar"></i>
                                </span>
                                <input type="text" class="form-control" id="annee_universitaire" 
                                       name="annee_universitaire" value="{{ old('annee_universitaire', $ue->annee_universitaire) }}" 
                                       placeholder="2023-2024" required>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="fw-bold">Volume Horaire <span class="text-danger">*</span></label>
                            <div class="row g-2">
                                <div class="col-4">
                                    <label for="heures_cm" class="form-label small">CM</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="heures_cm" 
                                               name="heures_cm" value="{{ old('heures_cm', $ue->heures_cm) }}" min="0" required>
                                        <span class="input-group-text">h</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="heures_td" class="form-label small">TD</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="heures_td" 
                                               name="heures_td" value="{{ old('heures_td', $ue->heures_td) }}" min="0" required>
                                        <span class="input-group-text">h</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="heures_tp" class="form-label small">TP</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="heures_tp" 
                                               name="heures_tp" value="{{ old('heures_tp', $ue->heures_tp) }}" min="0" required>
                                        <span class="input-group-text">h</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                       <div class="mb-3">
                            <label for="responsable_id" class="form-label fw-bold">Responsable</label>
                            <select class="form-select" id="responsable_id" name="responsable_id">
                                <option value="">Sélectionnez un responsable</option>
                                @foreach($professeurs as $professeur)
                                    <option value="{{ $professeur->id }}" 
                                            {{ old('responsable_id', $ue->responsable_id) == $professeur->id ? 'selected' : '' }}>
                                        {{ $professeur->lastName }} {{ $professeur->firstName }} ({{ $professeur->role }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Type Enseignement Field -->
                        <div class="mb-3" id="type_enseignement_container" 
                             style="display: {{ old('responsable_id', $ue->responsable_id) ? 'block' : 'none' }};">
                            <label for="type_enseignement" class="form-label fw-bold">Type d'enseignement</label>
                            <select class="form-select" id="type_enseignement" name="type_enseignement" 
                                    {{ empty(old('responsable_id', $ue->responsable_id)) ? 'disabled' : '' }}>
                                <option value="">Sélectionnez un type</option>
                                <option value="cours" {{ old('type_enseignement', $ue->type_enseignement) == 'cours' ? 'selected' : '' }}>Cours</option>
                                <option value="td" {{ old('type_enseignement', $ue->type_enseignement) == 'td' ? 'selected' : '' }}>TD</option>
                                <option value="tp" {{ old('type_enseignement', $ue->type_enseignement) == 'tp' ? 'selected' : '' }}>TP</option>
                            </select>
                        </div>

                        <!-- UE Vacante Checkbox -->
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="est_vacant" 
                                   name="est_vacant" value="1" 
                                   {{ old('est_vacant', $ue->est_vacant) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="est_vacant">UE Vacante</label>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-between mt-4 border-top pt-3">
                    <a href="{{ route('coordinateur.ues.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript to handle dynamic fields -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const responsableSelect = document.getElementById('responsable_id');
    const typeContainer = document.getElementById('type_enseignement_container');
    const typeSelect = document.getElementById('type_enseignement');

    responsableSelect.addEventListener('change', function() {
        if (this.value) {
            typeContainer.style.display = 'block';
            typeSelect.disabled = false;
            typeSelect.required = true;
        } else {
            typeContainer.style.display = 'none';
            typeSelect.disabled = true;
            typeSelect.required = false;
            typeSelect.value = '';
        }
    });
});
</script>
@endsection