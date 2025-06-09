@extends('layouts.app')

@section('title', 'Nouvelle Affectation & Charge Horaire')

@section('content')
<div class="container py-5">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-md-12 text-center">
            <div class="card bg-gradient-primary shadow-lg">
                <div class="card-body py-4">
                    <h2 class="fw-bold text-white mb-2">
                        <i class="bi bi-calendar-plus me-2"></i>
                        Créer une nouvelle affectation & séance
                    </h2>
                    <p class="text-white-50 mb-0">Assignez une unité d'enseignement à un enseignant et planifiez la charge horaire correspondante.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-2 fs-4"></i>
                    <div>
                        <h5 class="alert-heading mb-1">Affectation réussie!</h5>
                        <p class="mb-0">{{ session('success') }}</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif

    @if($errors->any())
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="alert alert-danger alert-dismissible fade show shadow-sm">
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
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-white border-0 py-3">
                    <h4 class="mb-0 text-primary">
                        <i class="bi bi-pencil-square me-2"></i>
                        Formulaire d'affectation
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('charge-horaire.store') }}" method="POST" id="affectationForm">
                        @csrf
                        <input type="hidden" name="affecter_par" value="{{ auth()->id() }}">

                            <!-- Add this hidden field -->
                           

                            <!-- Affectation Details -->
                            <div class="mb-4 p-3 bg-light rounded">
                                <h5 class="text-primary mb-3">Détails de l'Affectation</h5>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="prof_id" class="form-label fw-bold">Enseignant</label>
                                        <select name="prof_id" id="prof_id" class="form-select select2" required>
                                            <option value="">-- Sélectionner --</option>
                                            @foreach($enseignants as $enseignant)
                                                <option value="{{ $enseignant->id }}" @selected(old('prof_id') == $enseignant->id)>
                                                    {{ $enseignant->firstName }} {{ $enseignant->lastName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="niveau_id" class="form-label fw-bold">Niveau</label>
                                        <select name="niveau_id" id="niveau_id" class="form-select" required
                                            @if($selectedType && in_array($selectedType, ['td', 'tp'])) onchange="this.form.is_step=1; this.form.submit()" @endif>
                                            <option value="">-- Choisir le niveau --</option>
                                            @foreach($niveaux as $niveau)
                                                <option value="{{ $niveau->id }}" @selected($selectedNiveau == $niveau->id)>
                                                    {{ $niveau->nom }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="ue_id" class="form-label fw-bold">Unité d'enseignement</label>
                                        <select name="ue_id" id="ue_id" class="form-select" required>
                                            <option value="">-- Choisir --</option>
                                            @foreach($ues as $ue)
                                                <option value="{{ $ue->id }}" 
                                                    data-niveau="{{ $ue->niveau_id }}"
                                                    @selected(old('ue_id') == $ue->id)>
                                                    {{ $ue->nom }} ({{ $ue->code }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="type_enseignement" class="form-label fw-bold">Type d'enseignement</label>
                                        <select name="type_enseignement" id="type_enseignement" class="form-select" required
                                            onchange="this.form.is_step=1; this.form.submit()">
                                            <option value="">-- Choisir --</option>
                                            <option value="cours" @selected($selectedType == 'cours')>Cours</option>
                                            <option value="td" @selected($selectedType == 'td')>TD</option>
                                            <option value="tp" @selected($selectedType == 'tp')>TP</option>
                                        </select>
                                    </div>
                                    
                                    @if($selectedType && in_array($selectedType, ['td', 'tp']))
                                    <div class="col-md-6">
                                        <label for="groupe_id" class="form-label fw-bold">Groupe</label>
                                        <select name="groupe_id" id="groupe_id" class="form-select" required>
                                            <option value="">-- Sélectionner un groupe --</option>
                                            @foreach($filteredGroups as $groupe)
                                                <option value="{{ $groupe->id }}" @selected(old('groupe_id') == $groupe->id)>
                                                    {{ $groupe->nom }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif
                                    
                                    <div class="col-md-6">
                                        <label for="annee_universitaire" class="form-label fw-bold">Année Universitaire</label>
                                        <input type="text" name="annee_universitaire" class="form-control" 
                                            placeholder="2024-2025" value="{{ old('annee_universitaire') }}" required>
                                    </div>
                                </div>
                            </div>

                        <!-- Charge Horaire Section -->
                        <div class="mb-4 p-3 bg-light rounded">
                            <h5 class="text-success mb-3 d-flex align-items-center">
                                <i class="bi bi-clock-history me-2"></i>
                                Détails de la Charge Horaire
                            </h5>

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="volume_horaire" class="form-label fw-bold">Volume Horaire (h)</label>
                                    <div class="input-group">
                                        <input type="number" name="volume_horaire" 
                                            id="volume_horaire" 
                                            class="form-control" min="1" 
                                            value="{{ old('volume_horaire') }}" required>
                                        <span class="input-group-text">heures</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="heures_semaine" class="form-label fw-bold">Heures par semaine (h)</label>
                                    <div class="input-group">
                                        <input type="number" name="heures_semaine" 
                                            id="heures_semaine" 
                                            class="form-control" min="1" 
                                            value="{{ old('heures_semaine') }}" required>
                                        <span class="input-group-text">heures</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="date_debut" class="form-label fw-bold">Date de début</label>
                                    <input type="date" name="date_debut" 
                                        id="date_debut" 
                                        class="form-control" 
                                        value="{{ old('date_debut') }}" required>
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
                            <button type="submit" name="is_final" value="1" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i> Enregistrer l'affectation
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection