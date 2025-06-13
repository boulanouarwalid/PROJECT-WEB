@extends('layouts.dash')

@section('title', 'Documents - Professeur')

@section('main')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">
                        <i class="bi bi-file-earmark-text me-2"></i>Mes Documents
                    </h1>
                    <p class="text-muted mb-0">Gérez vos documents pédagogiques et ressources</p>
                </div>
                <div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadDocumentModal">
                        <i class="bi bi-cloud-upload me-1"></i>Ajouter un document
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body py-3">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-3">
                            <select class="form-select">
                                <option>Tous les types</option>
                                <option>Cours</option>
                                <option>TD</option>
                                <option>TP</option>
                                <option>Examens</option>
                                <option>Corrections</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select">
                                <option>Toutes les UEs</option>
                                <option>Algorithmique</option>
                                <option>Base de Données</option>
                                <option>Programmation C</option>
                                <option>Réseaux</option>
                                <option>Systèmes</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Rechercher un document...">
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="btn-group w-100" role="group">
                                <button type="button" class="btn btn-outline-secondary active" title="Vue grille">
                                    <i class="bi bi-grid-3x3-gap"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary" title="Vue liste">
                                    <i class="bi bi-list-ul"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Documents Grid -->
    <div class="row">
        <!-- Document Card 1 -->
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card document-card h-100 shadow-sm border-0">
                <div class="card-body p-3">
                    <div class="document-icon text-center mb-3">
                        <i class="bi bi-file-earmark-pdf text-danger" style="font-size: 3rem;"></i>
                    </div>
                    <h6 class="card-title mb-2">Cours Algorithmique - Chapitre 1</h6>
                    <p class="text-muted small mb-2">
                        <i class="bi bi-book me-1"></i>Algorithmique - INFO1
                    </p>
                    <p class="text-muted small mb-3">
                        <i class="bi bi-calendar me-1"></i>Ajouté le 15/01/2024
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-primary-subtle text-primary">Cours</span>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>Voir</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-download me-2"></i>Télécharger</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Modifier</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Supprimer</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Document Card 2 -->
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card document-card h-100 shadow-sm border-0">
                <div class="card-body p-3">
                    <div class="document-icon text-center mb-3">
                        <i class="bi bi-file-earmark-word text-primary" style="font-size: 3rem;"></i>
                    </div>
                    <h6 class="card-title mb-2">TD Base de Données - Exercices</h6>
                    <p class="text-muted small mb-2">
                        <i class="bi bi-book me-1"></i>Base de Données - INFO2
                    </p>
                    <p class="text-muted small mb-3">
                        <i class="bi bi-calendar me-1"></i>Ajouté le 12/01/2024
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-success-subtle text-success">TD</span>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>Voir</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-download me-2"></i>Télécharger</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Modifier</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Supprimer</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Document Card 3 -->
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card document-card h-100 shadow-sm border-0">
                <div class="card-body p-3">
                    <div class="document-icon text-center mb-3">
                        <i class="bi bi-file-earmark-code text-warning" style="font-size: 3rem;"></i>
                    </div>
                    <h6 class="card-title mb-2">TP Programmation C - Pointeurs</h6>
                    <p class="text-muted small mb-2">
                        <i class="bi bi-book me-1"></i>Programmation C - INFO1
                    </p>
                    <p class="text-muted small mb-3">
                        <i class="bi bi-calendar me-1"></i>Ajouté le 10/01/2024
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-info-subtle text-info">TP</span>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>Voir</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-download me-2"></i>Télécharger</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Modifier</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Supprimer</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Document Card 4 -->
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card document-card h-100 shadow-sm border-0">
                <div class="card-body p-3">
                    <div class="document-icon text-center mb-3">
                        <i class="bi bi-file-earmark-text text-secondary" style="font-size: 3rem;"></i>
                    </div>
                    <h6 class="card-title mb-2">Examen Réseaux - Session 1</h6>
                    <p class="text-muted small mb-2">
                        <i class="bi bi-book me-1"></i>Réseaux - INFO3
                    </p>
                    <p class="text-muted small mb-3">
                        <i class="bi bi-calendar me-1"></i>Ajouté le 08/01/2024
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-danger-subtle text-danger">Examen</span>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>Voir</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-download me-2"></i>Télécharger</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Modifier</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Supprimer</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add more document cards as needed -->
    </div>

    <!-- Pagination -->
    <div class="row">
        <div class="col-12">
            <nav aria-label="Documents pagination">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Précédent</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Suivant</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Upload Document Modal -->
<div class="modal fade" id="uploadDocumentModal" tabindex="-1" aria-labelledby="uploadDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadDocumentModalLabel">
                    <i class="bi bi-cloud-upload me-2"></i>Ajouter un document
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('prof.documents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="document_title" class="form-label">Titre du document</label>
                            <input type="text" class="form-control" id="document_title" name="title" required>
                        </div>
                        <div class="col-md-6">
                            <label for="document_type" class="form-label">Type</label>
                            <select class="form-select" id="document_type" name="type" required>
                                <option value="">Choisir le type</option>
                                <option value="cours">Cours</option>
                                <option value="td">TD</option>
                                <option value="tp">TP</option>
                                <option value="examen">Examen</option>
                                <option value="correction">Correction</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="document_ue" class="form-label">UE</label>
                            <select class="form-select" id="document_ue" name="ue_id" required>
                                <option value="">Choisir l'UE</option>
                                <option value="1">Algorithmique</option>
                                <option value="2">Base de Données</option>
                                <option value="3">Programmation C</option>
                                <option value="4">Réseaux</option>
                                <option value="5">Systèmes</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="document_visibility" class="form-label">Visibilité</label>
                            <select class="form-select" id="document_visibility" name="visibility">
                                <option value="private">Privé</option>
                                <option value="students">Visible aux étudiants</option>
                                <option value="colleagues">Visible aux collègues</option>
                                <option value="public">Public</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="document_file" class="form-label">Fichier</label>
                            <input type="file" class="form-control" id="document_file" name="file" required>
                            <div class="form-text">Formats acceptés: PDF, DOC, DOCX, PPT, PPTX (Max: 10MB)</div>
                        </div>
                        <div class="col-12">
                            <label for="document_description" class="form-label">Description (optionnel)</label>
                            <textarea class="form-control" id="document_description" name="description" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-cloud-upload me-1"></i>Ajouter le document
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.document-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.document-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}

.document-icon {
    transition: transform 0.2s ease;
}

.document-card:hover .document-icon {
    transform: scale(1.1);
}

.badge {
    font-size: 0.75rem;
    padding: 0.375rem 0.75rem;
}

@media (max-width: 768px) {
    .col-sm-6 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}
</style>
@endsection
