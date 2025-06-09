@extends('layouts.app')

@section('title', 'Gestion des Charges Horaires')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mt-4">
        <h1><i class="bi bi-clock me-2"></i>Gestion des Charges Horaires</h1>
        <!-- Bouton Ajouter une affectation -->
        <a href="{{ route('charge-horaire.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Nouvelle Affectation
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Résumé de charge -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <i class="bi bi-graph-up me-1"></i>
            Résumé Annuel
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-{{ $alerteCharge ? 'warning' : 'success' }}">
                        <i class="bi bi-{{ $alerteCharge ? 'exclamation-triangle' : 'check-circle' }} me-2"></i>
                        Charge totale: <strong>{{ $chargeTotale }}h</strong> / {{ $chargeMinimale }}h
                        @if($alerteCharge)
                        <div class="mt-2">
                            <i class="bi bi-info-circle me-1"></i>
                            Vous n'avez pas atteint la charge minimale requise
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des affectations -->
    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            <i class="bi bi-list-check me-1"></i>
            Mes Affectations
        </div>
        <div class="card-body">
            @if($affectations->isEmpty())
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    Vous n'avez aucune affectation cette année.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>UE</th>
                                <th>Type</th>
                                <th>Charge Totale</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($affectations as $affectation)
                            <tr>
                                <td>{{ $affectation->ue->nom }}</td>
                                <td>
                                    <span class="badge bg-secondary">{{ $affectation->type_enseignement }}</span>
                                </td>
                                <td>{{ $affectation->charge_totale }}h</td>
                                <td>
                                    <button class="btn btn-sm btn-info show-details"
                                            data-bs-toggle="modal"
                                            data-bs-target="#detailsModal"
                                            data-affectation-id="{{ $affectation->id }}">
                                        <i class="bi bi-eye me-1"></i> Détails
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal pour les détails -->
<div class="modal fade" id="detailsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Détails des séances</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalDetailsContent">
                <!-- Contenu chargé via AJAX -->
                <div class="text-center my-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Chargement...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Chargement des détails via AJAX
    $('.show-details').on('click', function() {
        const affectationId = $(this).data('affectation-id');
        $('#modalDetailsContent').load(`/affectations/${affectationId}/details`);
    });
});
</script>
@endsection