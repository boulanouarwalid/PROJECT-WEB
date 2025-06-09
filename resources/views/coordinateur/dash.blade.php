@extends('layouts.app')

@section('title', 'Tableau de Bord')

@section('content')
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
            --success-gradient: linear-gradient(135deg, #4cc9f0 0%, #4895ef 100%);
            --warning-gradient: linear-gradient(135deg, #f8961e 0%, #f3722c 100%);
            --danger-gradient: linear-gradient(135deg, #f72585 0%, #b5179e 100%);
            --card-shadow: 0 4px 20px rgba(0,0,0,0.08);
            --card-shadow-hover: 0 8px 30px rgba(0,0,0,0.12);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #f8fafc;
        }

        .dashboard-header {
            background: white;
            border-bottom: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 1.5rem 0;
            margin-bottom: 2rem;
        }

        .card-dashboard {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .card-dashboard:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-shadow-hover);
        }

        .stat-card {
            position: relative;
            color: white;
            padding: 1.5rem;
            border-radius: 12px;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 70%);
            transform: rotate(30deg);
            transition: all 0.5s ease;
            opacity: 0;
        }

        .stat-card:hover::before {
            opacity: 1;
            animation: shine 1.5s infinite;
        }

        @keyframes shine {
            0% { transform: rotate(30deg) translate(-10%, -10%); }
            100% { transform: rotate(30deg) translate(10%, 10%); }
        }

        .card-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            opacity: 0.8;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0.5rem 0;
            position: relative;
            display: inline-block;
        }

        .stat-number::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 40px;
            height: 3px;
            background: rgba(255,255,255,0.5);
            border-radius: 3px;
        }

        .quick-actions .btn {
            border-radius: 8px;
            padding: 0.75rem 1.25rem;
            font-weight: 500;
            margin: 0 0.5rem 0.5rem 0;
            transition: all 0.2s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }

        .quick-actions .btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(255,255,255,0.2), rgba(255,255,255,0));
            opacity: 0;
            transition: opacity 0.3s;
        }

        .quick-actions .btn:hover::after {
            opacity: 1;
        }

        .quick-actions .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        }

        .table-responsive {
            border-radius: 12px;
            overflow: hidden;
        }

        .table thead th {
            background: var(--primary-gradient);
            color: white;
            border: none;
            font-weight: 500;
            padding: 1rem;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
            transform: translateX(5px);
        }

        .badge {
            font-size: 0.85rem;
            padding: 0.35em 0.75em;
            border-radius: 8px;
            font-weight: 500;
        }

        .list-group-item-action {
            border-radius: 8px;
            margin-bottom: 0.75rem;
            border: none;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: all 0.2s ease;
            padding: 1rem;
        }

        .list-group-item-action:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .calendar th, .calendar td {
            padding: 0.75rem;
            border-radius: 8px;
        }

        .calendar td:hover {
            background-color: #f0f4ff;
            cursor: pointer;
        }

        .highlight-date {
            background-color: #4361ee;
            color: white;
            font-weight: bold;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: 0 2px 5px rgba(67, 97, 238, 0.3);
        }

        /* Pulse animation for important elements */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        /* Loading skeleton for async content */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
            border-radius: 4px;
        }

        @keyframes shimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* Modern scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }
    </style>

    <!-- Header -->
    <div class="dashboard-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 mb-0" style="font-weight: 700; color: #1a1a1a;">Tableau de Bord</h1>
                    <p class="mb-0 text-muted">Bienvenue, {{ Auth::user()->firstName }}</p>
                </div>
                <div class="btn-toolbar">
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-secondary rounded-pill me-2">
                            <i class="bi bi-printer me-2"></i>Imprimer
                        </button>
                        <button type="button" class="btn btn-primary rounded-pill">
                            <i class="bi bi-download me-2"></i>Exporter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Stats Cards -->
        <div class="row mb-4 g-4">
            <div class="col-md-3">
                <div class="card-dashboard">
                    <div class="stat-card" style="background: var(--primary-gradient);">
                        <i class="bi bi-book card-icon"></i>
                        <h5 class="card-title">Unités d'Enseignement</h5>
                        <p class="stat-number">{{ $ues->count() }}</p>
                        <p class="text-white-50 mb-0">Total dans la filière</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-dashboard">
                    <div class="stat-card" style="background:  var(--primary-gradient);">
                        <i class="bi bi-check-circle card-icon"></i>
                        <h5 class="card-title">UE Attribuées</h5>
                        <p class="stat-number">{{ $uesaffected->count() }}</p>
                        <p class="text-white-50 mb-0">Cette année</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-dashboard">
                    <div class="stat-card" style="background: var(--primary-gradient);">
                        <i class="bi bi-people card-icon"></i>
                        <h5 class="card-title">Vacataires</h5>
                        <p class="stat-number">{{ $vacataire->count() }}</p>
                        <p class="text-white-50 mb-0">En activité</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-dashboard pulse">
                    <div class="stat-card" style="background:  var(--primary-gradient);">
                        <i class="bi bi-exclamation-triangle card-icon"></i>
                        <h5 class="card-title">En Attente</h5>
                        <p class="stat-number">{{ $ues->where('responsable_id', null)->count() }}</p>
                        <p class="text-white-50 mb-0">Validation requise</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card card-dashboard mb-4">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0" style="font-weight: 600;">Actions Rapides</h5>
            </div>
            <div class="card-body quick-actions pt-0">
                <button class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i> Nouvelle Affectation
                </button>
                <button class="btn btn-success">
                    <i class="bi bi-person-plus me-2"></i> Ajouter Vacataire
                </button>
                <button class="btn btn-info">
                    <i class="bi bi-file-earmark-excel me-2"></i> Importer Données
                </button>
                <button class="btn btn-warning">
                    <i class="bi bi-calendar-plus me-2"></i> Planifier EDT
                </button>
                <button class="btn btn-danger">
                    <i class="bi bi-envelope me-2"></i> Envoyer Rappel
                </button>
            </div>
        </div>

        <div class="row g-4">
            <!-- UE List -->
            <div class="col-lg-8">
                <div class="card card-dashboard">
                    <div class="card-header bg-white border-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0" style="font-weight: 600;">Liste des Unités d'Enseignement</h5>
                            <div class="input-group" style="width: 250px;">
                                <span class="input-group-text bg-transparent"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control border-start-0" placeholder="Rechercher...">
                                <button class="btn btn-outline-primary" type="button">Filtrer</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>Code UE</th>
                                        <th>Intitulé</th>
                                        <th>Groupes</th>
                                        <th>Statut</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ues as $ue)
                                    <tr>
                                        <td><strong>{{ $ue->code }}</strong></td>
                                        <td>{{ $ue->nom }}</td>
                                        <td>
                                            <span class="badge bg-primary bg-opacity-10 text-primary me-1">{{ $ue->groupes_td ?? 'N/A' }} TD</span>
                                            <span class="badge bg-info bg-opacity-10 text-info">{{ $ue->groupes_tp ?? 'N/A' }} TP</span>
                                        </td>
                                        <td>
                                            @if($ue->responsable_id)
                                                <span class="badge bg-success bg-opacity-10 text-success">Attribuée</span>
                                            @else
                                                <span class="badge bg-danger bg-opacity-10 text-danger">Non attribuée</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-primary rounded me-2" title="Modifier">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary rounded" title="Voir détails">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 py-3">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Précédent</a>
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

            <!-- Right Sidebar -->
            <div class="col-lg-4">
                <!-- Recent Assignments -->
                <div class="card card-dashboard">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0" style="font-weight: 600;">Affectations Récentes</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3" style="background-color: #4361ee; color: white; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                                            DM
                                        </div>
                                        <h6 class="mb-0">Dr. Martin</h6>
                                    </div>
                                    <span class="badge bg-success bg-opacity-10 text-success">Validée</span>
                                </div>
                                <p class="mb-1 mt-2 text-muted">UE: Algorithmique Avancée</p>
                                <small class="text-muted"><i class="bi bi-calendar me-1"></i>15/03/2024</small>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3" style="background-color: #f72585; color: white; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                                            PD
                                        </div>
                                        <h6 class="mb-0">Prof. Dubois</h6>
                                    </div>
                                    <span class="badge bg-warning bg-opacity-10 text-warning">En attente</span>
                                </div>
                                <p class="mb-1 mt-2 text-muted">UE: Réseaux Informatiques</p>
                                <small class="text-muted"><i class="bi bi-calendar me-1"></i>12/03/2024</small>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3" style="background-color: #4cc9f0; color: white; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                                            JL
                                        </div>
                                        <h6 class="mb-0">Dr. Lefèvre</h6>
                                    </div>
                                    <span class="badge bg-success bg-opacity-10 text-success">Validée</span>
                                </div>
                                <p class="mb-1 mt-2 text-muted">UE: Base de Données</p>
                                <small class="text-muted"><i class="bi bi-calendar me-1"></i>10/03/2024</small>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3" style="background-color: #f8961e; color: white; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                                            PM
                                        </div>
                                        <h6 class="mb-0">Prof. Moreau</h6>
                                    </div>
                                    <span class="badge bg-danger bg-opacity-10 text-danger">Rejetée</span>
                                </div>
                                <p class="mb-1 mt-2 text-muted">UE: Programmation Web</p>
                                <small class="text-muted"><i class="bi bi-calendar me-1"></i>08/03/2024</small>
                            </a>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 text-center py-3">
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-pill">Voir toutes les affectations <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>

                <!-- Calendar Widget -->
                <div class="card card-dashboard mt-4">
                    <div class="card-header bg-white border-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0" style="font-weight: 600;">Calendrier</h5>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-chevron-left"></i></button>
                                <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-chevron-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="text-center mb-3">
                            <h4 style="font-weight: 600;">Mars 2024</h4>
                        </div>
                        <div class="calendar">
                            <table class="table table-borderless text-center mb-0">
                                <thead>
                                    <tr>
                                        <th style="color: #6c757d; font-weight: 500;">L</th>
                                        <th style="color: #6c757d; font-weight: 500;">M</th>
                                        <th style="color: #6c757d; font-weight: 500;">M</th>
                                        <th style="color: #6c757d; font-weight: 500;">J</th>
                                        <th style="color: #6c757d; font-weight: 500;">V</th>
                                        <th style="color: #6c757d; font-weight: 500;">S</th>
                                        <th style="color: #6c757d; font-weight: 500;">D</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-muted py-2">26</td>
                                        <td class="text-muted py-2">27</td>
                                        <td class="text-muted py-2">28</td>
                                        <td class="text-muted py-2">29</td>
                                        <td class="py-2">1</td>
                                        <td class="py-2">2</td>
                                        <td class="py-2">3</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2">4</td>
                                        <td class="py-2">5</td>
                                        <td class="py-2">6</td>
                                        <td class="py-2">7</td>
                                        <td class="py-2">8</td>
                                        <td class="py-2">9</td>
                                        <td class="py-2">10</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2">11</td>
                                        <td class="py-2">12</td>
                                        <td class="py-2">13</td>
                                        <td class="py-2">14</td>
                                        <td class="py-2">
                                            <div class="highlight-date">15</div>
                                        </td>
                                        <td class="py-2">16</td>
                                        <td class="py-2">17</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2">18</td>
                                        <td class="py-2">19</td>
                                        <td class="py-2">20</td>
                                        <td class="py-2">21</td>
                                        <td class="py-2">22</td>
                                        <td class="py-2">23</td>
                                        <td class="py-2">24</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2">25</td>
                                        <td class="py-2">26</td>
                                        <td class="py-2">27</td>
                                        <td class="py-2">28</td>
                                        <td class="py-2">29</td>
                                        <td class="py-2">30</td>
                                        <td class="py-2">31</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-primary me-2" style="width: 12px; height: 12px; border-radius: 50%;"></span>
                                <small class="text-muted">Date limite affectation</small>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-success me-2" style="width: 12px; height: 12px; border-radius: 50%;"></span>
                                <small class="text-muted">Réunions importantes</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simple animations
        document.addEventListener('DOMContentLoaded', function() {
            // Animate stats cards on scroll
            const statsCards = document.querySelectorAll('.stat-card');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = 1;
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, { threshold: 0.1 });
            
            statsCards.forEach(card => {
                card.style.opacity = 0;
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
            
            // Add ripple effect to buttons
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const x = e.clientX - e.target.getBoundingClientRect().left;
                    const y = e.clientY - e.target.getBoundingClientRect().top;
                    
                    const ripple = document.createElement('span');
                    ripple.classList.add('ripple');
                    ripple.style.left = `${x}px`;
                    ripple.style.top = `${y}px`;
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 1000);
                });
            });
        });
    </script>
@endsection