@extends('layouts.dash')
@section('main')

<section class=" py-4">
    <div >
        <div class="profile-cardd">
            <div class="profile-header">
                <img src="{{ asset('assets/images/profp.jpg') }}" alt="Photo du professeur" class="profile-img">
                <div class="profile-info">
                    <h1>{{ $Data_Ensignant->lastName }} {{ $Data_Ensignant->firstName }}</h1>
                    <p><strong>Département :</strong> {{ $Data_Ensignant->deparetement }}</p>
                    <p><strong>Spécialité :</strong> {{ $Data_Ensignant->specialite }}</p>
                    <p><strong>Ville :</strong> {{ $Data_Ensignant->ville }}</p>
                </div>
            </div>
            <div class="details-section">
                <div class="details-grid">
                    <div class="detail-item">
                        <label>Email</label>
                        <div>{{ $Data_Ensignant->Email }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Téléphone</label>
                        <div>{{ $Data_Ensignant->Numeroteliphone }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Date de naissance</label>
                        <div>{{ $Data_Ensignant->data_nissance }}</div>
                    </div>
                    <div class="detail-item">
                        <label>CIN</label>
                        <div>{{ $Data_Ensignant->CIN }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Etat Compte</label>
                        @if ($Data_Ensignant->Statu == true)
                            <span class="badge bg-success px-3 py-1 rounded-pill">Active</span>
                        @else
                            <span class="badge bg-danger px-3 py-1 rounded-pill">Bloqué</span>
                        @endif
                    </div>
                    <div class="detail-item">
                        <label>Date d'embauche</label>
                        <div>{{ $Data_Ensignant->created_at }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

