@extends('layouts.app')

@section('title', 'Profil Coordinateur')
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
                            <button class="btn btn-light btn-sm rounded-pill px-3">
                                <i class="bi bi-camera me-1"></i> Changer
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Card Body -->
                <div class="card-body p-4 pt-5">
                    <div class="text-center mb-4">
                        <h2 class="mb-1">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</h2>
                        <div class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1">
                            <i class="bi bi-person-badge me-1"></i>
                            {{ ucfirst(Auth::user()->role) }}
                        </div>
                    </div>
                    
                    <div class="row g-4">
                        <!-- Personal Info Column -->
                        <div class="col-md-6">
                            <div class="info-card p-3 rounded-3 mb-3">
                                <h5 class="section-title mb-3 text-primary">
                                    <i class="bi bi-person-vcard me-2"></i>Informations Personnelles
                                </h5>
                                
                                <div class="info-item d-flex mb-3">
                                    <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-2 p-2 me-3">
                                        <i class="bi bi-cake2"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted small mb-1">Date de naissance</h6>
                                        <p class="mb-0">{{ Auth::user()->data_nissance }}</p>
                                    </div>
                                </div>
                                
                                <div class="info-item d-flex mb-3">
                                    <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-2 p-2 me-3">
                                        <i class="bi bi-credit-card-2-front"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted small mb-1">CIN</h6>
                                        <p class="mb-0">{{ Auth::user()->CIN }}</p>
                                    </div>
                                </div>
                                
                                <div class="info-item d-flex mb-3">
                                    <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-2 p-2 me-3">
                                        <i class="bi bi-telephone"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted small mb-1">Téléphone</h6>
                                        <p class="mb-0">{{ Auth::user()->Numeroteliphone }}</p>
                                    </div>
                                </div>
                                
                                <div class="info-item d-flex">
                                    <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-2 p-2 me-3">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted small mb-1">Email personnel</h6>
                                        <p class="mb-0">{{ Auth::user()->emailPersonelle }}</p>
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
                                        <p class="mb-0">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                                
                                <div class="info-item d-flex mb-3">
                                    <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-2 p-2 me-3">
                                        <i class="bi bi-geo-alt"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted small mb-1">Ville</h6>
                                        <p class="mb-0">{{ Auth::user()->ville }}</p>
                                    </div>
                                </div>
                                
                                <div class="info-item d-flex mb-3">
                                    <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-2 p-2 me-3">
                                        <i class="bi bi-building"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted small mb-1">Département</h6>
                                        <p class="mb-0">{{ Auth::user()->deparetement }}</p>
                                    </div>
                                </div>
                                
                                <div class="info-item d-flex">
                                    <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-2 p-2 me-3">
                                        <i class="bi bi-mortarboard"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted small mb-1">Spécialité</h6>
                                        <p class="mb-0">{{ Auth::user()->specialite }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="info-card p-3 rounded-3">
                                <h5 class="section-title mb-3 text-primary">
                                    <i class="bi bi-calendar-event me-2"></i>Inscription
                                </h5>
                                <div class="info-item d-flex">
                                    <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-2 p-2 me-3">
                                        <i class="bi bi-clock-history"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted small mb-1">Date d'inscription</h6>
                                        <p class="mb-0">{{ Auth::user()->created_at->format('d/m/Y') }}</p>
                                        <small class="text-muted">({{ Auth::user()->created_at->diffForHumans() }})</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Card Footer -->
                <div class="card-footer bg-light py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">Dernière mise à jour: {{ Auth::user()->updated_at->diffForHumans() }}</small>
                        <div>
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary me-2">
                                <i class="bi bi-pencil-square me-1"></i> Modifier Profil
                            </a>
                            <button class="btn btn-outline-primary">
                                <i class="bi bi-download me-1"></i> Exporter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
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
    
    .card {
        border: none;
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08);
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
    }
</style>
@endsection