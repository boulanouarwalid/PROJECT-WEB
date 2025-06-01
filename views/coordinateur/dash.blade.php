@extends('layouts.app')

@section('title', 'Tableau de Bord')

@section('content')
    <style>
        .card-dashboard {
            border-radius: 1rem;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07);
            transition: box-shadow 0.2s;
        }
        .card-dashboard:hover {
            box-shadow: 0 6px 24px rgba(0,0,0,0.13);
        }
        .stat-number {
            font-size: 2.2rem;
            font-weight: bold;
            margin: 0.5rem 0;
        }
        .card-icon {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }
        .quick-actions .btn {
            margin: 0.3rem 0.5rem 0.3rem 0;
            font-size: 1.1rem;
            border-radius: 2rem;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
            transition: background 0.2s, color 0.2s;
        }
        .quick-actions .btn:hover {
            filter: brightness(1.1);
        }
        .table thead th {
            background: linear-gradient(90deg, #007bff 0%, #00c6ff 100%);
            color: #fff;
            border: none;
        }
        .badge {
            font-size: 1rem;
            padding: 0.5em 1em;
            border-radius: 1rem;
        }
        .list-group-item-action {
            border-radius: 0.7rem;
            margin-bottom: 0.5rem;
            border: none;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
        }
        .calendar th, .calendar td {
            border-radius: 0.5rem;
        }
    </style>
    <!-- Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 text-dark">Tableau de Bord</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-printer"></i> Imprimer
                </button>
                <button type="button" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-download"></i> Exporter
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3 ">
            <div class="card card-dashboard text-white" style="background: linear-gradient(135deg, #007bff 60%, #00c6ff 100%);">
                <div class="card-body text-center">
                    <i class="bi bi-book card-icon"></i>
                    <h5 class="card-title">Unités d'Enseignement</h5>
                    <p class="stat-number">{{ $ues->count() }}</p>
                    <p class="text-white-50">Total dans la filière</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-dashboard text-white" style="background: linear-gradient(135deg, #28a745 60%, #a8e063 100%);">
                <div class="card-body text-center">
                    <i class="bi bi-check-circle card-icon"></i>
                    <h5 class="card-title">UE Attribuées</h5>
                    <p class="stat-number">{{ $uesaffected->count() }}</p>
                    <p class="text-white-50">Cette année</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-dashboard text-white" style="background: linear-gradient(135deg, #17a2b8 60%, #43e97b 100%);">
                <div class="card-body text-center">
                    <i class="bi bi-people card-icon"></i>
                    <h5 class="card-title">Vacataires</h5>
                    <p class="stat-number">{{ $vacataire->count() }}</p>
                    <p class="text-white-50">En activité</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-dashboard text-white" style="background: linear-gradient(135deg, #ff512f 60%, #f09819 100%);">
                <div class="card-body text-center">
                    <i class="bi bi-exclamation-triangle card-icon"></i>
                    <h5 class="card-title">En Attente</h5>
                    <p class="stat-number">{{ $ues->where('responsable_id', null)->count() }}</p>
                    <p class="text-white-50">Validation requise</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card card-dashboard mb-4">
        <div class="card-header bg-primary text-light">
            <h5 class="mb-0">Actions Rapides</h5>
        </div>
        <div class="card-body quick-actions">
            <button class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Nouvelle Affectation
            </button>
            <button class="btn btn-success">
                <i class="bi bi-person-plus"></i> Ajouter Vacataire
            </button>
            <button class="btn btn-info text-white">
                <i class="bi bi-file-earmark-excel"></i> Importer Données
            </button>
            <button class="btn btn-warning text-light">
                <i class="bi bi-calendar-plus"></i> Planifier EDT
            </button>
            <button class="btn btn-danger">
                <i class="bi bi-envelope"></i> Envoyer Rappel
            </button>
        </div>
    </div>

    <div class="row">
        <!-- UE List -->
        <div class="col-md-8">
            <div class="card card-dashboard">
                <div class="card-header bg-dark text-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Liste des Unités d'Enseignement</h5>
                        <div class="input-group" style="width: 200px;">
                            <input type="text" class="form-control" placeholder="Rechercher...">
                            <button class="btn btn-outline-light" type="button">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Code UE</th>
                                    <th>Intitulé</th>
                                    <th>Groupes</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ues as $ue)
                                <tr>
                                    <td>{{ $ue->code }}</td>
                                    <td>{{ $ue->nom }}</td>
                                    <td>{{ $ue->groupes_td ?? 'N/A' }} TD / {{ $ue->groupes_tp ?? 'N/A' }} TP</td>
                                    <td>
                                        @if($ue->responsable_id)
                                            <span class="badge bg-success">Attribuée</span>
                                        @else
                                            <span class="badge bg-danger">Non attribuée</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" title="Voir détails">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Assignments (static for now) -->
        <div class="col-md-4">
            <div class="card card-dashboard">
                <div class="card-header bg-dark text-light">
                    <h5 class="mb-0">Affectations Récentes</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">Dr. Martin</h6>
                                <small class="text-success">Validée</small>
                            </div>
                            <p class="mb-1">UE: Algorithmique Avancée</p>
                            <small>Attribuée le 15/03/2024</small>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">Prof. Dubois</h6>
                                <small class="text-warning">En attente</small>
                            </div>
                            <p class="mb-1">UE: Réseaux Informatiques</p>
                            <small>Attribuée le 12/03/2024</small>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">Dr. Lefèvre</h6>
                                <small class="text-success">Validée</small>
                            </div>
                            <p class="mb-1">UE: Base de Données</p>
                            <small>Attribuée le 10/03/2024</small>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">Prof. Moreau</h6>
                                <small class="text-danger">Rejetée</small>
                            </div>
                            <p class="mb-1">UE: Programmation Web</p>
                            <small>Attribuée le 08/03/2024</small>
                        </a>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="#" class="btn btn-sm btn-outline-primary">Voir toutes les affectations</a>
                </div>
            </div>

            <!-- Calendar Widget (static) -->
            <div class="card card-dashboard mt-4">
                <div class="card-header bg-dark text-light">
                    <h5 class="mb-0">Calendrier</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <h4>Mars 2024</h4>
                    </div>
                    <div class="calendar">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>L</th>
                                    <th>M</th>
                                    <th>M</th>
                                    <th>J</th>
                                    <th>V</th>
                                    <th>S</th>
                                    <th>D</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-muted">26</td>
                                    <td class="text-muted">27</td>
                                    <td class="text-muted">28</td>
                                    <td class="text-muted">29</td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>5</td>
                                    <td>6</td>
                                    <td>7</td>
                                    <td>8</td>
                                    <td>9</td>
                                    <td>10</td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>12</td>
                                    <td>13</td>
                                    <td>14</td>
                                    <td class="bg-primary text-light">15</td>
                                    <td>16</td>
                                    <td>17</td>
                                </tr>
                                <tr>
                                    <td>18</td>
                                    <td>19</td>
                                    <td>20</td>
                                    <td>21</td>
                                    <td>22</td>
                                    <td>23</td>
                                    <td>24</td>
                                </tr>
                                <tr>
                                    <td>25</td>
                                    <td>26</td>
                                    <td>27</td>
                                    <td>28</td>
                                    <td>29</td>
                                    <td>30</td>
                                    <td>31</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge bg-primary me-2" style="width: 15px; height: 15px;"></span>
                            <small>Date limite affectation</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
@endsection
