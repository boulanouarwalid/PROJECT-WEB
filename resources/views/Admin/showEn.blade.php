@extends('layouts.dash')
@section('main')

<section class="container-fluid px-0" style="background: linear-gradient(135deg, #f5f7fa 0%, #e4e9f2 100%); min-height: 100vh;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10">
                <!-- Profile Card -->
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden animate__animated animate__fadeIn">
                    <!-- Gradient Header -->
                    <div class="bg-gradient-primary py-4 px-5 text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h1 class="h3 mb-0 fw-light">PROFILE ENSEIGNANT</h1>
                        </div>
                    </div>

                    <!-- Profile Content -->
                    <div class="card-body p-4 p-md-5">
                        <!-- Profile Header -->
                        <div class="d-flex flex-column flex-md-row align-items-center mb-5">
                            <div class="position-relative me-md-4 mb-4 mb-md-0">
                                <div class="avatar-xxl position-relative">
                                    <img src="{{ asset('assets/images/profp.jpg') }}" alt="Photo du professeur"
                                         class="rounded-circle border border-4 border-white shadow-lg"
                                         style="width: 140px; height: 140px; object-fit: cover;">
                                    <span class="position-absolute bottom-0 end-0 translate-middle p-2 bg-success border border-3 border-white rounded-circle"
                                          style="width: 24px; height: 24px;"></span>
                                </div>
                            </div>
                            <div class="text-center text-md-start">
                                <h2 class="fw-bold mb-2 text-dark">{{ $Data_Ensignant->lastName }} {{ $Data_Ensignant->firstName }}</h2>
                                <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-2 mb-3">
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                        <i class="fas fa-building me-1"></i> {{ $Data_Ensignant->deparetement }}
                                    </span>
                                    <span class="badge bg-info bg-opacity-10 text-info px-3 py-2">
                                        <i class="fas fa-flask me-1"></i> {{ $Data_Ensignant->specialite }}
                                    </span>
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">
                                        <i class="fas fa-map-marker-alt me-1"></i> {{ $Data_Ensignant->ville }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Personal Information Section -->
                        <div class="mb-5">
                            <h5 class="fw-semibold mb-4 d-flex align-items-center">
                                <span class="icon-circle bg-primary bg-opacity-10 text-primary me-3">
                                    <i class="fas fa-user-circle"></i>
                                </span>
                                Informations personnelles
                            </h5>

                            <div class="row g-4">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="icon-circle-sm bg-primary bg-opacity-10 text-primary">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div>
                                            <span class="text-muted small">Email</span>
                                            <p class="mb-0 fw-medium">{{ $Data_Ensignant->Email }}</p>
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="icon-circle-sm bg-success bg-opacity-10 text-success">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <div>
                                            <span class="text-muted small">Téléphone</span>
                                            <p class="mb-0 fw-medium">{{ $Data_Ensignant->Numeroteliphone }}</p>
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="icon-circle-sm bg-warning bg-opacity-10 text-warning">
                                            <i class="fas fa-birthday-cake"></i>
                                        </div>
                                        <div>
                                            <span class="text-muted small">Date de naissance</span>
                                            <p class="mb-0 fw-medium">15/03/1980</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="icon-circle-sm bg-secondary bg-opacity-10 text-secondary">
                                            <i class="fas fa-id-card"></i>
                                        </div>
                                        <div>
                                            <span class="text-muted small">Identifiant National (CIN)</span>
                                            <p class="mb-0 fw-medium">{{ $Data_Ensignant->CIN }}</p>
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="icon-circle-sm bg-info bg-opacity-10 text-info">
                                            <i class="fas fa-user-shield"></i>
                                        </div>
                                        <div>
                                            <span class="text-muted small">Etat Compte</span>
                                            @if ($Data_Ensignant->Statu == true)
                                                <span class="badge bg-success px-3 py-1 rounded-pill">Active</span>
                                            @else
                                                <span class="badge bg-danger px-3 py-1 rounded-pill">Bloqué</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="icon-circle-sm bg-primary bg-opacity-10 text-primary">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                        <div>
                                            <span class="text-muted small">Date d'embauche</span>
                                            <p class="mb-0 fw-medium">{{ $Data_Ensignant->created_at }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .avatar-xxl {
        width: 140px;
        height: 140px;
    }

    .icon-circle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    .icon-circle-sm {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 50%;
    }

    .info-item {
        display: flex;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }

    .info-item .icon-circle-sm {
        flex-shrink: 0;
        margin-right: 12px;
    }

    .rounded-3 {
        border-radius: 1rem !important;
    }
</style>

@endsection
