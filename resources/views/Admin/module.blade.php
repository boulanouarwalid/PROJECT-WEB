@extends('layouts.dash')
@section('main')

<section class="container-fluid px-4 py-4">
    <!-- Cartes Statistiques -->
    <div class="cards-row mb-4">
        <div class="card border-0 shadow-sm h-100 text-center">
            <div class="card-body">
                <i class="fas fa-graduation-cap card-icon mb-2" style="color: #3498db; font-size:2rem;"></i>
                <h5 class="card-title">Filières Actives</h5>
                <p class="card-text fw-bold fs-4">{{ $nbrFilirer }}</p>
            </div>
        </div>
        <div class="card border-0 shadow-sm h-100 text-center">
            <div class="card-body">
                <i class="fas fa-building card-icon mb-2" style="color: #2ecc71; font-size:2rem;"></i>
                <h5 class="card-title">Départements</h5>
                <p class="card-text fw-bold fs-4">{{ $nbr_Department }}</p>
            </div>
        </div>
        <div class="card border-0 shadow-sm h-100 text-center">
            <div class="card-body">
                <i class="fas fa-user-tie card-icon mb-2" style="color: #e74c3c; font-size:2rem;"></i>
                <h5 class="card-title">Responsables</h5>
                <p class="card-text fw-bold fs-4">{{ $responsabilite }}</p>
            </div>
        </div>
    </div>

    <!-- Tableau des filières -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h2 class="mb-0 fw-bold text-primary">Liste des Filières</h2>
            <a href="{{ route('createFeliere') }}" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="fa-solid fa-plus"></i> Ajouter
            </a>
        </div>
        <div class="card-body">
            @if(Session()->has('messageFeli'))
                <div id="messageDiv" class="alert alert-success d-flex align-items-center gap-2 mb-3" role="alert">
                    <i class="fa-solid fa-circle-check"></i> {{session('messageFeli')}}
                </div>
            @elseif(Session()->has('ErrerMessage'))
                <div id="messagedive" class="alert alert-danger d-flex align-items-center gap-2 mb-3" role="alert">
                    <i class="fa-solid fa-triangle-exclamation"></i> {{session('ErrerMessage')}}
                </div>
            @elseif(Session()->has('massageValide'))
                <div id="messageDiv" class="alert alert-success d-flex align-items-center gap-2 mb-3" role="alert">
                    <i class="fa-solid fa-circle-check"></i> {{session('massageValide')}}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID_Filière</th>
                            <th>Nom Filière</th>
                            <th>Département Filière</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($filier as $fl)
                        <tr>
                            <td>{{ $fl->id }}</td>
                            <td>{{ $fl->nom }}</td>
                            <td>{{ $fl->nom_departement }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="#" class="btn btn-sm btn-outline-primary" title="Modifier">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <!-- Suppression avec modal Bootstrap -->
                                    <!-- Button to trigger modal -->
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $fl->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>

                                    <!-- Modal (centered and hidden by default) -->
                                    <div class="modal fade" id="deleteModal-{{ $fl->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $fl->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="deleteModalLabel-{{ $fl->id }}">
                                                        <i class="fa-solid fa-triangle-exclamation me-2"></i> Confirmer la suppression
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Êtes-vous sûr de vouloir supprimer cette filière ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <form action="{{ route('delete_fel', $fl->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Confirmer</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Fin Modal -->
                                    <a href="{{ route('listProf', ['id' => $fl->departement_id, 'idFelier' => $fl->id]) }}" class="btn btn-sm btn-outline-secondary" title="Affectation">
                                        <i class="fa-solid fa-share"></i>
                                    </a>
                                </div>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script src="{{ asset('assets/js/ouvert.js') }}"></script>

@endsection
