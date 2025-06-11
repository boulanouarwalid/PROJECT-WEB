@extends('layouts.dash_depar')
@section('main')

<section id="contente" class="py-4">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="main-contentee">
                    <div class="header">
                        <div class="header-actions">
                            <form action="{{ route('searchproff') }}" method="POST" >
                                @csrf
                                <div class="search-bar">
                                    <button type="submit" ><i style="color:#000;" class="fas fa-search"></i></button>
                                    <input name="CIN_search" type="text" placeholder="Rechercher CIN prof...">
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- History Container -->
                    <div class="history-container">
                        <div class="history-header">
                            <h2>{{$dataProf_math[0]->deparetement}} </h2>
                            <div class="history-filters">
                                <button class="export-btn">
                                    
                                    <a href="{{ route('exportEnsdepart') }}">
                                        
                                         <i class="fas fa-download"></i>
                                        <span>Exporter</span>

                                    </a>
                                       
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="history-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>CIN</th>
                                        <th>Nom </th>
                                        <th>specialité</th>
                                        <th>Email </th>
                                        <th>teliphone</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dataProf_math as $profinfo)
                                    <tr>
                                        <td>{{$profinfo->id}}</td>
                                        <td>{{$profinfo->CIN}}</td>
                                        <td>{{$profinfo->lastName}} {{$profinfo->firstName}}</td>
                                        <td>{{$profinfo->specialite}}</td>
                                        <td>{{$profinfo->Email}}</td>
                                        <td>{{$profinfo->Numeroteliphone}}</td>
                                        <td><span class="status-badge status-success">Actif</span></td>
                                        <td>
                                            <button class="btnshow">
                                                <a href="{{ route('showEns', $profinfo->id)  }}"><i class="fa-solid fa-eye"></i></a>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination">
                            <div class="pagination-info">
                                Affichage de 1 à 7 sur 124 entrées
                            </div>
                            <div class="pagination-controls">
                                <button class="pagination-btn" disabled>
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button class="pagination-btn active">1</button>
                                <button class="pagination-btn">2</button>
                                <button class="pagination-btn">3</button>
                                <button class="pagination-btn">4</button>
                                <button class="pagination-btn">5</button>
                                <button class="pagination-btn">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
