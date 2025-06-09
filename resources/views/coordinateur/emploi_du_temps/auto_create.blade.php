<!-- resources/views/coordinateur/emploi_du_temps/auto_create.blade.php -->
@extends('layouts.app')

@section('title', 'Génération Automatique')

@section('content')
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3><i class="bi bi-magic"></i> Génération Automatique d'Emploi du Temps</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('coordinateur.emploi-du-temps.auto-generate') }}" method="POST">
                @csrf
                
                <div class="row mb-4">
                    <div class="col-md-8">
                        <label class="form-label fw-bold">Sélectionnez les UEs à programmer</label>
                        <select name="ues[]" class="form-select select2" multiple="multiple" required>
                            @foreach($ues as $ue)
                            <option value="{{ $ue->id }}">
                                {{ $ue->code }} - {{ $ue->nom }} (Semestre {{ $ue->semestre }})
                                - Enseignant: {{ $ue->affectations->first()->prof->nom }}
                            </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">
                            Sélectionnez une ou plusieurs UEs. Seules les UEs avec des enseignants affectés sont listées.
                        </small>
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Options de génération</label>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="options[avoid_conflicts]" id="avoidConflicts" checked>
                            <label class="form-check-label" for="avoidConflicts">
                                Éviter les conflits de salles
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="options[group_same_ue]" id="groupSameUE" checked>
                            <label class="form-check-label" for="groupSameUE">
                                Grouper les séances d'une même UE
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('coordinateur.et') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-lightning"></i> Générer l'Emploi du Temps
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
    .select2-container--default .select2-selection--multiple {
        min-height: 38px;
        border: 1px solid #ced4da;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Sélectionnez des UEs",
        allowClear: true
    });
});
</script>
@endpush