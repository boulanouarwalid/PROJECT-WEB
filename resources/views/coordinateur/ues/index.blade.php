@extends('layouts.app')

@section('title', "Unités d'Enseignement")

@section('content')
<div class="container py-5" style="max-width: 1100px;">
    <!-- Filter/Search Bar + Action Bar -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <form method="GET" action="" class="filter-perfect d-flex align-items-center gap-2 px-4 py-2 shadow animate-fadein" style="width:100%; max-width:520px;">
            <div class="input-group flex-grow-1">
                <span class="input-group-text bg-transparent border-0 ps-0 pe-2"><i class="bi bi-search text-primary"></i></span>
                <input type="text" name="search" class="form-control border-0 bg-transparent filter-pill-input" placeholder="Rechercher une UE..." value="{{ request('search') }}" style="min-width:120px;">
            </div>
            <select name="semestre" class="form-select filter-pill-input" style="width:140px;">
                <option value="">Semestre</option>
                @foreach($allSemestres as $sem)
                    <option value="{{ $sem }}" {{ request('semestre') == $sem ? 'selected' : '' }}>{{ $sem }}</option>
                @endforeach
            </select>
            <button class="btn btn-primary filter-pill-btn px-4" type="submit">Filtrer</button>
        </form>
        <div class="d-flex gap-2 mt-3 mt-md-0">
            <button type="button" class="btn btn-outline-primary soft-btn d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#importUeModal">
                <i class="bi bi-upload"></i> Importer
            </button>
            <a href="{{ route('coordinateur.ues.create') }}" class="btn btn-primary soft-btn d-flex align-items-center gap-1">
                <i class="bi bi-plus-circle"></i> Nouvelle UE
            </a>
            <button type="button" class="btn btn-danger soft-btn d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#confirmDeleteAllModal">
                <i class="bi bi-trash"></i> Supprimer toutes
            </button>
        </div>
    </div>

    <!-- UE Cards Grid -->
    <div class="row g-4">
        @php
        $semColors = [
            'S1' => 'linear-gradient(135deg, #43cea2 0%, #185a9d 100%)',
            'S2' => 'linear-gradient(135deg, #ff758c 0%, #ffb199 100%)',
            'S3' => 'linear-gradient(135deg, #fcb69f 0%, #ffecd2 100%)',
            'S4' => 'linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%)',
            'S5' => 'linear-gradient(135deg, #f6d365 0%, #fda085 100%)',
            'S6' => 'linear-gradient(135deg, #d4fc79 0%, #96e6a1 100%)',
        ];
        @endphp
        @forelse($ues as $i => $ue)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0 unit-card soft-card animate-card gradient-border" style="background: {{ $semColors[$ue->semestre] ?? $semColors['S1'] }}; animation-delay: {{ 0.05 * $i }}s;">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center mb-2">
                        <div class="unit-code badge bg-gradient-pink me-2">{{ $ue->code }}</div>
                        <div class="ms-auto text-muted small"><span class="badge bg-gradient-blue">{{ $ue->credits ?? '—' }} ECTS</span></div>
                    </div>
                    <h5 class="card-title fw-bold mb-1 text-dark">{{ $ue->nom }}</h5>
                    <div class="mb-2">
                        <span class="badge bg-gradient-sem me-1">{{ $ue->semestre }}</span>
                        <span class="badge bg-gradient-year">{{ $ue->annee_universitaire }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="text-muted small">Enseignant(s): </span>
                        <span class="fw-semibold">
                            @if($ue->responsable)
                                <span class="d-inline-flex align-items-center gap-2">
                                    <span class="rounded-circle bg-gradient-avatar text-white d-flex justify-content-center align-items-center" style="width:28px;height:28px;font-size:0.95rem;">
                                        {{ strtoupper(substr($ue->responsable->firstName,0,1)) }}{{ strtoupper(substr($ue->responsable->lastName,0,1)) }}
                                    </span>
                                    {{ $ue->responsable->firstName }} {{ $ue->responsable->lastName }}
                                </span>
                            @else
                                <span class="text-warning">Vacant</span>
                            @endif
                        </span>
                    </div>
                    <div class="mb-3">
                        <span class="badge bg-gradient-hours me-1">CM: {{ $ue->heures_cm }}h</span>
                        <span class="badge bg-gradient-hours me-1">TD: {{ $ue->heures_td }}h</span>
                        <span class="badge bg-gradient-hours">TP: {{ $ue->heures_tp }}h</span>
                    </div>
                    <div class="d-flex gap-2 mt-auto">
                        <a href="{{ route('coordinateur.ues.edit', $ue->id) }}" class="btn btn-outline-secondary soft-btn flex-grow-1" title="Modifier">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <button type="button" class="btn btn-outline-danger soft-btn flex-grow-1" title="Supprimer" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteUeModal" 
                                data-ue-id="{{ $ue->id }}" 
                                data-ue-nom="{{ $ue->nom }}">
                            <i class="bi bi-trash3-fill"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">Aucune UE trouvée.</div>
        </div>
        @endforelse
    </div>
</div>

<!-- Import UE Modal -->
<div class="modal fade" id="importUeModal" tabindex="-1" aria-labelledby="importUeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content soft-card">
      <div class="modal-header border-0">
        <h5 class="modal-title text-primary" id="importUeModalLabel"><i class="bi bi-upload"></i> Importer des UEs</h5>
        <button type="button" class="btn-close soft-btn" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="importUeForm" action="{{ route('coordinateur.ues.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="ue_file" class="form-label">Fichier Excel (.xlsx, .xls)</label>
                <input class="form-control" type="file" id="ue_file" name="ue_file" accept=".xlsx,.xls" required>
            </div>
            <div class="d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-outline-secondary soft-btn" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary soft-btn">Importer</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Delete All Confirmation Modal -->
<div class="modal fade" id="confirmDeleteAllModal" tabindex="-1" aria-labelledby="confirmDeleteAllModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content soft-card">
      <div class="modal-header border-0">
        <h5 class="modal-title text-danger" id="confirmDeleteAllModalLabel"><i class="bi bi-exclamation-triangle"></i> Confirmation</h5>
        <button type="button" class="btn-close soft-btn" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <p class="mb-0">Êtes-vous sûr de vouloir supprimer <b>toutes</b> les UEs ?<br><span class="text-danger">Cette action est irréversible.</span></p>
      </div>
      <div class="modal-footer border-0 justify-content-center">
        <form action="{{ route('coordinateur.ues.deleteAll') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger soft-btn px-4">Oui, supprimer tout</button>
        </form>
        <button type="button" class="btn btn-outline-secondary soft-btn px-4" data-bs-dismiss="modal">Annuler</button>
      </div>
    </div>
  </div>
</div>
<!-- Delete UE Confirmation Modal -->
<div class="modal fade" id="deleteUeModal" tabindex="-1" aria-labelledby="deleteUeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-danger text-white">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="deleteUeModalLabel"><i class="bi bi-exclamation-triangle"></i> Confirmation de suppression</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <p class="mb-0">Êtes-vous sûr de vouloir supprimer l'UE <b id="ueNameToDelete"></b> ?<br><span class="text-warning">Cette action est irréversible.</span></p>
      </div>
      <div class="modal-footer border-0 justify-content-center">
        <form id="deleteUeForm" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-light text-danger px-4">Oui, supprimer</button>
        </form>
        <button type="button" class="btn btn-outline-light px-4" data-bs-dismiss="modal">Annuler</button>
      </div>
    </div>
  </div>
</div>

<!-- Info Modal for UE Add Restriction -->
<div class="modal fade" id="infoUeRestrictionModal" tabindex="-1" aria-labelledby="infoUeRestrictionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title text-primary" id="infoUeRestrictionModalLabel"><i class="bi bi-info-circle"></i> Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <p class="mb-0">Vous ne pouvez ajouter des UE qu'au début de l'année.</p>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var infoModal = new bootstrap.Modal(document.getElementById('infoUeRestrictionModal'));
    infoModal.show();
    setTimeout(function() {
        infoModal.hide();
    }, 3000);
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var deleteUeModal = document.getElementById('deleteUeModal');
    var form = document.getElementById('deleteUeForm');
    var ueNameToDelete = document.getElementById('ueNameToDelete');

    if (deleteUeModal && form && ueNameToDelete) {
        deleteUeModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var ueId = button ? button.getAttribute('data-ue-id') : null;
            var ueNom = button ? button.getAttribute('data-ue-nom') : '';

            // Set the UE name in the modal
            ueNameToDelete.textContent = ueNom;

            // Only set the form action if ueId is present
            if (ueId) {
                form.action = "{{ route('coordinateur.ues.destroy', ':id') }}".replace(':id', ueId);
            } else {
                // Fallback: prevent accidental delete
                form.action = '#';
            }
        });
    }
});
</script>

