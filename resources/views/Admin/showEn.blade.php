@extends('layouts.dash')
@section('main')

<section class="container-fluid px-4 py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ asset('assets/images/profp.jpg') }}" alt="Photo du professeur" class="rounded-circle me-4" width="100">
                        <div>
                            <h2 class="fw-bold mb-1">{{ $Data_Ensignant->lastName }} {{ $Data_Ensignant->firstName }}</h2>
                            <div class="text-muted">{{ $Data_Ensignant->deparetement }} | {{ $Data_Ensignant->specialite }} | {{ $Data_Ensignant->ville }}</div>
                        </div>
                    </div>
                    <h4 class="fw-semibold mb-3">Informations personnelles</h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div><strong>Email:</strong> {{ $Data_Ensignant->Email }}</div>
                            <div><strong>Téléphone:</strong> {{ $Data_Ensignant->Numeroteliphone }}</div>
                            <div><strong>Date de naissance:</strong> 15/03/1980</div>
                        </div>
                        <div class="col-md-6">
                            <div><strong>Identifiant National (CIN):</strong> {{ $Data_Ensignant->CIN }}</div>
                            <div><strong>Etat Compte:</strong>
                                @if ($Data_Ensignant->Statu == true)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Bloqué</span>
                                @endif
                            </div>
                            <div><strong>Date d'embauche:</strong> {{ $Data_Ensignant->created_at }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
