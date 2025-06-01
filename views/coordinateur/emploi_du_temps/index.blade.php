@extends('layouts.app')

@section('content')
<div class="container">
    @if($errors->has('ue_file'))
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="bi bi-exclamation-triangle"></i> {{ $errors->first('ue_file') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <i class="bi bi-funnel"></i> Filtres
        </div>
        
        <div class="card-body">
            <form method="GET" action="{{ route('coordinateur.et') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Niveau</label>
                        <select name="niveau" class="form-select">
                            @foreach($niveaux as $niveau)
                                <option value="{{ $niveau->id }}" {{ $selectedNiveau == $niveau->id ? 'selected' : '' }}>
                                    {{ $niveau->nom }}
                                </option>
                            @endforeach
                        </select>

                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label">Semestre</label>
                        <select name="semestre" class="form-select">
                            @foreach($semesters as $semester)
                                <option value="{{ $semester }}" {{ $selectedSemestre == $semester ? 'selected' : '' }}>
                                    {{ $semester }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-filter"></i> Appliquer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>
            <i class="bi bi-calendar2-week"></i> 
            Emploi du Temps - {{ $selectedNiveau }} - Semestre {{ $selectedSemestre }}
        </h2>
        <a href="{{ route('coordinateur.emploi_du_temps.create', [
    'niveau_id' => $selectedNiveau,
    'semestre' => $selectedSemestre
]) }}" 
   class="btn btn-primary">
    <i class="bi bi-plus-circle"></i> Ajouter une séance
</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-bordered text-center mb-0">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 15%">Créneaux</th>
                        @foreach ($jours as $jour)
                            <th>{{ ucfirst($jour) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($creneaux as $creneau)
                        <tr>
                            <td class="align-middle">
                                <i class="bi bi-clock"></i> {{ substr($creneau[0], 0, 5) }} - {{ substr($creneau[1], 0, 5) }}
                            </td>
                            @foreach ($jours as $jour)
                                <td style="min-height: 100px;">
                                    @foreach ($emplois as $emploi)
                                        @if ($emploi->jour == $jour && $emploi->heure_debut == $creneau[0])
                                            <div class="p-2 rounded mb-2 
                                                @if($emploi->type_seance == 'cours') bg-primary text-white
                                                @elseif($emploi->type_seance == 'td') bg-warning text-dark
                                                @else bg-info text-white
                                                @endif">
                                               <strong>{{ $emploi->ue?->nom ?? 'N/A' }}</strong><br>
                                                {{ $emploi->enseignant?->firstName ?? '' }} {{ $emploi->enseignant?->lastName ?? '' }}<br>
                                                {{ $emploi->salle?->nom ?? 'N/A' }}
                                                @if($emploi->groupe)
                                                    <br>Groupe {{ $emploi->groupe }}
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection