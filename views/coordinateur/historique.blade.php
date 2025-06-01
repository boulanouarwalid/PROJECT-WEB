@extends('layouts.app')

@section('title', "Consulter l’historique des années passées des UEs")

@section('content')
<div class="container py-5" style="max-width: 900px;">
    <h2 class="mb-4 fw-bold text-primary text-center">Consulter l’historique des années passées des UEs</h2>
    <div class="soft-card shadow p-4">
        <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
            <table class="table table-borderless align-middle mb-0">
                <thead class="sticky-top soft-table-header">
                    <tr>
                        <th>Année</th>
                        <th>UE</th>
                        <th>Semestre</th>
                       
                    </tr>
                </thead>
                <tbody>
                @forelse($logs as $log)
                    <tr class="soft-row">
                        <td class="text-muted small">{{ $log->annee_universitaire ?? ($log->created_at->format('Y').'-'.($log->created_at->format('Y')+1)) }}</td>
                        <td>{{ $log->ue_nom ?? ($log->subject_type . ' #' . $log->subject_id) }}</td>
                        <td>{{ $log->semestre ?? '-' }}</td>
                        
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center text-muted py-5">Aucune activité trouvée.</td></tr>
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
