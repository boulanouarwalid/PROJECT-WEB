@extends('layouts.dash')
@section('main')

<section id="content" class="container-fluid px-0">
    <div class="head-title mb-4">
        <div class="left">
            <h1>Dashbord</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Dashbord</a>
                </li>
                <li><i class="bx bx-chevron-right"></i></li>
                <li>
                    <a class="active" href="#">Admin</a>
                </li>
            </ul>
        </div>
        <a href="#" class="btn-download">
            <i class="bx bxs-cloud-download"></i>
            <span class="text">uploder File</span>
        </a>
    </div>

    <ul class="box-info row g-3 mb-4">
        <li class="col-md-4">
            <i class="fa-solid fa-book"></i>
            <span class="text">
                <h3><a style="color:#333;" href="{{ route('departemenent') }}">féliers</a></h3>
                <p>Nouveaux models</p>
            </span>
        </li>
        <li class="col-md-4">
            <i class="fa-solid fa-user-tie"></i>
            <span class="text">
                <h3>{{$nombrProf}}</h3>
                <p>Profiseurs</p>
            </span>
        </li>
        <li class="col-md-4">
            <i class="fa-solid fa-users"></i>
            <span class="text">
                <h3>1000</h3>
                <p>Total Etudiants</p>
            </span>
        </li>
    </ul>

    <div class="table-data row g-4">
        <div class="order col-lg-8">
            <div id="graphe" class="graphe"></div>
        </div>
        <div class="todo col-lg-4">
            <div class="head d-flex justify-content-between align-items-center mb-2">
                <i class="bx bx-plus"></i>
                <i class="bx bx-filter"></i>
            </div>
            <ul class="todo-list">
                <li class="completed">
                    <div class="datalist">
                        <img src="{{asset('assets/images/pdf.svg')}}" alt="">
                        <div class="titll">
                            <h4>Anonces.pdf</h4>
                            <p>noveaux Raports</p>
                        </div>
                    </div>

                    <div class="ico">
                        <i class="fa-solid fa-download"></i>
                    </div>


                </li>
                <hr>
                <li class="completed">
                    <div class="datalist">
                        <img src="{{asset('assets/images/psd.svg')}}" alt="">
                        <div class="titll">
                            <h4>Anonces.pdf</h4>
                            <p>noveaux Raports</p>
                        </div>
                    </div>

                    <div class="ico">
                        <i class="fa-solid fa-download"></i>
                    </div>


                </li>
                <hr style="color:gray;">
                <li class="completed">
                    <div class="datalist">
                        <img src="{{asset('assets/images/pdf.svg')}}" alt="">
                        <div class="titll">
                            <h4>Anonces.pdf</h4>
                            <p>noveaux Raports</p>
                        </div>
                    </div>

                    <div class="ico">
                        <i class="fa-solid fa-download"></i>
                    </div>


                </li>
                <hr>
                <li class="completed">
                    <div class="datalist">
                        <img src="{{asset('assets/images/zip.svg')}}" alt="">
                        <div class="titll">
                            <h4>Anonces.pdf</h4>
                            <p>noveaux Raports</p>
                        </div>
                    </div>

                    <div class="ico">
                        <i class="fa-solid fa-download"></i>
                    </div>


                </li>
                <hr>
                <li class="completed">
                    <div class="datalist">
                        <img src="{{asset('assets/images/pdf.svg')}}" alt="">
                        <div class="titll">
                            <h4>Anonces.pdf</h4>
                            <p>noveaux Raports</p>
                        </div>
                    </div>

                    <div class="ico">
                        >>
                    </div>


                </li>
            </ul>
        </div>
    </div>

    <div class="dashelem row g-4 mt-4">
        <div class="panel col-lg-7">
            <table class="data-table table table-striped">
                <thead>
                    <tr>
                        <th>CIN</th>
                        <th>Membre</th>
                        <th>Poste</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataResp as $responsable)
                    <tr>
                        <td><span class="department-tag tech">{{$responsable->CIN}}</span></td>
                        <td>
                            <div class="user-card d-flex align-items-center">
                                <img src="{{ asset('assets/images/profp.jpg')}}" class="user-avatar me-2">
                                <div class="user-info">
                                    <h4>{{$responsable->Nomprof}}</h4>
                                    <p>{{$responsable->prenomprof}}</p>
                                </div>
                            </div>
                        </td>
                        <td>{{$responsable->Responsabilite}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="conpall col-lg-5">
            <div class="sttitle mb-3">
                <h3><i class="fa-solid fa-chart-pie"></i> <span>Charge Administration :</span></h3>
            </div>
            <div class="grapheee"></div>
        </div>
    </div>

    <script>
        window.stresp = {
            statiResp : @json($statRe),
        };
    </script>
    <script src="{{ asset('assets/js/graphe.js') }}"></script>
</section>

@endsection
