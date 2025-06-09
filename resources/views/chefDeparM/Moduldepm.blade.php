@extends('layouts.dash_depar')
@section('main')
<section id="contenteee" class="py-4">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="header">
                    <div class="header-actions">
                        <form action="{{ route('searchModule') }}" method="POST">
                            @csrf
                            @if(Session()->has('messagecreat'))
                                <div id="validationMessage" class="validation-message">
                                    <span>✔ {{ session('messagecreat') }} </span>
                                </div>
                            @endif
                            @if(Session()->has('messageupdate'))
                                <div id="validationMessage" class="validation-message">
                                    <span>✔ {{ session('messageupdate') }} </span>
                                </div>
                            @endif
                            @if(Session()->has('supresion'))
                                <div id="validationMessage" class="validation-message">
                                    <span><i class="fa-solid fa-trash" style="color: white;"></i> {{ session('supresion') }} </span>
                                </div>
                            @endif
                            @if(Session()->has('Maff'))
                                <div id="validationMessage" class="validation-message">
                                    <span>✔ {{ session('Maff') }} </span>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
                <div class="table-container">
                    <form action="{{ route('filter') }}" method="POST">
                        @csrf
                        <div class="table-header">
                            <div class="table-title">
                                <select name="id" class="customSelect" id="options">
                                    <option value="">Sélectionnez...</option>
                                    @foreach($filier as $fl)
                                        <option value="{{$fl->id}}">{{$fl->nom}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if(session('message'))
                                <h3 style="color:red;">{{session('message')}}</h3>
                            @endif
                            <div class="table-actions">
                                <button class="btn btn-serch" type="submit">
                                    Recherche <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                    </form>
                                <button class="btn btn-primary">
                                    <a href="{{ route('createModel') }}"><i class="fas fa-plus"></i> Ajouter Module</a>
                                </button>
                            </div>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>code </th>
                                    <th>Ensinemant</th>
                                    <th>Félieres</th>
                                    <th>semestre</th>
                                    <th>Heurs Cours</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Data_Ens as $modules)
                                    <tr>
                                        <td>{{$modules->code}}</td>
                                        <td>{{$modules->nom}}</td>
                                        <td>{{$modules->nomf}}</td>
                                        <td>{{$modules->semestre}}</td>
                                        <td>{{$modules->heures_cm}}</td>
                                        <td class="btnact">
                                            <button class="actionn-btn edite" title="Modifier">
                                                <a href="{{ route('updateM' ,$modules->id) }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </button>
                                            <button class="actionn-btn deletee"  title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <button class="actionn-btn affect"  title="affect">
                                                <a href="{{ route('Afect' , $modules->id) }}"><i class="fa-solid fa-share-from-square"></i></a>
                                            </button>
                                            <div id="confirmationModal" class="confirmation-modal">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3>Confirmation de suppression</h3>
                                                        <button class="close-btn">&times;</button>
                                                    </div>
                                                    <div class="warning-icon">
                                                        <i class="fas fa-exclamation-triangle"></i>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Êtes-vous sûr de vouloir supprimer cet élément ? Cette action est irréversible.</p>
                                                        <p>Toutes les données associées seront définitivement perdues.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button id="cancelBtn" class="btnnn btn-cancel">Annuler</button>
                                                        <form action="{{ route('supresion_mo' , $modules->id) }}" method="POST" >
                                                            @csrf
                                                            @method('DELETE')
                                                            <button id="confirmBtn" class="btnnn btn-confirm">Confirmer la suppression</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
