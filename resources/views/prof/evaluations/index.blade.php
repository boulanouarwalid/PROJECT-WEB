@extends('layouts.dash')

@section('title', 'Évaluations - Professeur')

@section('main')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">
                        <i class="bi bi-star me-2"></i>Mes Évaluations
                    </h1>
                    <p class="text-muted mb-0">Consultez les évaluations de vos cours par les étudiants</p>
                </div>
                <div>
                    <button class="btn btn-outline-primary" onclick="window.print()">
                        <i class="bi bi-printer me-1"></i>Imprimer le rapport
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-warning mb-2">
                        <i class="bi bi-star-fill fs-1"></i>
                    </div>
                    <h4 class="card-title text-warning">4.2</h4>
                    <p class="text-muted small mb-0">Note moyenne générale</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-primary mb-2">
                        <i class="bi bi-people fs-1"></i>
                    </div>
                    <h4 class="card-title text-primary">156</h4>
                    <p class="text-muted small mb-0">Étudiants ayant évalué</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-success mb-2">
                        <i class="bi bi-book fs-1"></i>
                    </div>
                    <h4 class="card-title text-success">8</h4>
                    <p class="text-muted small mb-0">UEs évaluées</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-info mb-2">
                        <i class="bi bi-calendar-check fs-1"></i>
                    </div>
                    <h4 class="card-title text-info">85%</h4>
                    <p class="text-muted small mb-0">Taux de participation</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Evaluations by UE -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-graph-up me-2 text-primary"></i>Évaluations par UE
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>UE</th>
                                    <th>Niveau</th>
                                    <th class="text-center">Note Moyenne</th>
                                    <th class="text-center">Participants</th>
                                    <th class="text-center">Pédagogie</th>
                                    <th class="text-center">Clarté</th>
                                    <th class="text-center">Disponibilité</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 text-primary rounded p-2 me-3">
                                                <i class="bi bi-code-slash"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">Algorithmique</h6>
                                                <small class="text-muted">ALG101</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info-subtle text-info">INFO1</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 fw-bold text-warning">4.5</span>
                                            <div class="rating-stars">
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-half text-warning"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success-subtle text-success">32/35</span>
                                    </td>
                                    <td class="text-center">4.3</td>
                                    <td class="text-center">4.6</td>
                                    <td class="text-center">4.7</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailsModal">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-success bg-opacity-10 text-success rounded p-2 me-3">
                                                <i class="bi bi-database"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">Base de Données</h6>
                                                <small class="text-muted">BDD201</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-warning-subtle text-warning">INFO2</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 fw-bold text-warning">4.1</span>
                                            <div class="rating-stars">
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star text-muted"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success-subtle text-success">28/30</span>
                                    </td>
                                    <td class="text-center">4.0</td>
                                    <td class="text-center">4.2</td>
                                    <td class="text-center">4.1</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailsModal">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-info bg-opacity-10 text-info rounded p-2 me-3">
                                                <i class="bi bi-cpu"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">Programmation C</h6>
                                                <small class="text-muted">PROG101</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info-subtle text-info">INFO1</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 fw-bold text-warning">3.8</span>
                                            <div class="rating-stars">
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-half text-warning"></i>
                                                <i class="bi bi-star text-muted"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-warning-subtle text-warning">25/35</span>
                                    </td>
                                    <td class="text-center">3.9</td>
                                    <td class="text-center">3.7</td>
                                    <td class="text-center">3.8</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailsModal">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-warning bg-opacity-10 text-warning rounded p-2 me-3">
                                                <i class="bi bi-router"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">Réseaux</h6>
                                                <small class="text-muted">NET301</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-danger-subtle text-danger">INFO3</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 fw-bold text-warning">4.4</span>
                                            <div class="rating-stars">
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-half text-warning"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success-subtle text-success">22/25</span>
                                    </td>
                                    <td class="text-center">4.5</td>
                                    <td class="text-center">4.3</td>
                                    <td class="text-center">4.4</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailsModal">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-chat-dots me-2 text-primary"></i>Commentaires Récents
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="comment-card p-3 mb-3 bg-light rounded">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="mb-0">Algorithmique - INFO1</h6>
                                    <small class="text-muted">Il y a 2 jours</small>
                                </div>
                                <p class="mb-0 text-muted">"Excellent professeur, explications très claires et exemples pratiques très utiles."</p>
                                <div class="mt-2">
                                    <span class="badge bg-success-subtle text-success">Positif</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="comment-card p-3 mb-3 bg-light rounded">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="mb-0">Base de Données - INFO2</h6>
                                    <small class="text-muted">Il y a 3 jours</small>
                                </div>
                                <p class="mb-0 text-muted">"Les TPs sont bien structurés, mais il faudrait plus d'exercices pratiques."</p>
                                <div class="mt-2">
                                    <span class="badge bg-warning-subtle text-warning">Suggestion</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="comment-card p-3 mb-3 bg-light rounded">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="mb-0">Réseaux - INFO3</h6>
                                    <small class="text-muted">Il y a 5 jours</small>
                                </div>
                                <p class="mb-0 text-muted">"Cours très intéressant, professeur disponible et à l'écoute des étudiants."</p>
                                <div class="mt-2">
                                    <span class="badge bg-success-subtle text-success">Positif</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="comment-card p-3 mb-3 bg-light rounded">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="mb-0">Programmation C - INFO1</h6>
                                    <small class="text-muted">Il y a 1 semaine</small>
                                </div>
                                <p class="mb-0 text-muted">"Le rythme est un peu rapide, mais le contenu est de qualité."</p>
                                <div class="mt-2">
                                    <span class="badge bg-info-subtle text-info">Neutre</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-outline-primary">
                            <i class="bi bi-arrow-down me-1"></i>Voir plus de commentaires
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Details Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel">
                    <i class="bi bi-graph-up me-2"></i>Détails de l'évaluation
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Algorithmique - INFO1</h6>
                <p class="text-muted">Détails complets de l'évaluation pour cette UE...</p>
                <!-- Add detailed evaluation content here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary">Télécharger le rapport</button>
            </div>
        </div>
    </div>
</div>

<style>
.rating-stars {
    font-size: 0.9rem;
}

.comment-card {
    transition: transform 0.2s ease;
}

.comment-card:hover {
    transform: translateY(-2px);
}

.table th {
    font-weight: 600;
    font-size: 0.9rem;
}

.badge {
    font-size: 0.75rem;
}

@media print {
    .btn, .modal {
        display: none !important;
    }
}
</style>
@endsection
