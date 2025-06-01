@extends('layouts.app')

@section('title', 'Création d\'Unité d\'Enseignement')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="h4 mb-0">
                   <i class="bi bi-book-fill"></i> Nouvelle Unité d'Enseignement
                </h2>
                <span class="badge bg-light text-primary fs-6">{{ $departement->nom }}</span>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('coordinateur.ues.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf

                <div class="row g-3">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="code" class="form-label fw-bold">Code UE (Généré automatiquement)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                   <i class="bi bi-tags-fill"></i>
                                </span>
                                <input type="text" class="form-control" id="code" name="code" 
                                       value="{{ old('code') }}" placeholder="Format: DEP-SEM-AA-NNN" readonly>
                            </div>
                            
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Filière</label>
                            <div class="form-control bg-light">
                                {{ $filiere->nom }}
                            </div>
                            <small class="form-text text-muted">Cette UE sera automatiquement associée à votre filière</small>
                        </div>
                        <div class="mb-3">
                            <label for="nom" class="form-label fw-bold">Nom de l'UE <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                   <i class="bi bi-fonts"></i>
                                </span>
                                <input type="text" class="form-control" id="nom" name="nom" 
                                       value="{{ old('nom') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="semestre" class="form-label fw-bold">Semestre <span class="text-danger">*</span></label>
                            <select class="form-select" id="semestre" name="semestre" required>
                                <option value="" disabled selected>Sélectionnez un semestre</option>
                                @foreach(['S1', 'S2', 'S3', 'S4', 'S5', 'S6'] as $sem)
                                    <option value="{{ $sem }}" {{ old('semestre') == $sem ? 'selected' : '' }}>
                                        Semestre {{ $sem }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="semestre" class="form-label fw-bold">Niveaux <span class="text-danger">*</span></label>
                            <select class="form-select" id="niveau_id" name="niveau_id" required>
                                <option value="" disabled selected>Sélectionnez un niveau</option>
                                @foreach($niveaux as $niveau)
                                    <option value="{{ $niveau->id }}" {{ old('niveau') == $niveau ? 'selected' : '' }}>
                                        {{ $niveau->nom }}
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
                                       name="annee_universitaire" value="{{ old('annee_universitaire', date('Y').'-'.(date('Y')+1)) }}" 
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
                                               name="heures_cm" value="{{ old('heures_cm', 0) }}" min="0" required>
                                        <span class="input-group-text">h</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="heures_td" class="form-label small">TD</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="heures_td" 
                                               name="heures_td" value="{{ old('heures_td', 0) }}" min="0" required>
                                        <span class="input-group-text">h</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="heures_tp" class="form-label small">TP</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="heures_tp" 
                                               name="heures_tp" value="{{ old('heures_tp', 0) }}" min="0" required>
                                        <span class="input-group-text">h</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Groupes</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <label for="groupes_td" class="form-label small">Groupes TD</label>
                                    <input type="number" class="form-control" id="groupes_td" 
                                           name="groupes_td" value="{{ old('groupes_td', 0) }}" min="0" required>
                                </div>
                                <div class="col-6">
                                    <label for="groupes_tp" class="form-label small">Groupes TP</label>
                                    <input type="number" class="form-control" id="groupes_tp" 
                                           name="groupes_tp" value="{{ old('groupes_tp', 0) }}" min="0" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="responsable_id" class="form-label fw-bold">Responsable</label>
                            <select class="form-select select2" id="responsable_id" name="responsable_id">
                                <option value="" selected>Sélectionnez un responsable</option>
                                @foreach($enseignants as $enseignant)
                                    <option value="{{ $enseignant->id }}" {{ old('responsable_id') == $enseignant->id ? 'selected' : '' }}>
                                        {{ $enseignant->lastName }} {{ $enseignant->firstName }} ({{ $enseignant->role }}) 
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Optionnel - Doit être du même département</small>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4 border-top pt-3">
                    <a href="{{ route('coordinateur.ues.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Enregistrer l'UE
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--single {
        height: 38px;
        padding-top: 4px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Sélectionnez une option",
        allowClear: true
    });

    // Update the code field when semestre changes
    $('#semestre').change(function() {
        // This would ideally be handled via AJAX to generate the code
        // For now, we'll just show the pattern
        const semestre = $(this).val();
        if (semestre) {
            const year = new Date().getFullYear().toString().slice(-2);
            $('#code').val('DEP-'+semestre+'-'+year+'-XXX');
        } else {
            $('#code').val('');
        }
    });
});
</script>
@endpush