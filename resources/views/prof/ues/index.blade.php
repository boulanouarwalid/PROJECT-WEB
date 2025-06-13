@extends('layouts.app')

@section('title', 'Expression des souhaits')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg modern-header">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="display-6 fw-bold text-dark mb-2">
                                <i class="bi bi-stars text-warning me-3"></i>
                                Expression des Souhaits
                            </h1>
                            <p class="text-muted mb-0 fs-5">
                                Exprimez vos <span class="text-warning fw-bold">souhaits d'enseignement</span> • Demandes de responsabilité et d'intervention
                            </p>
                        </div>
                        <div class="text-end">
                            <div class="badge bg-warning bg-gradient fs-6 px-3 py-2 mb-2">{{ auth()->user()->deparetement ?? 'Enseignant' }}</div>
                            <div class="small text-muted">{{ now()->format('d/m/Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm">
                <i class="bi bi-check-circle-fill me-2"></i>
                Votre demande pour <strong>{{ session('ue_name') }}</strong> ({{ session('wish_type') }}) a bien été transmise!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    </div>
    @endif

    <!-- Main Content -->
    <div class="row g-4">
        <!-- UE Table -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg modern-form-card">
                <div class="card-header bg-gradient-warning">
                    <h5 class="card-title text-white mb-0">
                        <i class="bi bi-book me-2"></i>Unités d'Enseignement Disponibles
                    </h5>
                </div>
                <div class="card-body p-4">
                    @if($ues->isEmpty())
                        <div class="text-center py-5">
                            <div class="icon-circle bg-muted-light mx-auto mb-3">
                                <i class="bi bi-journal-x text-muted fs-1"></i>
                            </div>
                            <h5 class="text-muted">Aucune UE disponible</h5>
                            <p class="text-muted mb-0">Aucune unité d'enseignement n'est disponible pour exprimer des souhaits actuellement.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 modern-table">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-0 px-4 py-3">Code</th>
                                        <th class="border-0 px-4 py-3">Intitulé</th>
                                        <th class="border-0 px-4 py-3">Semestre</th>
                                        <th class="border-0 px-4 py-3">Volume</th>
                                        <th class="border-0 px-4 py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ues as $ue)
                                    <tr class="border-0">
                                        <td class="px-4 py-3">
                                            <span class="badge bg-warning bg-gradient text-white fw-bold">{{ $ue->code }}</span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div>
                                                <div class="fw-semibold text-dark">{{ $ue->nom }}</div>
                                                <small class="text-muted">{{ $ue->filiere->nom ?? 'N/A' }}</small>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="badge bg-info bg-gradient">S{{ $ue->semestre }}</span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <small class="text-muted">
                                                CM: {{ $ue->heures_cm }}h | TD: {{ $ue->heures_td }}h | TP: {{ $ue->heures_tp }}h
                                            </small>
                                        </td>
                                        <td class="px-4 py-3">
                                            <button class="btn btn-warning modern-btn wish-btn"
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
                        <div class="d-flex justify-content-center mt-4">
                            {{ $ues->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar - My Wishes -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-lg modern-form-card">
                <div class="card-header bg-gradient-info">
                    <h5 class="card-title text-white mb-0">
                        <i class="bi bi-list-check me-2"></i>Mes Demandes
                    </h5>
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

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle wish modal
    document.querySelectorAll('.wish-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            const ueId = this.getAttribute('data-ue-id');
            const ueName = this.getAttribute('data-ue-name');

            document.getElementById('modal_ue_id').value = ueId;
            document.getElementById('modal_ue_name').value = ueName;
        });
    });

    // Handle wish form submission
    document.getElementById('wishForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const submitBtn = document.getElementById('submitWishBtn');
        const originalText = submitBtn.innerHTML;

        // Show loading state
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-1"></i> Envoi...';
        submitBtn.disabled = true;

        const formData = new FormData(this);

        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Close wish modal
                bootstrap.Modal.getInstance(document.getElementById('wishModal')).hide();

                // Show confirmation modal
                document.getElementById('confirmed_ue_name').textContent = data.ue_name;
                document.getElementById('confirmed_wish_type').textContent = data.wish_type;
                new bootstrap.Modal(document.getElementById('confirmationModal')).show();

                // Reset form
                this.reset();

                // Reload page after a delay to show updated wishes
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                alert('Erreur lors de l\'envoi de la demande');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Erreur lors de l\'envoi de la demande');
        })
        .finally(() => {
            // Reset button
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        });
    });

    // Handle delete wish
    let wishToDelete = null;

    document.querySelectorAll('.delete-wish').forEach(function(button) {
        button.addEventListener('click', function() {
            wishToDelete = this.getAttribute('data-wish-id');
            new bootstrap.Modal(document.getElementById('deleteConfirmationModal')).show();
        });
    });

    document.getElementById('confirmDelete').addEventListener('click', function() {
        if (wishToDelete) {
            fetch(`/prof/wishes/${wishToDelete}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    bootstrap.Modal.getInstance(document.getElementById('deleteConfirmationModal')).hide();
                    window.location.reload();
                } else {
                    alert('Erreur lors de la suppression');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Erreur lors de la suppression');
            });
        }
    });
});
</script>

<style>
/* Coordinateur-style CSS */
.modern-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 20px !important;
    transition: all 0.3s ease;
}

.modern-form-card {
    border-radius: 20px !important;
    overflow: hidden;
    transition: all 0.3s ease;
}

.modern-form-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%) !important;
}

.bg-gradient-info {
    background: linear-gradient(135deg, #17a2b8 0%, #117a8b 100%) !important;
}

.modern-btn {
    border-radius: 15px !important;
    transition: all 0.3s ease;
    border: 2px solid;
    font-weight: 600;
}

.modern-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.modern-table {
    font-size: 0.95rem;
}

.modern-table th {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 0.5px;
    color: #6c757d;
}

.icon-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.bg-muted-light {
    background-color: rgba(108, 117, 125, 0.1);
}

.progress {
    border-radius: 10px;
}

.badge {
    border-radius: 8px;
    font-weight: 600;
}

.card-header {
    border-bottom: none !important;
}

.alert {
    border-radius: 15px !important;
}

.modal-content {
    border-radius: 20px !important;
    overflow: hidden;
}

.form-control, .form-select {
    border-radius: 12px !important;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #ffc107;
    box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
}

.list-group-item {
    border-radius: 0 !important;
    border-left: none;
    border-right: none;
}

.list-group-item:first-child {
    border-top: none;
}

.list-group-item:last-child {
    border-bottom: none;
}

.pagination .page-link {
    border-radius: 8px !important;
    margin: 0 2px;
    border: none;
}

.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
    border: none;
}
</style>
@endsection