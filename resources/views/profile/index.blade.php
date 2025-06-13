@extends('layouts.app-unified')

@section('title', 'Mon Profil - AcademiQ')

@section('search-placeholder', 'Rechercher dans le profil...')

@section('sidebar')
    @if(auth()->user()->role === 'coordinateur')
        @include('partials.sidebar-coordinateur')
    @elseif(auth()->user()->role === 'profiseur')
        @include('partials.sidebar-professeur')
    @elseif(auth()->user()->role === 'vacataire')
        @include('partials.sidebar-vacataire')
    @endif
@endsection

@section('main')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">
                        <i class="bi bi-person-circle me-2"></i>Mon Profil
                    </h1>
                    <p class="text-muted mb-0">Gérez vos informations personnelles et préférences</p>
                </div>
                <div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="bi bi-pencil-square me-1"></i>Modifier le profil
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Content -->
    <div class="row">
        <!-- Profile Card -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <div class="position-relative d-inline-block mb-3">
                        <img src="{{ asset('assets/images/profil_img.jpg') }}" 
                             alt="Photo de profil" 
                             class="rounded-circle border border-3 border-primary" 
                             width="120" height="120">
                        <button class="btn btn-sm btn-primary rounded-circle position-absolute bottom-0 end-0" 
                                style="width: 35px; height: 35px;" 
                                data-bs-toggle="modal" 
                                data-bs-target="#changePhotoModal">
                            <i class="bi bi-camera"></i>
                        </button>
                    </div>
                    <h4 class="card-title mb-1">{{ auth()->user()->firstName }} {{ auth()->user()->lastName }}</h4>
                    <p class="text-muted mb-2">{{ ucfirst(auth()->user()->role) }}</p>
                    <span class="badge bg-success-subtle text-success px-3 py-2">
                        <i class="bi bi-check-circle me-1"></i>Compte Actif
                    </span>
                    
                    <hr class="my-4">
                    
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="border-end">
                                <h5 class="mb-0 text-primary">{{ $stats['modules'] ?? 0 }}</h5>
                                <small class="text-muted">Modules</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="border-end">
                                <h5 class="mb-0 text-success">{{ $stats['heures'] ?? 0 }}h</h5>
                                <small class="text-muted">Heures</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <h5 class="mb-0 text-info">{{ $stats['annees'] ?? 0 }}</h5>
                            <small class="text-muted">Années</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Personal Information -->
        <div class="col-lg-8 col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-info-circle me-2 text-primary"></i>Informations Personnelles
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted">Prénom</label>
                            <p class="form-control-plaintext border rounded px-3 py-2 bg-light">
                                {{ auth()->user()->firstName }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted">Nom</label>
                            <p class="form-control-plaintext border rounded px-3 py-2 bg-light">
                                {{ auth()->user()->lastName }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted">Email</label>
                            <p class="form-control-plaintext border rounded px-3 py-2 bg-light">
                                <i class="bi bi-envelope me-2"></i>{{ auth()->user()->email }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted">Téléphone</label>
                            <p class="form-control-plaintext border rounded px-3 py-2 bg-light">
                                <i class="bi bi-telephone me-2"></i>{{ auth()->user()->phone ?? 'Non renseigné' }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted">Département</label>
                            <p class="form-control-plaintext border rounded px-3 py-2 bg-light">
                                <i class="bi bi-building me-2"></i>{{ auth()->user()->deparetement ?? 'Non assigné' }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted">Date d'inscription</label>
                            <p class="form-control-plaintext border rounded px-3 py-2 bg-light">
                                <i class="bi bi-calendar me-2"></i>{{ auth()->user()->created_at->format('d/m/Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Information Row -->
    <div class="row">
        <!-- Security Settings -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-shield-check me-2 text-success"></i>Sécurité
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="mb-1">Mot de passe</h6>
                            <small class="text-muted">Dernière modification: {{ auth()->user()->updated_at->diffForHumans() }}</small>
                        </div>
                        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                            Modifier
                        </button>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">Authentification à deux facteurs</h6>
                            <small class="text-muted">Sécurisez votre compte</small>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="twoFactorAuth">
                            <label class="form-check-label" for="twoFactorAuth"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activity Summary -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-activity me-2 text-info"></i>Activité Récente
                    </h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item mb-3">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                        <i class="bi bi-person-check text-white small"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Connexion réussie</h6>
                                    <small class="text-muted">Il y a 2 heures</small>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-item mb-3">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                        <i class="bi bi-check-lg text-white small"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Profil mis à jour</h6>
                                    <small class="text-muted">Hier</small>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="bg-info rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                        <i class="bi bi-book text-white small"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Nouveau module assigné</h6>
                                    <small class="text-muted">Il y a 3 jours</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
