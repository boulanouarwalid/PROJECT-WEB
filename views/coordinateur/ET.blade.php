@extends('layouts.app')

@section('title', 'Gestion des Emplois du Temps')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Gestion des Emplois du Temps</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addScheduleModal">
            <i class="bi bi-plus-circle"></i> Ajouter un EDT
        </button>
        <div class="btn-group">
            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                <i class="bi bi-download"></i> Exporter
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Format Excel</a></li>
                <li><a class="dropdown-item" href="#">Format PDF</a></li>
            </ul>
        </div>
    </div>
</div>

<!-- Filtres -->
<div class="card mb-4">
    <div class="card-body">
        <form class="row g-3">
            <div class="col-md-3">
                <label for="filiere" class="form-label">Filière</label>
                <select class="form-select" id="filiere">
                    <option value="" selected>Toutes les filières</option>
                    <option value="informatique">Informatique</option>
                    <option value="mathematiques">Mathématiques</option>
                    <option value="physique">Physique</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="niveau" class="form-label">Niveau</label>
                <select class="form-select" id="niveau">
                    <option value="" selected>Tous les niveaux</option>
                    <option value="L1">Licence 1</option>
                    <option value="L2">Licence 2</option>
                    <option value="L3">Licence 3</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="semaine" class="form-label">Semaine</label>
                <input type="week" class="form-control" id="semaine">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-funnel"></i> Filtrer
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Emploi du temps -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Emploi du temps - Informatique L2 (Semaine 15)</h5>
        <div>
            <button class="btn btn-sm btn-outline-secondary me-2">
                <i class="bi bi-printer"></i> Imprimer
            </button>
            <button class="btn btn-sm btn-outline-primary">
                <i class="bi bi-pencil"></i> Modifier
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>Heure/Jour</th>
                        <th>Lundi</th>
                        <th>Mardi</th>
                        <th>Mercredi</th>
                        <th>Jeudi</th>
                        <th>Vendredi</th>
                        <th>Samedi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fw-bold">08:00-10:00</td>
                        <td rowspan="2" class="bg-info bg-opacity-10">
                            <strong>Algorithmique</strong><br>
                            Salle A12<br>
                            Pr. Dupont
                        </td>
                        <td></td>
                        <td class="bg-warning bg-opacity-10">
                            <strong>Base de données</strong><br>
                            Salle B05<br>
                            Vac. Martin
                        </td>
                        <td></td>
                        <td rowspan="2" class="bg-success bg-opacity-10">
                            <strong>Réseaux</strong><br>
                            Labo Info 3<br>
                            Dr. Lambert
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="fw-bold">10:00-12:00</td>
                        <td class="bg-danger bg-opacity-10">
                            <strong>Math Discrètes</strong><br>
                            Salle C07<br>
                            Pr. Leroy
                        </td>
                        <td></td>
                        <td class="bg-primary bg-opacity-10">
                            <strong>Web Dev</strong><br>
                            Labo Info 1<br>
                            Vac. Simon
                        </td>
                        <td></td>
                    </tr>
                    <!-- Ajoutez plus de lignes pour d'autres créneaux horaires -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Liste des emplois du temps -->
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">Tous les emplois du temps</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Filière</th>
                        <th>Niveau</th>
                        <th>Semaine</th>
                        <th>Date création</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>EDT-2023-015</td>
                        <td>Informatique</td>
                        <td>L2</td>
                        <td>15 (10/04-16/04)</td>
                        <td>05/04/2023</td>
                        <td><span class="badge bg-success">Actif</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary me-1">
                                <i class="bi bi-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-secondary me-1">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <!-- Ajoutez plus de lignes -->
                </tbody>
            </table>
        </div>
        
        <nav aria-label="Page navigation" class="mt-3">
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

<!-- Modal d'ajout -->
<div class="modal fade" id="addScheduleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Créer un nouvel emploi du temps</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="modalFiliere" class="form-label">Filière</label>
                            <select class="form-select" id="modalFiliere" required>
                                <option value="" selected disabled>Choisir une filière</option>
                                <option value="informatique">Informatique</option>
                                <option value="mathematiques">Mathématiques</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="modalNiveau" class="form-label">Niveau</label>
                            <select class="form-select" id="modalNiveau" required>
                                <option value="" selected disabled>Choisir un niveau</option>
                                <option value="L1">Licence 1</option>
                                <option value="L2">Licence 2</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="modalSemaine" class="form-label">Semaine</label>
                            <input type="week" class="form-control" id="modalSemaine" required>
                        </div>
                        <div class="col-md-6">
                            <label for="modalSource" class="form-label">Basé sur</label>
                            <select class="form-select" id="modalSource">
                                <option value="" selected>Créer un nouveau</option>
                                <option value="previous">Copier depuis semaine précédente</option>
                                <option value="template">Utiliser un modèle</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="modalPublier">
                                <label class="form-check-label" for="modalPublier">
                                    Publier immédiatement
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary">Créer l'EDT</button>
            </div>
        </div>
    </div>
</div>
@endsection