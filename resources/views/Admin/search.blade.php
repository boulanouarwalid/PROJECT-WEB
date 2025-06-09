@extends('layouts.dash')
@section('main')

<section class="container-fluid px-4 py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3 class="fw-bold text-primary mb-0">Profil Professeur</h3>
                    <a href="{{route('edit', $dataCompt->id)}}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ asset('assets/images/profp.jpg') }}" class="rounded-circle me-4" width="100">
                        <div>
                            <h2 class="fw-bold mb-1">{{ $dataCompt->lastName }} {{$dataCompt->firstName}}</h2>
                            <div class="text-muted">{{$dataCompt->role}} {{$dataCompt->specialite}}</div>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div><strong>Université:</strong> Université Abd malik saadi</div>
                            <div><strong>Département:</strong> {{$dataCompt->deparetement}}</div>
                            <div><strong>Professeur:</strong> Acadimique</div>
                        </div>
                        <div class="col-md-6">
                            <div><strong>Email:</strong> {{$dataCompt->Email}}</div>
                            <div><strong>Téléphone:</strong> {{$dataCompt->Numeroteliphone}}</div>
                            <div><strong>CIN:</strong> {{$dataCompt->CIN}}</div>
                        </div>
                    </div>
                    <h4 class="fw-semibold mb-3">Informations complémentaires</h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div><strong>Date naissance:</strong> {{$dataCompt->data_nissance}}</div>
                            <div><strong>Spécialité:</strong> {{$dataCompt->specialite}}</div>
                        </div>
                        <div class="col-md-6">
                            <div><strong>Heures de permanence:</strong> Mardi 14h-16h, Jeudi 10h-12h</div>
                            <div><strong>Nombre de cours:</strong> 4 cette année</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
