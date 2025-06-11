@extends('layouts.app')

@section('title', 'Modifier Profil')
@section('content')
<div class="container-fluid px-4 py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            <!-- Profile Edit Card -->
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                <!-- Profile Header with Image -->
                <div class="profile-header position-relative">
                    <div class="profile-bg"></div>
                    <div class="profile-image-container">
                        <img src="{{ asset('assets/images/profil_img.jpg') }}" 
                             id="profile-image-preview"
                             class="profile-image rounded-circle border border-4 border-white shadow" 
                             alt="Profile Image">
                    </div>
                </div>
                
                <!-- Edit Form -->
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="card-body p-4 pt-5">
                        <div class="text-center mb-4">
                            <h2 class="mb-1">Modifier vos informations</h2>
                            <p class="text-muted">Vous ne pouvez modifier que le téléphone, l'email personnel et le mot de passe.</p>
                        </div>
                        
                        <div class="row g-4 justify-content-center">
                            <div class="col-md-8">
                                <div class="info-card p-3 rounded-3 mb-3">
                                    <h5 class="section-title mb-3 text-primary">
                                        <i class="bi bi-telephone me-2"></i>Coordonnées
                                    </h5>
                                    
                                    <div class="mb-3">
                                        <label for="Numeroteliphone" class="form-label">Téléphone</label>
                                        <input type="tel" class="form-control" id="Numeroteliphone" name="Numeroteliphone" 
                                               value="{{ old('Numeroteliphone', Auth::user()->Numeroteliphone) }}">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="emailPersonelle" class="form-label">Email personnel</label>
                                        <input type="email" class="form-control" id="emailPersonelle" name="emailPersonelle" 
                                               value="{{ old('emailPersonelle', Auth::user()->emailPersonelle) }}">
                                    </div>
                                </div>
                                
                                <div class="info-card p-3 rounded-3">
                                    <h5 class="section-title mb-3 text-primary">
                                        <i class="bi bi-lock me-2"></i>Changer le mot de passe
                                    </h5>
                                    
                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">Mot de passe actuel</label>
                                        <input type="password" class="form-control" id="current_password" name="current_password">
                                        <small class="text-muted">Requis seulement pour changer le mot de passe</small>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">Nouveau mot de passe</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="new_password_confirmation" class="form-label">Confirmer le nouveau mot de passe</label>
                                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card Footer -->
                    <div class="card-footer bg-light py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-lg me-1"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Enregistrer les modifications
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="container mt-3">
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@if (session('success'))
    <div class="container mt-3">
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    </div>
@endif

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
    .info-card {
        background-color: #f8f9fa;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    .section-title {
        font-size: 1rem;
        font-weight: 600;
        display: flex;
        align-items: center;
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