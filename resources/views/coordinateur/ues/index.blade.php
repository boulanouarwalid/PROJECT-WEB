@extends('layouts.app')

@section('title', "Unités d'Enseignement")

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg modern-header">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="display-6 fw-bold text-dark mb-2">
                                <i class="bi bi-book-half text-primary me-3"></i>
                                Unités d'Enseignement
                            </h1>
                            <p class="text-muted mb-0 fs-5">
                                Gérez vos UEs pour la filière <span class="text-primary fw-bold">{{ $filiere->nom }}</span>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <div class="row g-2">
                                <div class="col-4">
                                    <div class="stat-card bg-primary">
                                        <div class="stat-number">{{ $ues->count() }}</div>
                                        <div class="stat-label">Total</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-card bg-success">
                                        <div class="stat-number">{{ $ues->where('responsable_id', '!=', null)->count() }}</div>
                                        <div class="stat-label">Affectées</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-card bg-warning">
                                        <div class="stat-number">{{ $ues->where('responsable_id', null)->count() }}</div>
                                        <div class="stat-label">Vacantes</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <!-- Filter and Actions Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3">
                    <form method="GET" action="" class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Rechercher</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-search text-muted"></i>
                                </span>
                                <input type="text" name="search" class="form-control border-start-0"
                                       placeholder="Nom, code ou enseignant..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Semestre</label>
                            <select name="semestre" class="form-select">
                                <option value="">Tous</option>
                                @foreach($allSemestres as $sem)
                                    <option value="{{ $sem }}" {{ request('semestre') == $sem ? 'selected' : '' }}>{{ $sem }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Année</label>
                            <select name="annee" class="form-select">
                                <option value="">Toutes</option>
                                @foreach($allAnnees as $annee)
                                    <option value="{{ $annee }}" {{ request('annee') == $annee ? 'selected' : '' }}>{{ $annee }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-funnel"></i>
                            </button>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#importUeModal">
                                    <i class="bi bi-cloud-upload me-1"></i>Importer
                                </button>
                                <a href="{{ route('coordinateur.ues.create') }}" class="btn btn-success btn-sm">
                                    <i class="bi bi-plus-lg me-1"></i>Nouvelle UE
                                </a>
                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteAllModal">
                                    <i class="bi bi-trash3 me-1"></i>Supprimer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- UE Cards Grid -->
    <div class="row g-4">
        @php
        $semesterColors = [
            'S1' => 'primary', 'S2' => 'success', 'S3' => 'info',
            'S4' => 'warning', 'S5' => 'danger', 'S6' => 'secondary'
        ];
        @endphp

        @forelse($ues as $i => $ue)
        @php
            $colorClass = $semesterColors[$ue->semestre] ?? 'primary';
            $totalHours = $ue->heures_cm + $ue->heures_td + $ue->heures_tp;
        @endphp
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 shadow-sm border-0 modern-card" style="animation-delay: {{ 0.1 * $i }}s;">
                <!-- Card Header -->
                <div class="card-header bg-{{ $colorClass }} text-white border-0 p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge bg-light text-{{ $colorClass }} fw-bold">{{ $ue->code }}</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-{{ substr($ue->semestre, 1, 1) }}-circle me-2"></i>
                            <span class="fw-bold">{{ $ue->semestre }}</span>
                        </div>
                    </div>
                    <div class="mt-2">
                        @if($ue->responsable)
                            <span class="badge bg-success bg-opacity-25 text-light">
                                <i class="bi bi-person-check me-1"></i>Affectée
                            </span>
                            <div class="mt-1">
                                <small class="text-light opacity-75">
                                    <i class="bi bi-info-circle me-1"></i>Affectation modifiable
                                </small>
                            </div>
                        @else
                            <span class="badge bg-warning bg-opacity-25 text-light">
                                <i class="bi bi-person-x me-1"></i>Vacante
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body p-3">
                    <h5 class="card-title fw-bold text-dark mb-2">{{ $ue->nom }}</h5>
                    <p class="text-muted small mb-3">{{ $ue->annee_universitaire }}</p>

                    <!-- Teacher Info -->
                    <div class="mb-3">
                        @if($ue->responsable)
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle bg-{{ $colorClass }} text-white me-2">
                                    {{ strtoupper(substr($ue->responsable->firstName, 0, 1)) }}{{ strtoupper(substr($ue->responsable->lastName, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-semibold">{{ $ue->responsable->firstName }} {{ $ue->responsable->lastName }}</div>
                                    <small class="text-muted">{{ ucfirst($ue->responsable->role) }}</small>
                                </div>
                            </div>
                        @else
                            <div class="text-muted fst-italic">
                                <i class="bi bi-person-plus me-1"></i>
                                Aucun enseignant assigné
                            </div>
                        @endif
                    </div>

                    <!-- Hours Info -->
                    <div class="bg-light rounded p-3">
                        <div class="text-center mb-2">
                            <span class="h4 fw-bold text-{{ $colorClass }}">{{ $totalHours }}h</span>
                            <small class="text-muted d-block">Volume total</small>
                        </div>
                        <div class="row text-center">
                            <div class="col-4">
                                <small class="text-muted d-block">CM</small>
                                <span class="fw-bold">{{ $ue->heures_cm }}h</span>
                            </div>
                            <div class="col-4">
                                <small class="text-muted d-block">TD</small>
                                <span class="fw-bold">{{ $ue->heures_td }}h</span>
                            </div>
                            <div class="col-4">
                                <small class="text-muted d-block">TP</small>
                                <span class="fw-bold">{{ $ue->heures_tp }}h</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="card-footer bg-transparent border-0 p-3">
                    <div class="d-grid gap-2">
                        <div class="d-flex gap-2">
                            <a href="{{ route('coordinateur.ues.edit', $ue->id) }}"
                               class="btn btn-outline-{{ $colorClass }} btn-sm flex-fill">
                                <i class="bi bi-pencil-square me-1"></i>Modifier
                            </a>
                            <button type="button" class="btn btn-outline-danger btn-sm flex-fill"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteUeModal"
                                    data-ue-id="{{ $ue->id }}"
                                    data-ue-nom="{{ $ue->nom }}">
                                <i class="bi bi-trash3 me-1"></i>Supprimer
                            </button>
                        </div>
                        @if($ue->responsable)
                            <button type="button" class="btn btn-outline-warning btn-sm w-100"
                                    data-bs-toggle="modal"
                                    data-bs-target="#removeAffectationModal"
                                    data-ue-id="{{ $ue->id }}"
                                    data-ue-nom="{{ $ue->nom }}"
                                    data-responsable-nom="{{ $ue->responsable->firstName }} {{ $ue->responsable->lastName }}">
                                <i class="bi bi-person-dash me-1"></i>Retirer l'affectation
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="bi bi-book display-1 text-muted mb-3"></i>
                    <h3 class="text-muted">Aucune UE trouvée</h3>
                    <p class="text-muted mb-4">Commencez par créer votre première unité d'enseignement</p>
                    <a href="{{ route('coordinateur.ues.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-2"></i>Créer une UE
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>
</div>

<!-- Import UE Modal -->
<div class="modal fade" id="importUeModal" tabindex="-1" aria-labelledby="importUeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="importUeModalLabel">
          <i class="bi bi-cloud-upload me-2"></i>Importer des UEs
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="importUeForm" action="{{ route('coordinateur.ues.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="text-center mb-4">
                <i class="bi bi-file-earmark-excel display-1 text-success mb-3"></i>
                <h6>Sélectionnez votre fichier Excel</h6>
                <p class="text-muted">Formats acceptés: .xlsx, .xls</p>
            </div>
            <div class="mb-3">
                <input class="form-control" type="file" id="ue_file" name="ue_file" accept=".xlsx,.xls" required>
            </div>
            <div class="d-flex gap-2 justify-content-end">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-upload me-2"></i>Importer
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Delete All Confirmation Modal -->
<div class="modal fade" id="confirmDeleteAllModal" tabindex="-1" aria-labelledby="confirmDeleteAllModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="confirmDeleteAllModalLabel">
          <i class="bi bi-exclamation-triangle me-2"></i>Supprimer toutes les UEs
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="text-center mb-3">
          <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 3rem;"></i>
        </div>
        <h6 class="text-danger">Attention !</h6>
        <p>Vous êtes sur le point de supprimer <strong>toutes les UEs</strong> de cette filière.</p>
        <div class="alert alert-warning">
          <ul class="mb-0">
            <li>Cette action est irréversible</li>
            <li>Toutes les affectations seront supprimées</li>
            <li>Les charges horaires associées seront perdues</li>
          </ul>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <form action="{{ route('coordinateur.ues.deleteAll') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-danger">
                <i class="bi bi-trash3 me-2"></i>Supprimer tout
            </button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Delete UE Confirmation Modal -->
<div class="modal fade" id="deleteUeModal" tabindex="-1" aria-labelledby="deleteUeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deleteUeModalLabel">
          <i class="bi bi-trash3 me-2"></i>Supprimer l'UE
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <i class="bi bi-question-circle-fill text-warning mb-3" style="font-size: 3rem;"></i>
        <p>Êtes-vous sûr de vouloir supprimer l'UE <strong id="ueNameToDelete"></strong> ?</p>
        <div class="alert alert-info">
          <i class="bi bi-info-circle me-2"></i>
          Cette action supprimera également toutes les affectations et charges horaires associées.
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <form id="deleteUeForm" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="bi bi-trash3 me-2"></i>Supprimer
            </button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Remove Affectation Confirmation Modal -->
<div class="modal fade" id="removeAffectationModal" tabindex="-1" aria-labelledby="removeAffectationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title" id="removeAffectationModalLabel">
          <i class="bi bi-person-dash me-2"></i>Retirer l'affectation
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <i class="bi bi-exclamation-triangle-fill text-warning mb-3" style="font-size: 3rem;"></i>
        <h6 class="mb-3">Confirmer le retrait d'affectation</h6>
        <p>Êtes-vous sûr de vouloir retirer <strong id="responsableNameToRemove"></strong> de l'UE <strong id="ueNameForAffectation"></strong> ?</p>
        <div class="alert alert-warning">
          <i class="bi bi-info-circle me-2"></i>
          <strong>Cette action va :</strong>
          <ul class="list-unstyled mt-2 mb-0">
            <li>• Supprimer toutes les affectations de cet enseignant pour cette UE</li>
            <li>• Supprimer les charges horaires associées</li>
            <li>• Marquer l'UE comme vacante</li>
          </ul>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button type="button" id="removeAffectationBtn" class="btn btn-warning">
            <i class="bi bi-person-dash me-2"></i>Retirer l'affectation
        </button>
      </div>
    </div>
  </div>
</div>





@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Delete UE Modal Handler
    var deleteUeModal = document.getElementById('deleteUeModal');
    var deleteForm = document.getElementById('deleteUeForm');
    var ueNameToDelete = document.getElementById('ueNameToDelete');

    if (deleteUeModal && deleteForm && ueNameToDelete) {
        deleteUeModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var ueId = button ? button.getAttribute('data-ue-id') : null;
            var ueNom = button ? button.getAttribute('data-ue-nom') : '';

            // Set the UE name in the modal
            ueNameToDelete.textContent = ueNom;

            // Only set the form action if ueId is present
            if (ueId) {
                deleteForm.action = "{{ route('coordinateur.ues.destroy', ':id') }}".replace(':id', ueId);
            } else {
                // Fallback: prevent accidental delete
                deleteForm.action = '#';
            }
        });
    }

    // Remove Affectation Modal Handler
    var removeAffectationModal = document.getElementById('removeAffectationModal');
    var removeAffectationBtn = document.getElementById('removeAffectationBtn');
    var responsableNameToRemove = document.getElementById('responsableNameToRemove');
    var ueNameForAffectation = document.getElementById('ueNameForAffectation');
    var currentUeId = null;

    if (removeAffectationModal) {
        removeAffectationModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var ueId = button ? button.getAttribute('data-ue-id') : null;
            var ueNom = button ? button.getAttribute('data-ue-nom') : '';
            var responsableNom = button ? button.getAttribute('data-responsable-nom') : '';

            console.log('Remove affectation modal opened:', { ueId, ueNom, responsableNom });

            // Store the UE ID for later use
            currentUeId = ueId;

            // Set the names in the modal
            if (responsableNameToRemove) responsableNameToRemove.textContent = responsableNom;
            if (ueNameForAffectation) ueNameForAffectation.textContent = ueNom;
        });
    }

    // Handle remove affectation button click
    if (removeAffectationBtn) {
        removeAffectationBtn.addEventListener('click', function() {
            console.log('=== REMOVE AFFECTATION BUTTON CLICKED ===');
            console.log('Current UE ID:', currentUeId);

            if (!currentUeId) {
                console.error('No UE ID found!');
                alert('Erreur: ID de l\'UE non trouvé');
                return;
            }

            // Show loading state
            const originalContent = this.innerHTML;
            this.innerHTML = '<i class="bi bi-arrow-clockwise spin me-2"></i>Suppression...';
            this.disabled = true;

            // Prepare AJAX request
            const url = "{{ url('/') }}/coordinateur/ues/remove-affectation/" + currentUeId;
            const csrfToken = document.querySelector('meta[name="csrf-token"]');

            console.log('URL:', url);
            console.log('CSRF Token element:', csrfToken);
            console.log('CSRF Token value:', csrfToken ? csrfToken.getAttribute('content') : 'NOT FOUND');

            if (!csrfToken) {
                console.error('CSRF token not found!');
                alert('Erreur: Token CSRF non trouvé');
                this.innerHTML = originalContent;
                this.disabled = false;
                return;
            }

            const csrfTokenValue = csrfToken.getAttribute('content');

            console.log('Making AJAX request...');
            console.log('Request details:', {
                url: url,
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfTokenValue,
                    'Accept': 'application/json'
                }
            });

            // Make AJAX request
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfTokenValue,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => {
                console.log('=== RESPONSE RECEIVED ===');
                console.log('Response status:', response.status);
                console.log('Response statusText:', response.statusText);
                console.log('Response headers:', response.headers);
                console.log('Response ok:', response.ok);

                return response.json().then(data => {
                    console.log('Response JSON data:', data);

                    if (response.ok && data.success) {
                        console.log('SUCCESS: Request completed successfully');
                        alert('Succès: ' + data.message);
                        // Success - reload the page to show updated data
                        window.location.reload();
                    } else {
                        console.error('ERROR: Response indicates failure');
                        throw new Error(data.message || `HTTP ${response.status}: ${response.statusText}`);
                    }
                }).catch(jsonError => {
                    console.log('Failed to parse JSON, trying text...');
                    return response.text().then(text => {
                        console.log('Response body as text:', text);

                        if (response.ok) {
                            console.log('SUCCESS: Request completed successfully (non-JSON response)');
                            alert('Affectation supprimée avec succès!');
                            window.location.reload();
                        } else {
                            throw new Error(`HTTP ${response.status}: ${response.statusText}\nResponse: ${text}`);
                        }
                    });
                });
            })
            .catch(error => {
                console.error('=== ERROR OCCURRED ===');
                console.error('Error details:', error);
                console.error('Error message:', error.message);
                console.error('Error stack:', error.stack);

                alert('Erreur lors de la suppression de l\'affectation: ' + error.message);

                // Restore button state
                this.innerHTML = originalContent;
                this.disabled = false;
            });
        });
    } else {
        console.error('Remove affectation button not found!');
    }

    // Enhanced file upload feedback
    const fileInput = document.getElementById('ue_file');
    const fileLabel = document.querySelector('.file-label');
    const uploadArea = document.querySelector('.upload-area');

    if (fileInput && fileLabel) {
        fileInput.addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            if (fileName) {
                fileLabel.textContent = fileName;
                fileLabel.style.background = 'linear-gradient(135deg, #48bb78 0%, #38a169 100%)';
                uploadArea.style.borderColor = '#48bb78';
                uploadArea.style.background = '#f0fff4';
            }
        });
    }

    // Smooth scroll animations for cards
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    }, observerOptions);

    document.querySelectorAll('.modern-card').forEach(card => {
        observer.observe(card);
    });

    // Enhanced search with debouncing
    const searchInput = document.querySelector('.search-input');
    let searchTimeout;

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                // Auto-submit search after 500ms of no typing
                if (this.value.length >= 3 || this.value.length === 0) {
                    this.closest('form').submit();
                }
            }, 500);
        });
    }

    // Add loading states to action buttons (excluding modal buttons)
    document.querySelectorAll('.action-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (this.tagName === 'A') {
                const originalContent = this.innerHTML;
                this.innerHTML = '<i class="bi bi-arrow-clockwise spin me-2"></i>Chargement...';
                this.disabled = true;

                // Re-enable after 3 seconds as fallback
                setTimeout(() => {
                    this.innerHTML = originalContent;
                    this.disabled = false;
                }, 3000);
            }
        });
    });

    // Handle form submissions with loading states (excluding modal forms)
    document.querySelectorAll('form:not(#deleteUeForm):not(#removeAffectationForm)').forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn && !submitBtn.disabled) {
                const originalContent = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="bi bi-arrow-clockwise spin me-2"></i>Traitement...';
                submitBtn.disabled = true;

                // Re-enable after 10 seconds as fallback
                setTimeout(() => {
                    submitBtn.innerHTML = originalContent;
                    submitBtn.disabled = false;
                }, 10000);
            }
        });
    });



    const deleteUeForm = document.getElementById('deleteUeForm');
    if (deleteUeForm) {
        deleteUeForm.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn && !submitBtn.disabled) {
                const originalContent = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="bi bi-arrow-clockwise spin me-2"></i>Suppression...';
                submitBtn.disabled = true;

                console.log('Delete UE form submitted');
            }
        });
    }
});
</script>

