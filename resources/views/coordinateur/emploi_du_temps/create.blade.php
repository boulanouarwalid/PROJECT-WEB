@extends('layouts.app')

@section('content')
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Ajouter une séance</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('coordinateur.emploi_du_temps.store') }}" method="POST">
                @csrf
                <input type="hidden" name="niveau_id" value="{{ request('niveau_id') }}">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label"><i class="bi bi-book"></i> UE</label>
                        <select name="ue_id" class="form-select" required>
                            <option value="">Sélectionner une UE</option>
                            @foreach ($ues as $ue)
                               <option value="{{ $ue->id }}" {{ old('ue_id') == $ue->id ? 'selected' : '' }}>
                                    {{ $ue->nom }} ({{ $ue->code }})
                                </option>
                            @endforeach
                        </select>
                        @error('ue_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Semestre</label>
                        <select name="semestre" class="form-select" required>
                            @foreach($semestres as $semester)
                                <option value="{{ $semester }}" {{ old('semestre') == $semester ? 'selected' : '' }}>
                                    {{ $semester }}
                                </option>
                            @endforeach
                        </select>
                        @error('semestre')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"><i class="bi bi-person"></i> Enseignant</label>
                        <select name="enseignant_id" class="form-select" required>
                            <option value="">Sélectionner un enseignant</option>
                            @foreach ($enseignants as $e)
                                <option value="{{ $e->id }}" {{ old('enseignant_id') == $e->id ? 'selected' : '' }}>
                                    {{ $e->firstName }} {{ $e->lastName }} 
                                </option>
                            @endforeach
                        </select>
                        @error('enseignant_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"><i class="bi bi-door-open"></i> Salle</label>
                        <select name="salle_id" class="form-select" required>
                            <option value="">Sélectionner une salle</option>
                            @foreach ($salles as $salle)
                                <option value="{{ $salle->id }}" {{ old('salle_id') == $salle->id ? 'selected' : '' }}>
                                    {{ $salle->nom }} ({{ $salle->type }})
                                </option>
                            @endforeach
                        </select>
                        @error('salle_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"><i class="bi bi-calendar-event"></i> Jour</label>
                        <select name="jour" class="form-select" required>
                            @foreach ($jours as $jour)
                                <option value="{{ $jour }}" {{ old('jour') == $jour ? 'selected' : '' }}>
                                    {{ ucfirst($jour) }}
                                </option>
                            @endforeach
                        </select>
                        @error('jour')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"><i class="bi bi-clock-history"></i> Créneau horaire</label>
                        <select name="heure_debut" class="form-select" required>
                            @foreach ($creneaux as $creneau)
                                <option value="{{ $creneau[0] }}" {{ old('heure_debut') == $creneau[0] ? 'selected' : '' }}>
                                    {{ substr($creneau[0], 0, 5) }} - {{ substr($creneau[1], 0, 5) }}
                                </option>
                            @endforeach
                        </select>
                        <input type="hidden" name="heure_fin" id="heure_fin_input">
                        @error('heure_debut')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"><i class="bi bi-journals"></i> Type de séance</label>
                        <select name="type_seance" class="form-select" required>
                            <option value="cours" {{ old('type_seance') == 'cours' ? 'selected' : '' }}>Cours</option>
                            <option value="td" {{ old('type_seance') == 'td' ? 'selected' : '' }}>TD</option>
                            <option value="tp" {{ old('type_seance') == 'tp' ? 'selected' : '' }}>TP</option>
                        </select>
                        @error('type_seance')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"><i class="bi bi-people"></i> Groupe (pour TD/TP)</label>
                        <input type="number" name="groupe" class="form-control" value="{{ old('groupe') }}" min="1">
                        @error('groupe')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Enregistrer
                        </button>
                        <a href="{{ route('coordinateur.et') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Annuler
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set heure_fin based on heure_debut
        const heureDebutSelect = document.querySelector('[name="heure_debut"]');
        const heureFinInput = document.getElementById('heure_fin_input');
        
        const creneauxMap = {
            '08:30:00': '10:30:00',
            '10:30:00': '12:30:00',
            '14:30:00': '16:30:00',
            '16:30:00': '18:30:00'
        };
        
        function updateHeureFin() {
            heureFinInput.value = creneauxMap[heureDebutSelect.value];
        }
        
        heureDebutSelect.addEventListener('change', updateHeureFin);
        updateHeureFin(); // Initialize on page load
    });
</script>
@endsection