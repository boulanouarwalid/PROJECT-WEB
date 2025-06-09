@extends('layouts.dash')
@section('main')

<section class="container-fluid px-lg-5 px-md-3 px-2 py-4">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <!-- Profile Card -->
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                <!-- Card Header with Gradient Background -->
                <div class="card-header bg-gradient-primary py-3 px-4 d-flex justify-content-between align-items-center border-0">
                    <h3 class="fw-bold text-white mb-0">
                        <i class="fas fa-chalkboard-teacher me-2"></i> Profil Professeur
                    </h3>
                    <a href="{{route('edit', $dataCompt->id)}}" class="btn btn-light btn-sm rounded-pill px-3">
                        <i class="fas fa-edit me-1"></i> Modifier
                    </a>
                </div>

                <!-- Card Body -->
                <div class="card-body p-4">
                    <!-- Profile Header -->
                    <div class="d-flex flex-column flex-md-row align-items-center mb-4 pb-3 border-bottom">
                        <div class="position-relative me-md-4 mb-3 mb-md-0">
                            <img src="{{ asset('assets/images/profp.jpg') }}"
                                 class="rounded-circle border border-3 border-primary shadow"
                                 width="120" height="120" style="object-fit: cover;">
                            <span class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-2 border-white"
                                  style="width: 16px; height: 16px;"></span>
                        </div>
                        <div class="text-center text-md-start">
                            <h2 class="fw-bold mb-1">{{ $dataCompt->lastName }} {{$dataCompt->firstName}}</h2>
                            <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-2">
                                <span class="badge bg-primary bg-opacity-10 text-primary px-3">
                                    <i class="fas fa-user-tie me-1"></i> {{$dataCompt->role}}
                                </span>
                                <span class="badge bg-info bg-opacity-10 text-info px-3">
                                    <i class="fas fa-graduation-cap me-1"></i> {{$dataCompt->specialite}}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Main Information Section -->
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <div class="info-card">
                                <h5 class="fw-semibold mb-3 text-primary d-flex align-items-center">
                                    <i class="fas fa-university me-2"></i> Information Académique
                                </h5>
                                <ul class="list-unstyled">
                                    <li class="mb-2 d-flex">
                                        <span class="text-muted flex-shrink-0" style="width: 120px;">Université:</span>
                                        <span class="fw-medium">Université Abd malik saadi</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <span class="text-muted flex-shrink-0" style="width: 120px;">Département:</span>
                                        <span class="fw-medium">{{$dataCompt->deparetement}}</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <span class="text-muted flex-shrink-0" style="width: 120px;">Statut:</span>
                                        <span class="fw-medium">Académique</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-card">
                                <h5 class="fw-semibold mb-3 text-primary d-flex align-items-center">
                                    <i class="fas fa-id-card me-2"></i> Information Personnelle
                                </h5>
                                <ul class="list-unstyled">
                                    <li class="mb-2 d-flex">
                                        <span class="text-muted flex-shrink-0" style="width: 120px;">Email:</span>
                                        <span class="fw-medium">{{$dataCompt->Email}}</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <span class="text-muted flex-shrink-0" style="width: 120px;">Téléphone:</span>
                                        <span class="fw-medium">{{$dataCompt->Numeroteliphone}}</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <span class="text-muted flex-shrink-0" style="width: 120px;">CIN:</span>
                                        <span class="fw-medium">{{$dataCompt->CIN}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information Section -->
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="info-card">
                                <h5 class="fw-semibold mb-3 text-primary d-flex align-items-center">
                                    <i class="fas fa-info-circle me-2"></i> Détails Complémentaires
                                </h5>
                                <ul class="list-unstyled">
                                    <li class="mb-2 d-flex">
                                        <span class="text-muted flex-shrink-0" style="width: 120px;">Date naissance:</span>
                                        <span class="fw-medium">{{$dataCompt->data_nissance}}</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <span class="text-muted flex-shrink-0" style="width: 120px;">Spécialité:</span>
                                        <span class="fw-medium">{{$dataCompt->specialite}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-card">
                                <h5 class="fw-semibold mb-3 text-primary d-flex align-items-center">
                                    <i class="fas fa-calendar-alt me-2"></i> Emploi du Temps
                                </h5>
                                <ul class="list-unstyled">
                                    <li class="mb-2 d-flex">
                                        <span class="text-muted flex-shrink-0" style="width: 120px;">Heures permanence:</span>
                                        <span class="fw-medium">Mardi 14h-16h, Jeudi 10h-12h</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <span class="text-muted flex-shrink-0" style="width: 120px;">Nombre de cours:</span>
                                        <span class="fw-medium">4 cette année</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="card-footer bg-light d-flex justify-content-end py-3">
                    <button class="btn btn-outline-primary me-2 rounded-pill px-4">
                        <i class="fas fa-print me-1"></i> Imprimer
                    </button>
                    <button class="btn btn-primary rounded-pill px-4">
                        <i class="fas fa-envelope me-1"></i> Contacter
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
    }

    .info-card {
        background-color: #f8fafc;
        border-radius: 0.75rem;
        padding: 1.25rem;
        height: 100%;
    }

    .rounded-3 {
        border-radius: 0.75rem !important;
    }

    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1) !important;
    }
</style>

@endsection
