@extends('layouts.dash_depar')
@section('main')

<section class=" py-4">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="profile-container">
                    <!-- Photo et informations basiques à gauche -->
                    <div class="profile-photo">
                        <div class="photo-frame">
                            <img src="{{asset('assets/images/profp.jpg')}}" alt="Professeur Ahmed Benali">
                        </div>
                        <h1 class="profile-name">Pr. {{$dataUser->lastName}} {{$dataUser->firstName}}</h1>
                        <div class="profile-title">Professeur des Universités en Informatique</div>
                        <div class="contact-info">
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                {{$dataUser->Email}}
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-phone"></i>
                                {{$dataUser->Numeroteliphone}}
                            </div>
                        </div>
                    </div>
                    <!-- Détails du profil à droite -->
                    <div class="profile-details">
                        <h2 class="section-title">
                            <i class="fas fa-info-circle"></i>
                            Informations Professionnelles
                        </h2>
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Date de nomination</div>
                                <div class="info-value">{{$dataUser->created_at}}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Grade universitaire</div>
                                <div class="info-value">Professeur (Classe Exceptionnelle)</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Département</div>
                                <div class="info-value">Informatique et Mathématiques Appliquées</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Équipe de recherche</div>
                                <div class="info-value">Laboratoire de Recherche en Informatique</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Spécialité</div>
                                <div class="info-value">{{$dataUser->specialite}}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Statut</div>
                                <div class="info-value">Actif</div>
                            </div>
                        </div>
                        <h2 class="section-title">
                            <i class="fas fa-book-open"></i>
                            Enseignements
                        </h2>
                        <ul class="courses-list">
                            <li class="course-item">
                                <i class="fas fa-check-circle"></i>
                            </li>
                            <li class="course-item">
                                <i class="fas fa-check-circle"></i>
                                aucun ensignement
                            </li>
                        </ul>
                        <h2 class="section-title">
                            <i class="fas fa-graduation-cap"></i>
                            Responsabilités
                        </h2>
                        <div class="info-item">
                            <div class="info-value">
                                - {{$dataUser->role}} Acadimique
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
