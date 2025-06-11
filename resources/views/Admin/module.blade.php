@extends('layouts.dash')
@section('main')

<section >
    <!-- Cartes Statistiques -->
    <div class="maincontent">
        <div class="cards-row mb-4">
            <div class="ccard">
                <div>
                    <div class="icon-container">
                        <i class="fas fa-graduation-cap card-icon" style="color: #3498db;"></i>
                    </div>
                    <h3>Filières Actives</h3>
                </div>
                <p>{{ $nbrFilirer }}</p>
            </div>
            <div class="ccard">
                <div>
                    <div class="icon-container">
                        <i class="fas fa-building card-icon" style="color: #2ecc71;"></i>
                    </div>
                    <h3>Départements</h3>
                </div>
                <p>{{ $nbr_Department }}</p>
            </div>
            <div class="ccard">
                <div>
                    <div class="icon-container">
                        <i class="fas fa-user-tie card-icon" style="color: #e74c3c;"></i>
                    </div>
                    <h3>Responsables</h3>
                </div>
                <p>{{ $responsabilite }}</p>
            </div>
        </div>
    </div>

    <!-- Tableau des filières -->
    <div class="table-container">
        <div class="datac mb-3">
            <h2 class="fw-bold text-primary">Liste des Filières</h2>
            <button>
                <a href="{{ route('createFeliere') }}">
                    <i class="fa-solid fa-plus"></i> Ajouter
                </a>
            </button>
        </div>
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
            <table class="tablefelier">
                <thead>
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
                            <div class="ActionBTN">
                                <a href="#" class="modefication btn" title="Modifier">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <!-- Suppression avec modal custom -->
                                <button type="button" class="supresion btn" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $fl->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                <!-- Modal custom -->
                                <div class="modal fade" id="deleteModal-{{ $fl->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $fl->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modale-content">
                                            <div class="mb-3">
                                                <i class="fa-solid fa-triangle-exclamation me-2" style="color:red;font-size:2rem;"></i>
                                            </div>
                                            <h5 class="modal-title mb-2" id="deleteModalLabel-{{ $fl->id }}">
                                                Confirmer la suppression
                                            </h5>
                                            <div class="mb-3">
                                                Êtes-vous sûr de vouloir supprimer cette filière ?
                                            </div>
                                            <div class="modal-buttons">
                                                <button type="button" class="cancel-btn" data-bs-dismiss="modal">Annuler</button>
                                                <form action="{{ route('delete_fel', $fl->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="confirmBtn">
                                                        <i class="fa-solid fa-trash"></i> Confirmer
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Fin Modal -->
                                <a href="{{ route('listProf', ['id' => $fl->departement_id, 'idFelier' => $fl->id]) }}" class="Afectation btn" title="Affectation">
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
</section>

<script src="{{ asset('assets/js/ouvert.js') }}"></script>

@endsection
