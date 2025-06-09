@extends('layouts.app')
@section('title', 'Gestion des Notes')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Gestion des Notes</h1>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Modules à Noter
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Code UE</th>
                        <th>Nom UE</th>
                        <th>Semestre</th>
                        <th>Session Normale</th>
                        <th>Session Rattrapage</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ues as $ue)
                    <tr>
                        <td>{{ $ue->code }}</td>
                        <td>{{ $ue->nom }}</td>
                        <td>S{{ $ue->semestre }}</td>
                        
                        @foreach(['normal', 'retake'] as $session)
                        <td>
                            @if($note = $ue->notes->firstWhere('session_type', $session))
                            <a href="{{ route('notes.download', $note) }}" 
                            class="btn btn-sm btn-outline-primary"
                            title="{{ basename($note->file_path) }}">
                                <i class="fas fa-file-excel"></i> Télécharger
                            </a>
                            @else
                            <button class="btn btn-sm btn-outline-secondary" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#uploadModal"
                                    data-ue-id="{{ $ue->id }}"
                                    data-session-type="{{ $session }}">
                                <i class="fas fa-upload"></i> Uploader
                            </button>
                            @endif
                        </td>
                        @endforeach
                        
                        <td>
                            <a href="{{ route('notes.template') }}" 
                            class="btn btn-sm btn-success">
                                <i class="fas fa-download"></i> Template
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Upload Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
               <form id="uploadForm" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Uploader les notes</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="ue_id" id="modalUeId">
                        <h6 id="modalUeName"></h6>
                        
                        <div class="mb-3">
                            <label class="form-label">Session</label>
                            <select name="session_type" class="form-select" required>
                                <option value="normal">Session Normale</option>
                                <option value="retake">Session de Rattrapage</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Fichier Excel</label>
                            <input type="file" name="file" class="form-control" accept=".xlsx,.xls" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Uploader</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var uploadModal = document.getElementById('uploadModal');
        if (uploadModal) {
            uploadModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var ueId = button.getAttribute('data-ue-id');
                var sessionType = button.getAttribute('data-session-type');
                var form = document.getElementById('uploadForm');
                if (form && ueId) {
                    form.action = '/prof/notes/' + ueId + '/upload';
                    document.getElementById('modalUeId').value = ueId;
                    form.querySelector('select[name="session_type"]').value = sessionType;
                }
            });
        }
    });
</script>
@endsection