@endsection

@push('styles')
<style>
body {
    background: linear-gradient(120deg, #f8fafc 0%, #e9ecef 100%);
}
.filter-perfect {
    background: rgba(255,255,255,0.95);
    border-radius: 2.5rem;
    box-shadow: 0 4px 32px 0 rgba(60,72,100,.10), 0 1.5px 4px 0 rgba(60,72,100,.04);
    border: 2.5px solid #e3e7ed;
    transition: box-shadow 0.2s, border-color 0.2s;
    position: relative;
}
.filter-perfect:focus-within {
    box-shadow: 0 8px 32px 0 rgba(67,206,162,0.13), 0 2px 8px 0 rgba(255,117,140,0.10);
    border-color: #43cea2;
}
.filter-pill-input {
    border-radius: 2rem !important;
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
    font-size: 1.08rem;
}
.filter-pill-btn {
    border-radius: 2rem !important;
    font-weight: 500;
    font-size: 1.08rem;
    box-shadow: 0 2px 8px 0 rgba(60,72,100,.06);
    padding-left: 2rem !important;
    padding-right: 2rem !important;
}
.filter-pill-btn:focus, .filter-pill-btn:hover {
    background: #43cea2 !important;
    color: #fff !important;
    border: none !important;
}
.soft-card {
    background: #fafdff;
    border-radius: 1.5rem;
    box-shadow: 0 4px 32px 0 rgba(60,72,100,.10), 0 1.5px 4px 0 rgba(60,72,100,.04);
    border: none;
}
.unit-card {
    border-radius: 1.25rem;
    background: #fafdff;
    transition: box-shadow 0.3s, transform 0.3s;
    animation: cardIn 0.7s cubic-bezier(.4,2,.6,1) both;
    border: 3px solid transparent;
    background-clip: padding-box, border-box;
    position: relative;
    z-index: 1;
}
.unit-card.gradient-border {
    box-shadow: 0 8px 32px 0 rgba(67,206,162,0.13), 0 2px 8px 0 rgba(255,117,140,0.10);
    border-image: linear-gradient(135deg,#43cea2,#185a9d,#ff758c,#ffb199) 1;
}
.unit-card:hover {
    box-shadow: 0 16px 48px 0 rgba(60,72,100,.18), 0 4px 16px 0 rgba(60,72,100,.10);
    transform: translateY(-8px) scale(1.04) rotate(-1deg);
    z-index: 2;
    filter: brightness(1.04) saturate(1.1);
}
.unit-code {
    font-size: 0.95em;
    padding: 0.4em 0.8em;
    border-radius: 1em;
    letter-spacing: 0.03em;
    background: linear-gradient(90deg,#ff758c,#ff7eb3,#ffb199);
    color: #fff !important;
    border: none;
}
.bg-gradient-pink {
    background: linear-gradient(90deg,#ff758c,#ff7eb3,#ffb199)!important;
    color: #fff!important;
}
.bg-gradient-blue {
    background: linear-gradient(90deg,#43cea2,#185a9d)!important;
    color: #fff!important;
}
.bg-gradient-sem {
    background: linear-gradient(90deg,#a1c4fd,#c2e9fb)!important;
    color: #185a9d!important;
}
.bg-gradient-year {
    background: linear-gradient(90deg,#fcb69f,#ffecd2)!important;
    color: #a15c00!important;
}
.bg-gradient-hours {
    background: linear-gradient(90deg,#f6d365,#fda085)!important;
    color: #7a4a00!important;
    border: none!important;
}
.bg-gradient-avatar {
    background: linear-gradient(135deg,#43cea2,#185a9d)!important;
    color: #fff!important;
}
.animate-fadein {
    animation: fadeInUp 0.7s cubic-bezier(.4,2,.6,1) both;
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes cardIn {
    from { opacity: 0; transform: translateY(40px) scale(0.95); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}
</style>
@endpush
