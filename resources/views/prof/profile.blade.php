@extends('layouts.app')

@section('title', 'Mon Profil - Professeur')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            <!-- Profile Card -->
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                <!-- Profile Header with Image -->
                <div class="profile-header position-relative">
                    <div class="profile-bg"></div>
                    <div class="profile-image-container">
                        <img src="{{ asset('assets/images/profil_img.jpg') }}"
                             class="profile-image rounded-circle border border-4 border-white shadow"
                             alt="Profile Image">
                        <div class="profile-edit-btn">
                            <button class="btn btn-light btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                <i class="bi bi-camera me-1"></i> Changer
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Profile Content -->
                <div class="card-body pt-5 mt-4">
                    <!-- Name and Role -->
                    <div class="text-center mb-4">
                        <h2 class="fw-bold mb-1">{{ auth()->user()->firstName }} {{ auth()->user()->lastName }}</h2>
                        <p class="text-muted mb-2 fs-5">{{ ucfirst(auth()->user()->role) }}</p>
                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                            <i class="bi bi-check-circle me-1"></i>Compte Actif
                        </span>
                    </div>

                    <!-- Stats Row -->
                    <div class="row text-center mb-5">
                        <div class="col-md-4">
                            <div class="stat-card p-3 rounded-3">
                                <div class="stat-icon bg-primary bg-opacity-10 text-primary rounded-circle mx-auto mb-2">
                                    <i class="bi bi-book"></i>
                                </div>
                                <h4 class="fw-bold mb-1 text-primary">{{ $stats['modules'] ?? 0 }}</h4>
                                <p class="text-muted small mb-0">Modules Enseignés</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card p-3 rounded-3">
                                <div class="stat-icon bg-success bg-opacity-10 text-success rounded-circle mx-auto mb-2">
                                    <i class="bi bi-clock"></i>
                                </div>
                                <h4 class="fw-bold mb-1 text-success">{{ $stats['heures'] ?? 0 }}h</h4>
                                <p class="text-muted small mb-0">Charge Horaire</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card p-3 rounded-3">
                                <div class="stat-icon bg-info bg-opacity-10 text-info rounded-circle mx-auto mb-2">
                                    <i class="bi bi-calendar"></i>
                                </div>
                                <h4 class="fw-bold mb-1 text-info">{{ $stats['annees'] ?? 0 }}</h4>
                                <p class="text-muted small mb-0">Années d'Expérience</p>
                            </div>
                        </div>
                    </div>

                    <!-- Information Cards -->
                    <div class="row">
                        <!-- Personal Info Column -->
                        <div class="col-md-6">
                            <div class="info-card p-3 rounded-3 mb-3">
                                <h5 class="section-title mb-3 text-primary">
                                    <i class="bi bi-person me-2"></i>Informations Personnelles
                                </h5>

                                <div class="info-item d-flex mb-3">
                                    <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-2 p-2 me-3">
                                        <i class="bi bi-person-badge"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted small mb-1">Nom complet</h6>
                                        <p class="mb-0">{{ auth()->user()->firstName }} {{ auth()->user()->lastName }}</p>
                                    </div>
                                </div>

                                <div class="info-item d-flex mb-3">
                                    <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-2 p-2 me-3">
                                        <i class="bi bi-telephone"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted small mb-1">Téléphone</h6>
                                        <p class="mb-0">{{ auth()->user()->phone ?? 'Non renseigné' }}</p>
                                    </div>
                                </div>

                                <div class="info-item d-flex mb-3">
                                    <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-2 p-2 me-3">
                                        <i class="bi bi-geo-alt"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted small mb-1">Ville</h6>
                                        <p class="mb-0">{{ auth()->user()->ville ?? 'Non renseignée' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Professional Info Column -->
                        <div class="col-md-6">
                            <div class="info-card p-3 rounded-3 mb-3">
                                <h5 class="section-title mb-3 text-primary">
                                    <i class="bi bi-briefcase me-2"></i>Informations Professionnelles
                                </h5>

                                <div class="info-item d-flex mb-3">
                                    <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-2 p-2 me-3">
                                        <i class="bi bi-envelope-at"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted small mb-1">Email institutionnel</h6>
                                        <p class="mb-0">{{ auth()->user()->email }}</p>
                                    </div>
                                </div>

                                <div class="info-item d-flex mb-3">
                                    <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-2 p-2 me-3">
                                        <i class="bi bi-building"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted small mb-1">Département</h6>
                                        <p class="mb-0">{{ auth()->user()->deparetement ?? 'Non assigné' }}</p>
                                    </div>
                                </div>

                                <div class="info-item d-flex mb-3">
                                    <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-2 p-2 me-3">
                                        <i class="bi bi-calendar-check"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted small mb-1">Date d'inscription</h6>
                                        <p class="mb-0">{{ auth()->user()->created_at->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Footer with Actions -->
                <div class="card-footer bg-light border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                <i class="bi bi-pencil me-1"></i>Modifier le profil
                            </button>
                            <button class="btn btn-outline-secondary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                <i class="bi bi-shield-lock me-1"></i>Changer mot de passe
                            </button>
                        </div>
                        <div class="text-muted small">
                            <i class="bi bi-clock me-1"></i>
                            Dernière mise à jour: {{ auth()->user()->updated_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="editProfileModalLabel">
                    <i class="bi bi-pencil-square me-2 text-primary"></i>Modifier le profil
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('prof.profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body px-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label fw-bold">Prénom</label>
                            <input type="text" class="form-control rounded-3" id="firstName" name="firstName" value="{{ auth()->user()->firstName }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label fw-bold">Nom</label>
                            <input type="text" class="form-control rounded-3" id="lastName" name="lastName" value="{{ auth()->user()->lastName }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control rounded-3" id="email" name="email" value="{{ auth()->user()->email }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label fw-bold">Téléphone</label>
                            <input type="tel" class="form-control rounded-3" id="phone" name="phone" value="{{ auth()->user()->phone }}">
                        </div>
                        <div class="col-md-6">
                            <label for="ville" class="form-label fw-bold">Ville</label>
                            <input type="text" class="form-control rounded-3" id="ville" name="ville" value="{{ auth()->user()->ville }}">
                        </div>
                        <div class="col-md-6">
                            <label for="deparetement" class="form-label fw-bold">Département</label>
                            <input type="text" class="form-control rounded-3" id="deparetement" name="deparetement" value="{{ auth()->user()->deparetement }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-check-lg me-1"></i>Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="changePasswordModalLabel">
                    <i class="bi bi-shield-lock me-2 text-warning"></i>Changer le mot de passe
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('prof.password.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body px-4">
                    <div class="mb-3">
                        <label for="current_password" class="form-label fw-bold">Mot de passe actuel</label>
                        <input type="password" class="form-control rounded-3" id="current_password" name="current_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label fw-bold">Nouveau mot de passe</label>
                        <input type="password" class="form-control rounded-3" id="new_password" name="new_password" required>
                        <div class="form-text">Le mot de passe doit contenir au moins 8 caractères.</div>
                    </div>
                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label fw-bold">Confirmer le nouveau mot de passe</label>
                        <input type="password" class="form-control rounded-3" id="new_password_confirmation" name="new_password_confirmation" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-warning rounded-pill px-4">
                        <i class="bi bi-shield-check me-1"></i>Changer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .profile-header {
        height: 150px;
        background: linear-gradient(135deg, #6200ee, #3700b3);
        position: relative;
    }

    .profile-image-container {
        position: absolute;
        bottom: -50px;
        left: 50%;
        transform: translateX(-50%);
        text-align: center;
    }

    .profile-image {
        width: 120px;
        height: 120px;
        object-fit: cover;
    }

    .profile-edit-btn {
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
    }

    .info-card {
        background-color: #f8f9fa;
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .section-title {
        font-size: 1rem;
        font-weight: 600;
        display: flex;
        align-items: center;
    }

    .icon-box {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stat-card {
        background-color: #f8f9fa;
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .card {
        border: none;
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08);
    }

    .form-control, .form-select {
        border-radius: 8px;
        padding: 10px 15px;
        border: 1px solid #e0e0e0;
    }

    .form-control:focus, .form-select:focus {
        border-color: #6200ee;
        box-shadow: 0 0 0 0.25rem rgba(98, 0, 238, 0.15);
    }

    @media (max-width: 768px) {
        .profile-image {
            width: 100px;
            height: 100px;
        }

        .card-footer .btn {
            margin-top: 10px;
            width: 100%;
        }

        .card-footer div {
            flex-direction: column;
            gap: 10px;
        }

        .stat-card {
            margin-bottom: 1rem;
        }
    }
</style>
@endsection
