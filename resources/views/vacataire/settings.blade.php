@extends('layouts.app')

@section('title', 'Paramètres - Vacataire')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            <!-- Settings Header -->
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="settings-icon bg-success bg-opacity-10 text-success rounded-3 p-3 me-3">
                            <i class="bi bi-gear fs-3"></i>
                        </div>
                        <div>
                            <h1 class="h3 mb-1 fw-bold">Paramètres</h1>
                            <p class="text-muted mb-0">Configurez vos préférences et paramètres de compte</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Content -->
            <div class="row">
                <!-- General Settings -->
                <div class="col-lg-8 mb-4">
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-body p-4">
                            <h5 class="section-title mb-4 text-success">
                                <i class="bi bi-sliders me-2"></i>Paramètres Généraux
                            </h5>
                            
                            <form action="{{ route('vacataire.settings.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <!-- Language Settings -->
                                <div class="settings-group mb-4">
                                    <h6 class="fw-bold mb-3 text-secondary">
                                        <i class="bi bi-globe me-2"></i>Préférences de langue
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="language" class="form-label fw-bold">Langue</label>
                                            <select class="form-select rounded-3" id="language" name="language">
                                                <option value="fr" selected>Français</option>
                                                <option value="en">English</option>
                                                <option value="ar">العربية</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="timezone" class="form-label fw-bold">Fuseau horaire</label>
                                            <select class="form-select rounded-3" id="timezone" name="timezone">
                                                <option value="Africa/Casablanca" selected>GMT+1 (Casablanca)</option>
                                                <option value="Europe/Paris">GMT+1 (Paris)</option>
                                                <option value="UTC">UTC</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Theme Settings -->
                                <div class="settings-group mb-4">
                                    <h6 class="fw-bold mb-3 text-secondary">
                                        <i class="bi bi-palette me-2"></i>Apparence
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Thème</label>
                                            <div class="theme-options">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="theme" id="theme_light" value="light" checked>
                                                    <label class="form-check-label" for="theme_light">
                                                        <i class="bi bi-sun me-2"></i>Clair
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="theme" id="theme_dark" value="dark">
                                                    <label class="form-check-label" for="theme_dark">
                                                        <i class="bi bi-moon me-2"></i>Sombre
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="theme" id="theme_auto" value="auto">
                                                    <label class="form-check-label" for="theme_auto">
                                                        <i class="bi bi-circle-half me-2"></i>Auto
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="items_per_page" class="form-label fw-bold">Éléments par page</label>
                                            <select class="form-select rounded-3" id="items_per_page" name="items_per_page">
                                                <option value="10" selected>10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Dashboard Settings -->
                                <div class="settings-group mb-4">
                                    <h6 class="fw-bold mb-3 text-secondary">
                                        <i class="bi bi-grid me-2"></i>Widgets du tableau de bord
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-switch mb-2">
                                                <input class="form-check-input" type="checkbox" id="widget_modules" name="widgets[]" value="modules" checked>
                                                <label class="form-check-label" for="widget_modules">
                                                    Mes modules
                                                </label>
                                            </div>
                                            <div class="form-check form-switch mb-2">
                                                <input class="form-check-input" type="checkbox" id="widget_charge" name="widgets[]" value="charge" checked>
                                                <label class="form-check-label" for="widget_charge">
                                                    Charge horaire
                                                </label>
                                            </div>
                                            <div class="form-check form-switch mb-2">
                                                <input class="form-check-input" type="checkbox" id="widget_emploi" name="widgets[]" value="emploi" checked>
                                                <label class="form-check-label" for="widget_emploi">
                                                    Emploi du temps
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-switch mb-2">
                                                <input class="form-check-input" type="checkbox" id="widget_contrats" name="widgets[]" value="contrats" checked>
                                                <label class="form-check-label" for="widget_contrats">
                                                    Contrats
                                                </label>
                                            </div>
                                            <div class="form-check form-switch mb-2">
                                                <input class="form-check-input" type="checkbox" id="widget_paiements" name="widgets[]" value="paiements" checked>
                                                <label class="form-check-label" for="widget_paiements">
                                                    Paiements
                                                </label>
                                            </div>
                                            <div class="form-check form-switch mb-2">
                                                <input class="form-check-input" type="checkbox" id="widget_disponibilites" name="widgets[]" value="disponibilites">
                                                <label class="form-check-label" for="widget_disponibilites">
                                                    Disponibilités
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success rounded-pill px-4">
                                        <i class="bi bi-check-lg me-1"></i>Enregistrer les paramètres
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Notification Settings -->
                <div class="col-lg-4 mb-4">
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-body p-4">
                            <h5 class="section-title mb-4 text-warning">
                                <i class="bi bi-bell me-2"></i>Notifications
                            </h5>
                            
                            <form action="{{ route('vacataire.notifications.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="notification-group mb-4">
                                    <h6 class="fw-bold mb-3 text-secondary">
                                        <i class="bi bi-envelope me-2"></i>Email
                                    </h6>
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="email_new_assignment" name="email_notifications[]" value="new_assignment" checked>
                                        <label class="form-check-label" for="email_new_assignment">
                                            Nouvelle assignation
                                        </label>
                                    </div>
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="email_schedule_change" name="email_notifications[]" value="schedule_change" checked>
                                        <label class="form-check-label" for="email_schedule_change">
                                            Changement d'emploi du temps
                                        </label>
                                    </div>
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="email_payment" name="email_notifications[]" value="payment" checked>
                                        <label class="form-check-label" for="email_payment">
                                            Notifications de paiement
                                        </label>
                                    </div>
                                </div>

                                <div class="notification-group mb-4">
                                    <h6 class="fw-bold mb-3 text-secondary">
                                        <i class="bi bi-browser-chrome me-2"></i>Navigateur
                                    </h6>
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="browser_reminders" name="browser_notifications[]" value="reminders" checked>
                                        <label class="form-check-label" for="browser_reminders">
                                            Rappels de cours
                                        </label>
                                    </div>
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="browser_messages" name="browser_notifications[]" value="messages">
                                        <label class="form-check-label" for="browser_messages">
                                            Messages système
                                        </label>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-warning rounded-pill px-4">
                                        <i class="bi bi-check-lg me-1"></i>Sauvegarder
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Privacy Settings -->
                    <div class="card shadow-sm border-0 rounded-4 mt-4">
                        <div class="card-body p-4">
                            <h5 class="section-title mb-4 text-info">
                                <i class="bi bi-shield-lock me-2"></i>Confidentialité
                            </h5>
                            
                            <div class="privacy-group">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="profile_visibility" checked>
                                    <label class="form-check-label" for="profile_visibility">
                                        Profil visible aux coordinateurs
                                    </label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="contact_visibility" checked>
                                    <label class="form-check-label" for="contact_visibility">
                                        Contact visible
                                    </label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="availability_visibility">
                                    <label class="form-check-label" for="availability_visibility">
                                        Disponibilités publiques
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Actions -->
                    <div class="card shadow-sm border-0 rounded-4 mt-4">
                        <div class="card-body p-4">
                            <h5 class="section-title mb-4 text-danger">
                                <i class="bi bi-person-gear me-2"></i>Actions du compte
                            </h5>
                            
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-primary rounded-pill">
                                    <i class="bi bi-download me-1"></i>Exporter les données
                                </button>
                                <button class="btn btn-outline-warning rounded-pill">
                                    <i class="bi bi-pause-circle me-1"></i>Désactiver le compte
                                </button>
                                <button class="btn btn-outline-danger rounded-pill">
                                    <i class="bi bi-trash me-1"></i>Supprimer le compte
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .settings-icon {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        display: flex;
        align-items: center;
    }
    
    .settings-group {
        background-color: #f8f9fa;
        border: 1px solid rgba(0, 0, 0, 0.05);
        border-radius: 12px;
        padding: 1.5rem;
        transition: transform 0.3s ease;
    }
    
    .settings-group:hover {
        transform: translateY(-2px);
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    }
    
    .notification-group {
        background-color: #f8f9fa;
        border: 1px solid rgba(0, 0, 0, 0.05);
        border-radius: 12px;
        padding: 1rem;
    }
    
    .privacy-group {
        background-color: #f8f9fa;
        border: 1px solid rgba(0, 0, 0, 0.05);
        border-radius: 12px;
        padding: 1rem;
    }
    
    .theme-options {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .form-control, .form-select {
        border-radius: 8px;
        padding: 10px 15px;
        border: 1px solid #e0e0e0;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.15);
    }
    
    .form-check-input:checked {
        background-color: #28a745;
        border-color: #28a745;
    }
    
    .form-check-input:focus {
        box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.15);
    }
    
    .card {
        border: none;
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
    }
    
    .btn {
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-1px);
    }
    
    @media (max-width: 768px) {
        .settings-group {
            margin-bottom: 1rem;
        }
        
        .theme-options {
            flex-direction: row;
            flex-wrap: wrap;
        }
        
        .form-check-inline {
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }
    }
</style>
@endsection
