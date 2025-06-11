@extends('layouts.dash')

@section('main')

<section class="container-fluid px-4 py-4">
    <div class="head mb-4">
        <div>
            <h2>Service Département</h2>
            <p class="text-muted">Choix chef de département</p>
        </div>
    </div>
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('ChoixResponsabilite') }}" method="POST" class="mb-4">
                @csrf
                <div class="filterss">
                    <select name="departement" id="poste" class="select-resp">
                        <option value="">Responsabilité</option>
                        @foreach($dep as $d)
                            <option value="{{$d->nom}}">{{$d->nom}}</option>
                        @endforeach
                    </select>
                    <button type="submit">
                        Affecter <i class="fa-solid fa-share"></i>
                    </button>
                    @if(Session()->has('valide'))
                        <span class="text-success fw-bold ms-3">{{session('valide')}}</span>
                    @endif
                    @if(Session()->has('erreur'))
                        <span class="text-danger fw-bold ms-3">{{session('ereur')}}</span>
                    @endif
                </div>
            </form>
            <div class="table-responsive">
                <table class="tabledata">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>CIN</th>
                            <th>Spécialité</th>
                            <th>Email</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Ensinant as $dataEns)
                        <tr>
                            <td>{{$dataEns->lastName}}</td>
                            <td>{{$dataEns->firstName}}</td>
                            <td>{{$dataEns->CIN}}</td>
                            <td>{{$dataEns->specialite}}</td>
                            <td>{{$dataEns->Email}}</td>
                            <td>
                                @if($dataEns->Statu == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Non Active</span>
                                @endif
                            </td>
                            <td>
                                <button title="Voir">
                                    <a href="{{ route('showEnsignant', $dataEns->id) }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection
