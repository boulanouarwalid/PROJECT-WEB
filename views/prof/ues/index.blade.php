@extends('layouts.app')

@section('title', 'Expression des souhaits')

@section('content')
<div class="container-fluid px-4">
    <!-- Success Alert -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3">
        <i class="bi bi-check-circle-fill me-2"></i>
        Votre demande pour <strong>{{ session('ue_name') }}</strong> ({{ session('wish_type') }}) a bien été transmise!
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Page Header -->
    <h1 class="mt-4"><i class="bi bi-stars me-2"></i>Expression des souhaits d'enseignement</h1>
    
    <div class="row mt-4">
        <!-- Main Content - UE Table -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <i class="bi bi-book me-2"></i>
                    Unités d'Enseignement Disponibles
                </div>
                <div class="card-body">
                    @if($ues->isEmpty())
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>Aucune UE disponible actuellement.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Code</th>
                                        <th>Intitulé</th>
                                        <th>Semestre</th>
                                        <th>Type</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ues as $ue)
                                    <tr>
                                        <td class="fw-semibold">{{ $ue->code }}</td>
                                        <td>{{ $ue->nom }}</td>
                                        <td>S{{ $ue->semestre }}</td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $ue->type }}</span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-success wish-btn" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#wishModal"
                                                    data-ue-id="{{ $ue->id }}"
                                                    data-ue-name="{{ $ue->nom }}">
                                                <i class="bi bi-send-check me-1"></i>Exprimer un souhait
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            {{ $ues->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar - My Wishes -->
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header bg-info text-white d-flex align-items-center">
                    <i class="bi bi-list-check me-2"></i>
                    Mes demandes
                </div>
                <div class="card-body p-0">
                    @if(auth()->user()->wishes->isEmpty())
                        <div class="alert alert-info m-3">
                            <i class="bi bi-info-circle me-2"></i>Vous n'avez aucune demande en cours.
                        </div>
                    @else
                        <div class="list-group list-group-flush">
                            @foreach(auth()->user()->wishes as $wish)
                            <div class="list-group-item position-relative py-3">
                                @if(in_array($wish->status, ['en attent']))
                                <button class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 delete-wish" 
                                        data-wish-id="{{ $wish->id }}"
                                        title="Supprimer cette demande">
                                    <i class="bi bi-trash"></i>
                                </button>
                                @endif
                                
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1 fw-semibold">{{ $wish->ue->nom }}</h6>
                                    <span class="badge bg-{{ $wish->status == 'accepetee' ? 'success' : ($wish->status == 'refusee' ? 'danger' : 'warning') }}">
                                        {{ $wish->status == 'approved' ? 'Accepté' : ($wish->status == 'refusee' ? 'refusee' : 'en attent') }}
                                    </span>
                                </div>
                                <p class="mb-1">
                                    <small class="text-muted">
                                        <i class="bi bi-tag me-1"></i>{{ $wish->type }}
                                    </small>
                                </p>
                                @if($wish->message)
                                <p class="mb-1 small text-muted">{{ $wish->message }}</p>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals Section -->
<!-- Wish Request Modal -->
<div class="modal fade" id="wishModal" tabindex="-1" aria-labelledby="wishModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="wishModalLabel">
                    <i class="bi bi-send-check me-2"></i>Nouvelle demande
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="wishForm" action="{{ route('wishes.store') }}" method="POST">
                @csrf
                <input type="hidden" name="ue_id" id="modal_ue_id" value="">
                
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="modal_ue_name" class="form-label">UE concernée</label>
                        <input type="text" class="form-control" id="modal_ue_name" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label for="wish_type" class="form-label">Type de souhait <span class="text-danger">*</span></label>
                        <select class="form-select" id="wish_type" name="wish_type" required>
                            <option value="">-- Sélectionnez --</option>
                            <option value="Responsable">Responsable d'UE</option>
                            <option value="Intervenant">Intervenant principal</option>
                            <option value="Supplementaire">Heures supplémentaires</option>
                            <option value="Autre">Autre demande</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="wish_message" class="form-label">Message complémentaire</label>
                        <textarea class="form-control" id="wish_message" name="message" rows="3" 
                                placeholder="Précisez vos motivations, disponibilités..."></textarea>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Annuler
                    </button>
                    <button type="submit" class="btn btn-primary" id="submitWishBtn">
                        <i class="bi bi-send-check me-1"></i> Envoyer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="bi bi-exclamation-triangle me-2"></i>Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer cette demande ? Cette action est irréversible.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Supprimer</button>
            </div>
        </div>
    </div>
</div>

<!-- Success Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="confirmationModalLabel">
                    <i class="bi bi-check-circle me-2"></i>Demande envoyée
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Votre demande pour <strong id="confirmed_ue_name"></strong> (<span id="confirmed_wish_type"></span>) a bien été transmise au coordinateur.</p>
                <p>Vous serez notifié par email de la réponse.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">
                    <i class="bi bi-check-circle me-1"></i> Compris
                </button>
            </div>
        </div>
    </div>
</div>

@endsection