@extends('layouts.app')

@section('title', 'Profil Coordinateur')
@section('content')
<div class="container-fluid px-4 py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            <!-- Profile Card -->
            <div class="card shadow-sm border-0 rounded-lg overflow-hidden">
                <!-- Card Header -->
                <div class="card-header bg-primary text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0"><i class="fas fa-user-circle me-2"></i>Informations du Profil</h3>
                        <a href="{{ route('profile.edit') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-edit me-1"></i> Modifier
                        </a>
                    </div>
                </div>
                
                <!-- Card Body -->
                <div class="card-body p-4">
                    <div class="row g-4">
                        <!-- Personal Info Column -->
                        <div class="col-md-6">
                            <div class="info-item mb-4">
                                <h6 class="text-muted small mb-1">Prénom</h6>
                                <p class="mb-0 fs-5">{{ Auth::user()->firstName }}</p>
                            </div>
                            
                            <div class="info-item mb-4">
                                <h6 class="text-muted small mb-1">Nom</h6>
                                <p class="mb-0 fs-5">{{ Auth::user()->lastName }}</p>
                            </div>
                            
                            <div class="info-item mb-4">
                                <h6 class="text-muted small mb-1">Date de naissance</h6>
                                <p class="mb-0 fs-5">{{ Auth::user()->data_nissance }}</p>
                            </div>
                            
                            <div class="info-item mb-4">
                                <h6 class="text-muted small mb-1">CIN</h6>
                                <p class="mb-0 fs-5">{{ Auth::user()->CIN }}</p>
                            </div>
                            
                            <div class="info-item mb-4">
                                <h6 class="text-muted small mb-1">Téléphone</h6>
                                <p class="mb-0 fs-5">{{ Auth::user()->Numeroteliphone }}</p>
                            </div>
                        </div>
                        
                        <!-- Professional Info Column -->
                        <div class="col-md-6">
                            <div class="info-item mb-4">
                                <h6 class="text-muted small mb-1">Email institutionnel</h6>
                                <p class="mb-0 fs-5">{{ Auth::user()->email }}</p>
                            </div>
                            
                            <div class="info-item mb-4">
                                <h6 class="text-muted small mb-1">Email personnel</h6>
                                <p class="mb-0 fs-5">{{ Auth::user()->emailPersonelle }}</p>
                            </div>
                            
                            <div class="info-item mb-4">
                                <h6 class="text-muted small mb-1">Rôle</h6>
                                <p class="mb-0 fs-5 text-capitalize">{{ Auth::user()->role }}</p>
                            </div>
                            
                            <div class="info-item mb-4">
                                <h6 class="text-muted small mb-1">Ville</h6>
                                <p class="mb-0 fs-5">{{ Auth::user()->ville }}</p>
                            </div>
                            
                            <div class="info-item mb-4">
                                <h6 class="text-muted small mb-1">Département</h6>
                                <p class="mb-0 fs-5">{{ Auth::user()->deparetement }}</p>
                            </div>
                            
                            <div class="info-item mb-4">
                                <h6 class="text-muted small mb-1">Spécialité</h6>
                                <p class="mb-0 fs-5">{{ Auth::user()->specialite }}</p>
                            </div>
                            
                            <div class="info-item mb-4">
                                <h6 class="text-muted small mb-1">Date d'inscription</h6>
                                <p class="mb-0 fs-5">{{ Auth::user()->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Card Footer -->
                <div class="card-footer bg-light py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">Dernière mise à jour: {{ Auth::user()->updated_at->diffForHumans() }}</small>
                        <button class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-download me-1"></i> Exporter PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .info-item {
        padding-bottom: 1rem;
        border-bottom: 1px solid #eee;
    }
    
    .info-item:last-child {
        border-bottom: none;
    }
    
    .card {
        border: none;
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.1);
    }
    
    .card-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .btn-light {
        background-color: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.3);
        color: white;
    }
    
    .btn-light:hover {
        background-color: rgba(255, 255, 255, 0.3);
        color: white;
    }
    
    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem;
        }
        
        .info-item {
            padding-bottom: 0.75rem;
            margin-bottom: 0.75rem;
        }
    }
</style>
@endsection