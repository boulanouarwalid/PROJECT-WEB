@extends('layouts.dash')

@section('title', 'Emploi du Temps - Professeur')

@section('main')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">
                        <i class="bi bi-calendar-week me-2"></i>Mon Emploi du Temps
                    </h1>
                    <p class="text-muted mb-0">Consultez votre planning de cours et séances</p>
                </div>
                <div>
                    <button class="btn btn-primary" onclick="window.print()">
                        <i class="bi bi-printer me-1"></i>Imprimer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Schedule Grid -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-calendar3 me-2 text-primary"></i>Planning Hebdomadaire
                        </h5>
                        <div class="d-flex gap-2">
                            <select class="form-select form-select-sm" style="width: auto;">
                                <option>Semaine actuelle</option>
                                <option>Semaine prochaine</option>
                                <option>Semaine précédente</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0 schedule-table">
                            <thead class="table-light">
                                <tr>
                                    <th class="time-column">Horaires</th>
                                    <th class="text-center">Lundi</th>
                                    <th class="text-center">Mardi</th>
                                    <th class="text-center">Mercredi</th>
                                    <th class="text-center">Jeudi</th>
                                    <th class="text-center">Vendredi</th>
                                    <th class="text-center">Samedi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="time-slot">08:00 - 09:30</td>
                                    <td class="schedule-cell"></td>
                                    <td class="schedule-cell">
                                        <div class="course-block bg-primary text-white">
                                            <div class="course-title">Algorithmique</div>
                                            <div class="course-details">
                                                <small>INFO1 - Amphi A</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="schedule-cell"></td>
                                    <td class="schedule-cell">
                                        <div class="course-block bg-success text-white">
                                            <div class="course-title">Base de Données</div>
                                            <div class="course-details">
                                                <small>INFO2 - Salle 12</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="schedule-cell"></td>
                                    <td class="schedule-cell"></td>
                                </tr>
                                <tr>
                                    <td class="time-slot">09:45 - 11:15</td>
                                    <td class="schedule-cell">
                                        <div class="course-block bg-info text-white">
                                            <div class="course-title">Programmation C</div>
                                            <div class="course-details">
                                                <small>INFO1 - Lab 1</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="schedule-cell"></td>
                                    <td class="schedule-cell">
                                        <div class="course-block bg-warning text-dark">
                                            <div class="course-title">Réseaux</div>
                                            <div class="course-details">
                                                <small>INFO3 - Salle 8</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="schedule-cell"></td>
                                    <td class="schedule-cell">
                                        <div class="course-block bg-danger text-white">
                                            <div class="course-title">Systèmes</div>
                                            <div class="course-details">
                                                <small>INFO2 - Lab 2</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="schedule-cell"></td>
                                </tr>
                                <tr>
                                    <td class="time-slot">11:30 - 13:00</td>
                                    <td class="schedule-cell"></td>
                                    <td class="schedule-cell">
                                        <div class="course-block bg-secondary text-white">
                                            <div class="course-title">Mathématiques</div>
                                            <div class="course-details">
                                                <small>INFO1 - Amphi B</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="schedule-cell"></td>
                                    <td class="schedule-cell">
                                        <div class="course-block bg-primary text-white">
                                            <div class="course-title">Algorithmique</div>
                                            <div class="course-details">
                                                <small>INFO1 - TD Salle 5</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="schedule-cell"></td>
                                    <td class="schedule-cell"></td>
                                </tr>
                                <tr class="break-row">
                                    <td class="time-slot bg-light">13:00 - 14:00</td>
                                    <td colspan="6" class="text-center bg-light text-muted">
                                        <i class="bi bi-cup-hot me-2"></i>Pause Déjeuner
                                    </td>
                                </tr>
                                <tr>
                                    <td class="time-slot">14:00 - 15:30</td>
                                    <td class="schedule-cell">
                                        <div class="course-block bg-success text-white">
                                            <div class="course-title">Base de Données</div>
                                            <div class="course-details">
                                                <small>INFO2 - TP Lab 3</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="schedule-cell"></td>
                                    <td class="schedule-cell">
                                        <div class="course-block bg-info text-white">
                                            <div class="course-title">Programmation C</div>
                                            <div class="course-details">
                                                <small>INFO1 - Amphi A</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="schedule-cell"></td>
                                    <td class="schedule-cell"></td>
                                    <td class="schedule-cell"></td>
                                </tr>
                                <tr>
                                    <td class="time-slot">15:45 - 17:15</td>
                                    <td class="schedule-cell"></td>
                                    <td class="schedule-cell">
                                        <div class="course-block bg-warning text-dark">
                                            <div class="course-title">Réseaux</div>
                                            <div class="course-details">
                                                <small>INFO3 - TP Lab 4</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="schedule-cell"></td>
                                    <td class="schedule-cell">
                                        <div class="course-block bg-danger text-white">
                                            <div class="course-title">Systèmes</div>
                                            <div class="course-details">
                                                <small>INFO2 - Amphi C</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="schedule-cell"></td>
                                    <td class="schedule-cell"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-primary mb-2">
                        <i class="bi bi-clock fs-1"></i>
                    </div>
                    <h5 class="card-title">24h</h5>
                    <p class="text-muted small mb-0">Heures cette semaine</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-success mb-2">
                        <i class="bi bi-book fs-1"></i>
                    </div>
                    <h5 class="card-title">8</h5>
                    <p class="text-muted small mb-0">Cours programmés</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-info mb-2">
                        <i class="bi bi-people fs-1"></i>
                    </div>
                    <h5 class="card-title">5</h5>
                    <p class="text-muted small mb-0">Classes différentes</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-warning mb-2">
                        <i class="bi bi-geo-alt fs-1"></i>
                    </div>
                    <h5 class="card-title">6</h5>
                    <p class="text-muted small mb-0">Salles utilisées</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.schedule-table {
    font-size: 0.9rem;
}

.time-column {
    width: 120px;
    background-color: #f8f9fa;
}

.time-slot {
    font-weight: 600;
    background-color: #f8f9fa;
    text-align: center;
    vertical-align: middle;
}

.schedule-cell {
    height: 80px;
    vertical-align: middle;
    position: relative;
    padding: 4px;
}

.course-block {
    border-radius: 8px;
    padding: 8px;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: transform 0.2s ease;
}

.course-block:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.course-title {
    font-weight: 600;
    font-size: 0.85rem;
    margin-bottom: 2px;
}

.course-details {
    font-size: 0.75rem;
    opacity: 0.9;
}

.break-row {
    background-color: #f8f9fa;
}

@media (max-width: 768px) {
    .schedule-table {
        font-size: 0.75rem;
    }
    
    .course-block {
        padding: 4px;
    }
    
    .course-title {
        font-size: 0.7rem;
    }
    
    .course-details {
        font-size: 0.65rem;
    }
}

@media print {
    .btn, .card-header .d-flex > div:last-child {
        display: none !important;
    }
    
    .card {
        border: 1px solid #dee2e6 !important;
        box-shadow: none !important;
    }
}
</style>
@endsection
