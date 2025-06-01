@extends('layouts.app')

@section('title', 'Détails des Notes')

@section('content')
<div class="container-fluid px-4">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="bi bi-list-check me-2"></i>
                            Notes - {{ $ue->code }} (Session {{ ucfirst($session_type) }})
                        </h4>
                        <div>
                            <span class="badge bg-light text-dark fs-6">
                                Année: {{ $note->academic_year ?? currentAcademicYear() }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-light-success border-0">
                                <div class="card-body text-center">
                                    <h6 class="card-title text-success">Moyenne</h6>
                                    <p class="card-text fs-3 fw-bold">{{ number_format($stats['average'], 2) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-light-info border-0">
                                <div class="card-body text-center">
                                    <h6 class="card-title text-info">Note Max</h6>
                                    <p class="card-text fs-3 fw-bold">{{ $stats['max'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-light-warning border-0">
                                <div class="card-body text-center">
                                    <h6 class="card-title text-warning">Note Min</h6>
                                    <p class="card-text fs-3 fw-bold">{{ $stats['min'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-light-primary border-0">
                                <div class="card-body text-center">
                                    <h6 class="card-title text-primary">Total Étudiants</h6>
                                    <p class="card-text fs-3 fw-bold">{{ $stats['count'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>Matricule</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Note</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($notes as $note)
                                <tr>
                                    <td>{{ $note->etudiant->matricule }}</td>
                                    <td>{{ $note->etudiant->nom }}</td>
                                    <td>{{ $note->etudiant->prenom }}</td>
                                    <td class="fw-bold">{{ $note->valeur }}</td>
                                    <td>
                                        @if($note->valeur >= 10)
                                            <span class="badge bg-success">Validé</span>
                                        @else
                                            <span class="badge bg-danger">Échoué</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <a href="{{ route('vacataire.notes') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Retour
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection