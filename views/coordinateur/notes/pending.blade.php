@extends('layouts.app')
@section('title', 'Notes en attente de validation')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Notes en attente de validation</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Notes à valider
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>UE</th>
                        <th>Session</th>
                        <th>Année universitaire</th>
                        <th>Fichier</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingNotes as $note)
                    <tr>
                        <td>{{ $note->ue->nom ?? '-' }}</td>
                        <td>{{ $note->session_type }}</td>
                        <td>{{ $note->academic_year }}</td>
                        <td>
                            <a href="{{ route('notes.download', $note) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-file-excel"></i> Télécharger
                            </a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('coordinateur.notes.publish', $note) }}" class="publish-form">
                                @csrf
                                <button type="button" class="btn btn-success btn-sm publish-btn" data-note-id="{{ $note->id }}">Publier</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Aucune note en attente</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmPublishModal" tabindex="-1" aria-labelledby="confirmPublishModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmPublishModalLabel">Confirmer la publication</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir publier cette note ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-success" id="confirmPublishBtn">Confirmer</button>
      </div>
    </div>
  </div>
</div>

<script>
    let formToSubmit = null;
    document.addEventListener('DOMContentLoaded', function () {
        // Attach click event to all publish buttons
        document.querySelectorAll('.publish-btn').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                formToSubmit = btn.closest('form');
                var modal = new bootstrap.Modal(document.getElementById('confirmPublishModal'));
                modal.show();
            });
        });
        // Confirm button in modal
        document.getElementById('confirmPublishBtn').addEventListener('click', function() {
            if (formToSubmit) {
                formToSubmit.submit();
            }
        });
    });
</script>
@endsection
