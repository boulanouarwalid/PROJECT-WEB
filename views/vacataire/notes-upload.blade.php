@extends('layouts.app')

@section('title', 'Uploader Notes')

@section('content')
<div class="container-fluid px-4">
    <div class="row justify-content-center mt-4">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-cloud-arrow-up me-2"></i>
                        Uploader Notes - {{ $ue->code }} (Session {{ ucfirst($session_type) }})
                    </h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        Veuillez utiliser le template fourni pour uploader les notes.
                        <a href="{{ route('notes.template') }}" class="alert-link">
                            Télécharger le template
                        </a>
                    </div>

                    <form method="POST" action="{{ route('vacataire.notes.upload.submit', $ue) }}" enctype="multipart/form-data" class="dropzone" id="notesUploadForm">
                        @csrf
                        <input type="hidden" name="session_type" value="{{ $session_type }}">
                        
                        <div class="mb-3">
                            <label for="file" class="form-label">Fichier Excel</label>
                            <input class="form-control" type="file" id="file" name="file" accept=".xlsx,.xls,.csv" required>
                            <div class="form-text">Formats acceptés: .xlsx, .xls, .csv (Max 2MB)</div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('vacataire.notes') }}" class="btn btn-outline-secondary me-md-2">
                                <i class="bi bi-arrow-left me-1"></i> Retour
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-upload me-1"></i> Uploader
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .dropzone {
        border: 2px dashed #dee2e6;
        border-radius: 5px;
        padding: 20px;
        background: #f8f9fa;
        transition: all 0.3s ease;
    }
    .dropzone:hover {
        border-color: #0d6efd;
        background: #f0f7ff;
    }
</style>
@endsection