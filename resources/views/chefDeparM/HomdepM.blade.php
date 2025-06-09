@extends('layouts.dash_depar')
@section('main')

<section id="content" class="py-4">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="head-title">
                    <div class="left">
                        <h1>Dashbord</h1>
                        <ul class="breadcrumb">
                            <li>
                                <a href="#">Dashbord</a>
                            </li>
                            <li><i class="bx bx-chevron-right"></i></li>
                            <li>
                                <a class="active" href="#">Chef de déparetement </a>
                            </li>
                        </ul>
                    </div>
                    <a href="#" class="btn-download">
                        <i class="bx bxs-cloud-download"></i>
                        <span class="text">Télécharger PDF</span>
                    </a>
                </div>
                <ul class="box-info">
                    <li>
                        <i class=" fa-solid fa-book"></i>
                        <span class="text">
                            <h3>féliers</h3>
                            <p>Nouveaux models</p>
                        </span>
                    </li>
                    <li>
                        <i class="fa-solid fa-user-tie"></i>
                        <span class="text">
                            <h3>60</h3>
                            <p>Profiseurs</p>
                        </span>
                    </li>
                    <li>
                        <i class="fa-solid fa-users"></i>
                        <span class="text">
                            <h3> 1000</h3>
                            <p>Total Etudiants</p>
                        </span>
                    </li>
                </ul>
                <div class="content-grid">
                    <div>
                        <!-- graphe -->
                        <div class="card">
                            <div id="graphe"></div>
                        </div>
                        <!-- Dernières actualités -->
                        <div class="card">
                            <div class="card-header">
                                <h2>Dernières Actualités</h2>
                            </div>
                            <div class="news-item">
                                <h3>Réunion pédagogique</h3>
                                <p>Préparation du conseil de département le 20 octobre</p>
                                <div class="date">15/10/2023</div>
                            </div>
                            <div class="news-item">
                                <h3>Visite d'entreprise</h3>
                                <p>Organisation visite Google pour les L3 le 25 novembre</p>
                                <div class="date">10/10/2023</div>
                            </div>
                            <div class="news-item">
                                <h3>Nouveau programme</h3>
                                <p>Validation du nouveau programme de Master IA</p>
                                <div class="date">05/10/2023</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <!-- Tâches à faire -->
                        <div class="card">
                            <div class="headtask">
                                <h2><a href="#"><i class="fa-solid fa-plus"></i></a>  Tâches à faire</h2>
                            </div>
                            <div class="task">
                                <input type="checkbox" id="task1">
                                <label for="task1">Valider les emplois du temps</label>
                                <div class="due-date">Aujourd'hui</div>
                            </div>
                            <div class="task">
                                <input type="checkbox" id="task2">
                                <label for="task2">Réviser le budget départemental</label>
                                <div class="due-date">Demain</div>
                            </div>
                            <div class="task">
                                <input type="checkbox" id="task3">
                                <label for="task3">Préparer réunion avec la direction</label>
                                <div class="due-date">18/10/2023</div>
                            </div>
                            <div class="task">
                                <input type="checkbox" id="task4">
                                <label for="task4">Analyser les résultats semestriels</label>
                                <div class="due-date">20/10/2023</div>
                            </div>
                        </div>
                        <!-- Messages récents -->
                        <div class="card">
                            <div class="card-header">
                                <h2>Cordinateur :</h2>
                            </div>
                            @foreach($Responsable as $resp)
                                <div class="message">
                                    <img style="width:40px; height:40px;border-radius:50%; maring-lef:5px;"  src="{{ asset('assets/images/profil_img.jpg') }}" alt="">
                                    <div class="message-content">
                                        <h4>{{$resp->Nomprof}} {{$resp->prenomprof}}</h4>
                                        <p>{{$resp->Responsabilite}} {{$resp->nomf}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