<style>
.spin {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Additional hover effects */
.ue-card {
    animation-play-state: paused;
}

.search-input:focus {
    transform: scale(1.02);
}

.action-btn:active {
    transform: translateY(0) scale(0.98);
}

/* Smooth transitions for all interactive elements */
* {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
</style>
@endpush

@push('styles')
<style>
/* Modern Base Styles */
body {
    background: linear-gradient(120deg, #f8fafc 0%, #e9ecef 100%);
    min-height: 100vh;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.main {
    background: transparent !important;
}

/* Modern Header Card */
.modern-header {
    background: rgba(255, 255, 255, 0.95) !important;
    border-radius: 20px !important;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

/* Statistics Cards */
.stat-card {
    background: linear-gradient(135deg, var(--bs-primary) 0%, var(--bs-primary-dark, #0056b3) 100%);
    color: white;
    padding: 1rem;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-2px);
}

.stat-card.bg-success {
    background: linear-gradient(135deg, var(--bs-success) 0%, #157347 100%) !important;
}

.stat-card.bg-warning {
    background: linear-gradient(135deg, var(--bs-warning) 0%, #e0a800 100%) !important;
}

.stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1;
}

.stat-label {
    font-size: 0.8rem;
    opacity: 0.9;
    margin-top: 0.25rem;
}

/* Modern UE Cards */
.modern-card {
    border-radius: 15px !important;
    transition: all 0.3s ease;
    animation: slideInUp 0.6s ease-out both;
    overflow: hidden;
}

.modern-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
}

.modern-card .card-header {
    border-radius: 15px 15px 0 0 !important;
}

/* Avatar Circle */
.avatar-circle {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    font-weight: 700;
}

/* Animations */
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

/* Enhanced form controls */
.form-control:focus,
.form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

/* Button enhancements */
.btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
}

/* Remove Affectation Button Styling */
.btn-outline-warning {
    border-color: #f59e0b;
    color: #f59e0b;
    transition: all 0.3s ease;
}

.btn-outline-warning:hover {
    background-color: #f59e0b;
    border-color: #f59e0b;
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
}

.btn-outline-warning i {
    transition: transform 0.3s ease;
}

.btn-outline-warning:hover i {
    transform: scale(1.1);
}

/* Modal Enhancements */
.modal-content {
    border-radius: 15px;
    overflow: hidden;
}

.modal-header.bg-warning {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
}

/* Responsive Design */
@media (max-width: 768px) {
    .stat-card {
        margin-bottom: 0.5rem;
    }

    .d-md-flex .btn {
        margin-bottom: 0.5rem;
    }

    .card-footer .d-grid .d-flex {
        flex-direction: column;
    }

    .card-footer .btn {
        margin-bottom: 0.5rem;
    }
}




</style>
@endpush
