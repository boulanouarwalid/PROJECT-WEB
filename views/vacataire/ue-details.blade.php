@extends('layouts.app')

@section('title', 'Détails UE - ' . $ue->nom)

@section('content')
<div class="container-fluid px-4">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Détails de l'Unité d'Enseignement</h5>
                        <a href="{{ route('vacataire.ues') }}" class="btn btn-sm btn-light">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>{{ $ue->code }} - {{ $ue->nom }}</h4>
                            <hr>
                            <div class="mb-3">
                                <strong>Filière:</strong> {{ $ue->filiere->nom }}
                            </div>
                            <div class="mb-3">
                                <strong>Niveau:</strong> {{ $ue->niveau->nom }}
                            </div>
                            <div class="mb-3">
                                <strong>Semestre:</strong> {{ $ue->semestre }}
                            </div>
                            <div class="mb-3">
                                <strong>Année Universitaire:</strong> {{ $ue->annee_universitaire }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>Volume Horaire</h5>
                            <hr>
                            <div class="mb-3">
                                <strong>Heures CM:</strong> {{ $ue->heures_cm }}
                            </div>
                            <div class="mb-3">
                                <strong>Heures TD:</strong> {{ $ue->heures_td }}
                            </div>
                            <div class="mb-3">
                                <strong>Heures TP:</strong> {{ $ue->heures_tp }}
                            </div>
                            <div class="mb-3">
                                <strong>Groupes TD:</strong> {{ $ue->groupes_td }}
                            </div>
                            <div class="mb-3">
                                <strong>Groupes TP:</strong> {{ $ue->groupes_tp }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <h5>Actions</h5>
                        <hr>
                        <div class="d-flex gap-2">
                            <a href="{{ route('vacataire.notes.upload', ['ue' => $ue->id, 'session' => 'normale']) }}" 
                               class="btn btn-primary">
                                <i class="bi bi-upload"></i> Uploader Notes Normale
                            </a>
                            <a href="{{ route('vacataire.notes.upload', ['ue' => $ue->id, 'session' => 'rattrapage']) }}" 
                               class="btn btn-warning">
                                <i class="bi bi-upload"></i> Uploader Notes Rattrapage
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection