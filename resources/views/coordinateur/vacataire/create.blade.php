@extends('layouts.app')

@section('title', 'Création de Comptes Vacataires')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom ">
    <h1 class="h2 text-dark">Création de Comptes Vacataires</h1>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Formulaire de Création</h5>
    </div>
    <div class="card-body bg-light">
        <form id="vacataireForm" method="POST" action="{{ route('vacataire.create') }}">
            @csrf
            <div class="row g-3 ">
                <div class="col-md-6">
                    <label for="nom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                </div>
                <div class="col-md-6">
                    <label for="prenom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="emailpersonel"   name="emailpersonel" required>
                </div>
                <div class="col-md-6">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="tel" class="form-control" id="Numerotelephone" name="Numerotelephone">
                </div>
                <div class="col-md-6">
                    <label for="telephone" class="form-label">Ville</label>
                    <input type="text" class="form-control" id="ville" name="ville">
                </div>
                <div class="col-md-6">
                    <label for="telephone" class="form-label">Numero de la Carte Nationale</label>
                    <input type="text" class="form-control" id="CIN" name="CIN">
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="sendCredentials">
                        <label class="form-check-label" for="sendCredentials">
                            Envoyer les identifiants par email
                        </label>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <input type="hidden" name="role" value="vacataire">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-save"></i> Enregistrer
                    </button>
                    <button type="reset" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-counterclockwise"></i> Réinitialiser
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Liste des Vacataires</h5>
    </div>
    <div class="card-body bg-light">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom Complet</th>
                        <th>Email</th>
                        <th>Spécialité</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vacataires as $vacataire)
                    <tr>
                        <td>VAC-{{ $vacataire->id }}</td>
                        <td>{{ $vacataire->firstName }} {{ $vacataire->lastName }}</td>
                        <td>{{ $vacataire->email }}</td>
                        <td>{{ $vacataire->specialite }}</td>
                        <td>
                            <span class="badge 
                                @if($vacataire->status === 'active') bg-success
                                @elseif($vacataire->status === 'inactive') bg-danger
                                @else bg-warning text-dark
                                @endif">
                                {{ ucfirst($vacataire->status) }}
                            </span>
                        </td>
                        <td>
                            @foreach($vacataire->responsabilites as $responsabilite)
                                <span class="badge bg-info text-dark mb-1">
                                    {{ $responsabilite->filiere->nom }} ({{ $responsabilite->date_debut->format('d/m/Y') }} - {{ $responsabilite->date_fin->format('d/m/Y') }})
                                </span>
                            @endforeach
                        </td>
                        <td>
                            <!-- Status Change Dropdown -->
                            <div class="dropdown d-inline me-1">
                                <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" 
                                        id="statusDropdown{{ $vacataire->id }}" data-bs-toggle="dropdown" 
                                        aria-expanded="false">
                                    <i class="bi bi-pencil"></i> Modifier
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="statusDropdown{{ $vacataire->id }}">
                                    <li><a class="dropdown-item status-change" href="#" 
                                           data-id="{{ $vacataire->id }}" data-status="active">Activer</a></li>
                                    <li><a class="dropdown-item status-change" href="#" 
                                           data-id="{{ $vacataire->id }}" data-status="inactive">Désactiver</a></li>
                                    <li><a class="dropdown-item status-change" href="#" 
                                           data-id="{{ $vacataire->id }}" data-status="pending">En attente</a></li>
                                </ul>
                            </div>
                            
                            <button class="btn btn-sm btn-outline-danger delete-vacataire" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteVacataireModal"
                                    data-id="{{ $vacataire->id }}"
                                    data-url="{{ route('vacataire.destroy', $vacataire->id) }}"
                                    data-name="{{ $vacataire->firstName }} {{ $vacataire->lastName }}">
                                <i class="bi bi-trash"></i> Supprimer
                            </button>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $vacataires->links() }}
        </div>
    </div>
</div>
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteVacataireModal" tabindex="-1" aria-labelledby="deleteVacataireModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteVacataireModalLabel">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer <span id="vacataire-name"></span> ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form id="deleteVacataireForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
            
            

        </div>
    </div>
</div>
<!-- Success toast -->
<div id="deleteSuccessToast" class="toast">
    <div class="toast-body">
        <i class="bi bi-check-circle-fill me-2"></i>
        <span id="toastMessage"></span>
    </div>
</div>

@endsection