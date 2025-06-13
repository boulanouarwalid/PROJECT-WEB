@extends('layouts.app')

@section('title', 'Emploi du Temps')

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
                                <i class="bi bi-calendar3 text-warning me-3"></i>
                                Emploi du Temps
                            </h1>
                            <p class="text-muted mb-0 fs-5">
                                Planification et organisation des cours • <span class="text-warning fw-bold">{{ $selectedSemestre ?? 'S1' }}</span>
                                • Année <span class="text-info fw-bold">{{ date('Y') }}-{{ date('Y')+1 }}</span>
                            </p>
                        </div>
                        <div class="text-end">
                            <div class="badge bg-warning bg-gradient fs-6 px-3 py-2 mb-2">Planning</div>
                            <div class="text-muted">
                                <i class="bi bi-calendar-date me-1"></i>
                                {{ date('d/m/Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg modern-form-card">
                <div class="card-header bg-gradient-primary">
                    <h5 class="card-title text-white mb-0">
                        <i class="bi bi-funnel me-2"></i>Filtres et Navigation
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form method="GET" action="{{ route('coordinateur.et') }}" class="row g-3">
                        <div class="col-lg-4 col-md-6">
                            <label for="niveau" class="form-label fw-semibold">Niveau</label>
                            <div class="input-group modern-input">
                                <span class="input-group-text">
                                   <i class="bi bi-diagram-3 text-primary"></i>
                                </span>
                                <select class="form-select modern-select" id="niveau" name="niveau">
                                    @foreach($niveaux ?? [] as $niveau)
                                        <option value="{{ $niveau->id }}" {{ ($selectedNiveau ?? '') == $niveau->id ? 'selected' : '' }}>
                                            {{ $niveau->nom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <label for="semestre" class="form-label fw-semibold">Semestre</label>
                            <div class="input-group modern-input">
                                <span class="input-group-text">
                                   <i class="bi bi-calendar-week text-primary"></i>
                                </span>
                                <select class="form-select modern-select" id="semestre" name="semestre">
                                    @foreach($semesters ?? ['S1', 'S2', 'S3', 'S4', 'S5', 'S6'] as $semester)
                                        <option value="{{ $semester }}" {{ ($selectedSemestre ?? 'S1') == $semester ? 'selected' : '' }}>
                                            {{ $semester }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 d-flex align-items-end">
                            <button type="submit" class="btn btn-info btn-lg w-100 modern-btn">
                                <i class="bi bi-search me-2"></i>Filtrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Schedule Table -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg modern-form-card">
                <div class="card-header bg-gradient-warning">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title text-white mb-0">
                            <i class="bi bi-calendar3 me-2"></i>Emploi du temps - {{ $selectedSemestre ?? 'S1' }} ({{ date('Y') }}-{{ date('Y')+1 }})
                        </h5>
                        <div>
                            <button class="btn btn-light btn-sm modern-btn me-2">
                                <i class="bi bi-printer me-1"></i>Imprimer
                            </button>
                            <a href="{{ route('coordinateur.emploi_du_temps.create') }}" class="btn btn-success btn-sm modern-btn">
                                <i class="bi bi-plus me-1"></i>Ajouter
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-borderless schedule-table mb-0">
                            <thead class="table-light sticky-top">
                                <tr>
                                    <th class="time-header">Créneaux</th>
                                    @foreach($jours ?? ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'] as $jour)
                                        <th class="day-header">{{ ucfirst($jour) }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($creneaux ?? [['08:30:00', '10:30:00'], ['10:30:00', '12:30:00'], ['14:30:00', '16:30:00'], ['16:30:00', '18:30:00']] as $creneau)
                                <tr>
                                    <td class="time-slot">{{ substr($creneau[0], 0, 5) }}-{{ substr($creneau[1], 0, 5) }}</td>
                                    @foreach($jours ?? ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'] as $jour)
                                        @php
                                            $emploi = $emplois->where('jour', $jour)
                                                            ->where('heure_debut', $creneau[0])
                                                            ->first();
                                        @endphp
                                        @if($emploi)
                                            <td class="course-cell {{ $emploi->type_seance }}" onclick="editSeance({{ $emploi->id }})" style="cursor: pointer;">
                                                <div class="course-info">
                                                    <div class="course-title">{{ $emploi->ue->nom ?? 'UE' }}</div>
                                                    <div class="course-details">
                                                        <i class="bi bi-bookmark me-1"></i>{{ strtoupper($emploi->type_seance) }}<br>
                                                        <i class="bi bi-geo-alt me-1"></i>{{ $emploi->salle->nom ?? 'Salle' }}<br>
                                                        <i class="bi bi-person me-1"></i>{{ $emploi->enseignant->firstName ?? '' }} {{ $emploi->enseignant->lastName ?? '' }}
                                                    </div>
                                                    <div class="course-actions">
                                                        <i class="bi bi-pencil-square text-white"></i>
                                                    </div>
                                                </div>
                                            </td>
                                        @else
                                            <td class="empty-cell" onclick="window.location.href='{{ route('coordinateur.emploi_du_temps.create', ['jour' => $jour, 'heure_debut' => $creneau[0], 'semestre' => $selectedSemestre, 'niveau_id' => $selectedNiveau]) }}'" style="cursor: pointer;" title="Cliquer pour ajouter une séance">
                                                <div class="add-session-hint">
                                                    <i class="bi bi-plus-circle"></i>
                                                    <span>Ajouter</span>
                                                </div>
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Schedule Summary -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg modern-form-card">
                <div class="card-header bg-gradient-info">
                    <h5 class="card-title text-white mb-0">
                        <i class="bi bi-list-ul me-2"></i>Résumé des Séances
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-borderless modern-table">
                            <thead class="table-light sticky-top">
                                <tr>
                                    <th class="border-0 px-4 py-3">
                                        <i class="bi bi-book me-2"></i>UE
                                    </th>
                                    <th class="border-0 px-4 py-3">
                                        <i class="bi bi-person me-2"></i>Enseignant
                                    </th>
                                    <th class="border-0 px-4 py-3">
                                        <i class="bi bi-geo-alt me-2"></i>Salle
                                    </th>
                                    <th class="border-0 px-4 py-3">
                                        <i class="bi bi-calendar-week me-2"></i>Jour
                                    </th>
                                    <th class="border-0 px-4 py-3">
                                        <i class="bi bi-clock me-2"></i>Horaire
                                    </th>
                                    <th class="border-0 px-4 py-3">
                                        <i class="bi bi-bookmark me-2"></i>Type
                                    </th>
                                    <th class="border-0 px-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($emplois ?? [] as $emploi)
                                    <tr class="border-0 history-row">
                                        <td class="px-4 py-3">
                                            <div class="fw-semibold text-primary">{{ $emploi->ue->nom ?? 'UE' }}</div>
                                            <small class="text-muted">{{ $emploi->ue->code ?? '' }}</small>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle bg-primary bg-gradient text-white me-2">
                                                    {{ strtoupper(substr($emploi->enseignant->firstName ?? 'E', 0, 1) . substr($emploi->enseignant->lastName ?? 'N', 0, 1)) }}
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">{{ $emploi->enseignant->firstName ?? '' }} {{ $emploi->enseignant->lastName ?? '' }}</div>
                                                    <small class="text-muted">{{ $emploi->enseignant->role ?? 'Enseignant' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="badge bg-secondary bg-gradient">{{ $emploi->salle->nom ?? 'Salle' }}</span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="fw-semibold">{{ ucfirst($emploi->jour) }}</span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="fw-semibold">{{ substr($emploi->heure_debut, 0, 5) }} - {{ substr($emploi->heure_fin, 0, 5) }}</div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="badge
                                                @if($emploi->type_seance === 'cours') bg-primary bg-gradient
                                                @elseif($emploi->type_seance === 'td') bg-warning bg-gradient
                                                @else bg-success bg-gradient
                                                @endif">
                                                {{ strtoupper($emploi->type_seance) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-end">
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-outline-primary" title="Voir" onclick="viewSeance({{ $emploi->id }})">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary" title="Modifier" onclick="editSeance({{ $emploi->id }})">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" title="Supprimer" onclick="deleteSeance({{ $emploi->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="empty-state">
                                                <i class="bi bi-calendar-x display-1 text-muted mb-3"></i>
                                                <h5 class="text-muted">Aucune séance programmée</h5>
                                                <p class="text-muted">Commencez par ajouter des séances à l'emploi du temps.</p>
                                                <a href="{{ route('coordinateur.emploi_du_temps.create') }}" class="btn btn-primary modern-btn">
                                                    <i class="bi bi-plus me-2"></i>Ajouter une séance
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Edit Seance Modal -->
<div class="modal fade" id="editSeanceModal" tabindex="-1" aria-labelledby="editSeanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modern-modal">
            <div class="modal-header bg-gradient-warning">
                <h5 class="modal-title text-white" id="editSeanceModalLabel">
                    <i class="bi bi-pencil-square me-2"></i>Modifier la Séance
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="editSeanceForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_seance_id" name="seance_id">
                    <div class="row g-3">
                        <!-- Hidden fields for semestre and niveau (will be set dynamically) -->
                        <input type="hidden" id="edit_semestre" name="semestre">
                        <input type="hidden" id="edit_niveau_id" name="niveau_id">

                        <div class="col-12">
                            <label for="edit_ue_id" class="form-label fw-semibold">Unité d'Enseignement <span class="text-danger">*</span></label>
                            <div class="input-group modern-input">
                                <span class="input-group-text">
                                    <i class="bi bi-book text-warning"></i>
                                </span>
                                <select class="form-select modern-select" id="edit_ue_id" name="ue_id" required>
                                    <option value="">Chargement des UEs...</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_enseignant_id" class="form-label fw-semibold">Enseignant <span class="text-danger">*</span></label>
                            <div class="input-group modern-input">
                                <span class="input-group-text">
                                    <i class="bi bi-person text-warning"></i>
                                </span>
                                <select class="form-select modern-select" id="edit_enseignant_id" name="enseignant_id" required>
                                    <option value="">Sélectionner un enseignant</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_salle_id" class="form-label fw-semibold">Salle <span class="text-danger">*</span></label>
                            <div class="input-group modern-input">
                                <span class="input-group-text">
                                    <i class="bi bi-geo-alt text-warning"></i>
                                </span>
                                <select class="form-select modern-select" id="edit_salle_id" name="salle_id" required>
                                    <option value="">Sélectionner une salle</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_type_seance" class="form-label fw-semibold">Type de Séance <span class="text-danger">*</span></label>
                            <div class="input-group modern-input">
                                <span class="input-group-text">
                                    <i class="bi bi-bookmark text-warning"></i>
                                </span>
                                <select class="form-select modern-select" id="edit_type_seance" name="type_seance" required>
                                    <option value="">Sélectionner le type</option>
                                    <option value="cours">Cours Magistral</option>
                                    <option value="td">Travaux Dirigés</option>
                                    <option value="tp">Travaux Pratiques</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="edit_jour" class="form-label fw-semibold">Jour <span class="text-danger">*</span></label>
                            <div class="input-group modern-input">
                                <span class="input-group-text">
                                    <i class="bi bi-calendar-week text-warning"></i>
                                </span>
                                <select class="form-select modern-select" id="edit_jour" name="jour" required>
                                    <option value="">Sélectionner un jour</option>
                                    <option value="lundi">Lundi</option>
                                    <option value="mardi">Mardi</option>
                                    <option value="mercredi">Mercredi</option>
                                    <option value="jeudi">Jeudi</option>
                                    <option value="vendredi">Vendredi</option>
                                    <option value="samedi">Samedi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="edit_heure_debut" class="form-label fw-semibold">Heure Début <span class="text-danger">*</span></label>
                            <div class="input-group modern-input">
                                <span class="input-group-text">
                                    <i class="bi bi-clock text-warning"></i>
                                </span>
                                <input type="time" class="form-control" id="edit_heure_debut" name="heure_debut" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="edit_heure_fin" class="form-label fw-semibold">Heure Fin <span class="text-danger">*</span></label>
                            <div class="input-group modern-input">
                                <span class="input-group-text">
                                    <i class="bi bi-clock-fill text-warning"></i>
                                </span>
                                <input type="time" class="form-control" id="edit_heure_fin" name="heure_fin" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="edit_remarques" class="form-label fw-semibold">Remarques</label>
                            <div class="input-group modern-input">
                                <span class="input-group-text">
                                    <i class="bi bi-chat-text text-warning"></i>
                                </span>
                                <textarea class="form-control" id="edit_remarques" name="remarques" rows="3" placeholder="Remarques optionnelles..."></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary modern-btn" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>Annuler
                </button>
                <button type="button" class="btn btn-warning modern-btn" onclick="updateSeance()">
                    <i class="bi bi-check-circle me-2"></i>Mettre à jour
                </button>
            </div>
        </div>
    </div>
</div>

<!-- View Seance Modal -->
<div class="modal fade" id="viewSeanceModal" tabindex="-1" aria-labelledby="viewSeanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modern-modal">
            <div class="modal-header bg-gradient-info">
                <h5 class="modal-title text-white" id="viewSeanceModalLabel">
                    <i class="bi bi-eye me-2"></i>Détails de la Séance
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div id="viewSeanceContent">
                    <!-- Content will be loaded dynamically -->
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary modern-btn" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>Fermer
                </button>
                <button type="button" class="btn btn-warning modern-btn" onclick="editFromView()">
                    <i class="bi bi-pencil me-2"></i>Modifier
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteSeanceModal" tabindex="-1" aria-labelledby="deleteSeanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modern-modal">
            <div class="modal-header bg-gradient-danger">
                <h5 class="modal-title text-white" id="deleteSeanceModalLabel">
                    <i class="bi bi-exclamation-triangle me-2"></i>Confirmer la Suppression
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <div class="mb-4">
                    <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 4rem;"></i>
                </div>
                <h5 class="mb-3">Êtes-vous sûr de vouloir supprimer cette séance ?</h5>
                <p class="text-muted mb-0">Cette action est irréversible et supprimera définitivement la séance de l'emploi du temps.</p>
                <input type="hidden" id="delete_seance_id">
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary modern-btn" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>Annuler
                </button>
                <button type="button" class="btn btn-danger modern-btn" onclick="confirmDeleteSeance()">
                    <i class="bi bi-trash me-2"></i>Supprimer
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Global variables
let currentSeanceId = null;

// UEs data from database
const uesBySemestre = @json($uesBySemestre ?? []);
const allUes = @json($allUes ?? []);
const enseignants = @json($enseignants ?? []);
const salles = @json($salles ?? []);

// Debug: Log the data to see what we have
console.log('UEs by Semestre:', uesBySemestre);
console.log('All UEs:', allUes);
console.log('Current Semestre:', '{{ $selectedSemestre ?? "S1" }}');

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    console.log('Page loaded');
});





// Edit seance
function editSeance(seanceId) {
    currentSeanceId = seanceId;

    // Fetch seance data
    fetch(`/coordinateur/emploi-du-temps/${seanceId}`)
        .then(response => response.json())
        .then(data => {
            console.log('Edit seance data:', data);

            // Set hidden fields
            document.getElementById('edit_semestre').value = data.semestre || '{{ $selectedSemestre ?? "S1" }}';
            document.getElementById('edit_niveau_id').value = data.niveau_id || '{{ $selectedNiveau ?? "" }}';

            // Load UEs for the semestre and select the current one
            const semestre = data.semestre || '{{ $selectedSemestre ?? "S1" }}';
            const uesForSemestre = uesBySemestre[semestre] || [];
            const ueSelect = document.getElementById('edit_ue_id');

            ueSelect.innerHTML = '<option value="">Sélectionner une UE</option>';

            if (uesForSemestre.length > 0) {
                uesForSemestre.forEach(ue => {
                    const selected = ue.id == data.ue_id ? 'selected' : '';
                    ueSelect.innerHTML += `<option value="${ue.id}" ${selected}>${ue.nom} (${ue.code})</option>`;
                });
            } else {
                ueSelect.innerHTML += '<option value="" disabled>Aucune UE disponible</option>';
            }

            // Populate the rest of the form
            document.getElementById('edit_seance_id').value = data.id;
            document.getElementById('edit_enseignant_id').value = data.enseignant_id;
            document.getElementById('edit_salle_id').value = data.salle_id;
            document.getElementById('edit_type_seance').value = data.type_cours || data.type_seance;
            document.getElementById('edit_jour').value = data.jour;
            document.getElementById('edit_heure_debut').value = data.heure_debut;
            document.getElementById('edit_heure_fin').value = data.heure_fin;
            document.getElementById('edit_remarques').value = data.remarques || '';

            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('editSeanceModal'));
            modal.show();
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Erreur lors du chargement des données', 'error');
        });
}

// Update seance
function updateSeance() {
    const form = document.getElementById('editSeanceForm');
    const formData = new FormData(form);

    // Show loading state
    const updateBtn = event.target;
    const originalText = updateBtn.innerHTML;
    updateBtn.innerHTML = '<i class="bi bi-arrow-clockwise spin me-2"></i>Mise à jour...';
    updateBtn.disabled = true;

    fetch(`/coordinateur/emploi-du-temps/${currentSeanceId}`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('Séance mise à jour avec succès!', 'success');
            bootstrap.Modal.getInstance(document.getElementById('editSeanceModal')).hide();
            location.reload(); // Refresh page to show updated data
        } else {
            showToast('Erreur lors de la mise à jour', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Erreur lors de la mise à jour', 'error');
    })
    .finally(() => {
        updateBtn.innerHTML = originalText;
        updateBtn.disabled = false;
    });
}

// View seance details
function viewSeance(seanceId) {
    fetch(`/coordinateur/emploi-du-temps/${seanceId}`)
        .then(response => response.json())
        .then(data => {
            const content = `
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="view-detail-card">
                            <div class="view-detail-label">Unité d'Enseignement</div>
                            <div class="view-detail-value">${data.ue?.nom || 'N/A'} (${data.ue?.code || 'N/A'})</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="view-detail-card">
                            <div class="view-detail-label">Enseignant</div>
                            <div class="view-detail-value">${data.enseignant?.firstName || ''} ${data.enseignant?.lastName || ''}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="view-detail-card">
                            <div class="view-detail-label">Salle</div>
                            <div class="view-detail-value">${data.salle?.nom || 'N/A'}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="view-detail-card">
                            <div class="view-detail-label">Type de Séance</div>
                            <div class="view-detail-value">${data.type_seance?.toUpperCase() || 'N/A'}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="view-detail-card">
                            <div class="view-detail-label">Jour</div>
                            <div class="view-detail-value">${data.jour?.charAt(0).toUpperCase() + data.jour?.slice(1) || 'N/A'}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="view-detail-card">
                            <div class="view-detail-label">Heure Début</div>
                            <div class="view-detail-value">${data.heure_debut || 'N/A'}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="view-detail-card">
                            <div class="view-detail-label">Heure Fin</div>
                            <div class="view-detail-value">${data.heure_fin || 'N/A'}</div>
                        </div>
                    </div>
                    ${data.remarques ? `
                    <div class="col-12">
                        <div class="view-detail-card">
                            <div class="view-detail-label">Remarques</div>
                            <div class="view-detail-value">${data.remarques}</div>
                        </div>
                    </div>
                    ` : ''}
                </div>
            `;

            document.getElementById('viewSeanceContent').innerHTML = content;
            currentSeanceId = seanceId;

            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('viewSeanceModal'));
            modal.show();
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Erreur lors du chargement des détails', 'error');
        });
}

// Edit from view modal
function editFromView() {
    bootstrap.Modal.getInstance(document.getElementById('viewSeanceModal')).hide();
    setTimeout(() => editSeance(currentSeanceId), 300);
}

// Delete seance
function deleteSeance(seanceId) {
    currentSeanceId = seanceId;
    document.getElementById('delete_seance_id').value = seanceId;

    // Show confirmation modal
    const modal = new bootstrap.Modal(document.getElementById('deleteSeanceModal'));
    modal.show();
}

// Confirm delete seance
function confirmDeleteSeance() {
    const seanceId = document.getElementById('delete_seance_id').value;

    fetch(`/coordinateur/emploi-du-temps/${seanceId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('Séance supprimée avec succès!', 'success');
            bootstrap.Modal.getInstance(document.getElementById('deleteSeanceModal')).hide();
            location.reload(); // Refresh page to remove deleted data
        } else {
            showToast('Erreur lors de la suppression', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Erreur lors de la suppression', 'error');
    });
}

// Toast notification function
function showToast(message, type = 'info') {
    const toastClass = type === 'success' ? 'text-bg-success' : type === 'error' ? 'text-bg-danger' : 'text-bg-info';
    const icon = type === 'success' ? 'check-circle-fill' : type === 'error' ? 'exclamation-triangle-fill' : 'info-circle-fill';

    const toastHtml = `
        <div class="toast align-items-center ${toastClass} border-0 show" role="alert" aria-live="assertive" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-${icon} me-2"></i>
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    `;

    document.body.insertAdjacentHTML('beforeend', toastHtml);

    setTimeout(() => {
        const toast = document.querySelector('.toast:last-of-type');
        if (toast) {
            const bsToast = new bootstrap.Toast(toast);
            bsToast.hide();
            setTimeout(() => toast.remove(), 500);
        }
    }, 5000);
}

// Add spinning animation for loading states
const style = document.createElement('style');
style.textContent = `
    .spin {
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
`;
document.head.appendChild(style);
</script>
@endpush

@push('styles')
<style>
/* Modern Header */
.modern-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    animation: slideInDown 0.6s ease-out;
}

.modern-header .card-body {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 15px;
    backdrop-filter: blur(10px);
}

/* Modern Form Card */
.modern-form-card {
    border-radius: 20px;
    overflow: hidden;
    animation: slideInUp 0.6s ease-out;
}

.modern-form-card .card-header {
    border: none;
    padding: 1.5rem 2rem;
}

/* Modern Inputs */
.modern-input .input-group-text {
    background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
    border: none;
    color: white;
}

.modern-select, .modern-input .form-control {
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
}

.modern-select:focus, .modern-input .form-control:focus {
    border-color: #4299e1;
    box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
}

/* Modern Button */
.modern-btn {
    border-radius: 12px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
}

.modern-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

/* Schedule Table */
.schedule-table {
    font-size: 0.9rem;
}

.time-header, .day-header {
    background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
    color: white;
    font-weight: 600;
    text-align: center;
    padding: 1rem;
    border: none;
}

.time-slot {
    background: #f8fafc;
    font-weight: 600;
    text-align: center;
    vertical-align: middle;
    color: #4a5568;
    border-right: 2px solid #e2e8f0;
}

.course-cell {
    padding: 0.5rem;
    vertical-align: middle;
    border: 1px solid #e2e8f0;
    position: relative;
}

.course-info {
    background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
    color: white;
    padding: 0.75rem;
    border-radius: 8px;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.course-info:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.course-title {
    font-weight: 700;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.course-details {
    font-size: 0.75rem;
    opacity: 0.9;
    line-height: 1.4;
}

.empty-cell {
    background: #f8fafc;
    height: 80px;
    border: 1px solid #e2e8f0;
    position: relative;
    transition: all 0.3s ease;
}

.empty-cell:hover {
    background: linear-gradient(135deg, rgba(72, 187, 120, 0.1) 0%, rgba(56, 161, 105, 0.1) 100%);
    border-color: #48bb78;
}

.add-session-hint {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #a0aec0;
    text-align: center;
    opacity: 0;
    transition: all 0.3s ease;
}

.empty-cell:hover .add-session-hint {
    opacity: 1;
    color: #48bb78;
}

.add-session-hint i {
    font-size: 1.5rem;
    display: block;
    margin-bottom: 0.25rem;
}

.add-session-hint span {
    font-size: 0.8rem;
    font-weight: 600;
}

.course-actions {
    position: absolute;
    top: 5px;
    right: 5px;
    opacity: 0;
    transition: all 0.3s ease;
}

.course-cell:hover .course-actions {
    opacity: 1;
}

/* Course Type Colors */
.course-cell.cours .course-info {
    background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
}

.course-cell.td .course-info {
    background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
}

.course-cell.tp .course-info {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
}

/* Modern Table */
.modern-table {
    border-radius: 15px;
    overflow: hidden;
}

.modern-table tbody tr {
    transition: all 0.3s ease;
}

.modern-table tbody tr:hover {
    background-color: rgba(66, 153, 225, 0.05);
    transform: translateX(5px);
}

/* Avatar Circle */
.avatar-circle {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.75rem;
}

/* Empty State */
.empty-state {
    padding: 3rem 2rem;
}

/* Modern Modals */
.modern-modal {
    border-radius: 20px;
    overflow: hidden;
    border: none;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
}

.modern-modal .modal-header {
    border: none;
    padding: 1.5rem 2rem;
}

.modern-modal .modal-body {
    padding: 2rem;
}

.modern-modal .modal-footer {
    border: none;
    padding: 1.5rem 2rem;
}

.modern-modal .form-label {
    color: #4a5568;
    margin-bottom: 0.5rem;
}

.modern-modal .input-group-text {
    border: none;
    background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
}

.modern-modal .form-control,
.modern-modal .form-select {
    border: 2px solid #e2e8f0;
    border-left: none;
    padding: 0.75rem 1rem;
}

.modern-modal .form-control:focus,
.modern-modal .form-select:focus {
    border-color: #4299e1;
    box-shadow: none;
}

/* Modal Animations */
.modal.fade .modal-dialog {
    transform: scale(0.8) translateY(-50px);
    transition: all 0.3s ease;
}

.modal.show .modal-dialog {
    transform: scale(1) translateY(0);
}

/* View Modal Content */
.view-detail-card {
    background: #f8fafc;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    border-left: 4px solid #4299e1;
}

.view-detail-label {
    font-weight: 600;
    color: #4a5568;
    font-size: 0.9rem;
    margin-bottom: 0.25rem;
}

.view-detail-value {
    color: #2d3748;
    font-size: 1.1rem;
}

/* Animations */
@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .schedule-table {
        font-size: 0.8rem;
    }

    .course-info {
        padding: 0.5rem;
    }

    .course-title {
        font-size: 0.8rem;
    }

    .course-details {
        font-size: 0.7rem;
    }
}
</style>
@endpush