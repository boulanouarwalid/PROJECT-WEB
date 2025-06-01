@extends('layouts.app')

@section('title', 'Historique des UEs')

@section('content')
<div class="container py-5" style="max-width: 1000px;">
    <h2 class="mb-4 fw-bold text-primary text-center">Historique des Unités d'Enseignement</h2>
    <div class="soft-card shadow p-4">
        <div class="mb-3 text-muted small">
            Filière : <span class="fw-semibold text-dark">{{ $filiere->nom ?? '—' }}</span>
            @if($departement)
                | Département : <span class="fw-semibold text-dark">{{ $departement->nom ?? '' }}</span>
            @endif
        </div>
        <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
            <table class="table table-borderless align-middle mb-0">
                <thead class="sticky-top soft-table-header">
                    <tr>
                        <th>Nom</th>
                        <th>Code</th>
                        <th>Semestre</th>
                        <th>Année</th>
                        <th>Responsable</th>
                        <th>Dernière modification</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($ues as $ue)
                    <tr class="soft-row">
                        <td class="fw-semibold">{{ $ue->nom }}</td>
                        <td class="text-primary fw-bold">{{ $ue->code }}</td>
                        <td><span class="badge bg-gradient-sem">{{ $ue->semestre }}</span></td>
                        <td><span class="badge bg-gradient-year">{{ $ue->annee_universitaire }}</span></td>
                        <td>
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
                        </td>
                        <td class="text-muted small">{{ $ue->updated_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('coordinateur.ues.show', $ue->id) }}" class="btn btn-outline-primary btn-sm soft-btn" title="Voir détails"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('coordinateur.ues.edit', $ue->id) }}" class="btn btn-outline-secondary btn-sm soft-btn" title="Modifier"><i class="bi bi-pencil-square"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-5">Aucune activité trouvée.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.soft-card {
    background: #fafdff;
    border-radius: 1.5rem;
    box-shadow: 0 4px 32px 0 rgba(60,72,100,.10), 0 1.5px 4px 0 rgba(60,72,100,.04);
    border: none;
}
.soft-table-header {
    background: rgba(255,255,255,0.85) !important;
    backdrop-filter: blur(2px);
    border-bottom: 2px solid #e9ecef;
}
.bg-gradient-sem {
    background: linear-gradient(90deg,#a1c4fd,#c2e9fb)!important;
    color: #185a9d!important;
}
.bg-gradient-year {
    background: linear-gradient(90deg,#fcb69f,#ffecd2)!important;
    color: #a15c00!important;
}
.bg-gradient-avatar {
    background: linear-gradient(135deg,#43cea2,#185a9d)!important;
    color: #fff!important;
}
.soft-row {
    background: #fafdff;
    border-radius: 1.25rem;
    box-shadow: 0 1px 8px 0 rgba(60,72,100,.04);
    margin-bottom: 0.5rem;
}
.table tbody tr.soft-row td {
    border-top: none;
}
.table thead th {
    vertical-align: middle;
    border-bottom: 2px solid #e9ecef;
    background: transparent;
}
.table tbody tr {
    transition: background 0.2s;
}
.table tbody tr:hover {
    background: #f1f3f6 !important;
}
</style>
@endpush
