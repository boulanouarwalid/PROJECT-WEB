@extends('layouts.dash_depar')
@section('main')
<section id="contenteee" class="py-4">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>code </th>
                                <th>Ensinemant</th>
                                <th>semestre</th>
                                <th>Cours (H)</th>
                                <th>Td (H)</th>
                                <th>Tp (H)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Data_ues as $ues )
                                <tr>
                                    <td>{{$ues->code}}</td>
                                    <td>{{$ues->nom}}</td>
                                    <td>{{$ues->semestre}}</td>
                                    <td>{{$ues->heures_cm}}</td>
                                    <td>{{$ues->heures_td}}</td>
                                    <td>{{$ues->heures_tp}}</td>
                                    <td class="btnact">
                                        <button class="actionn-btn edite" title="Modifier">
                                            <a href="{{ route('updateM' , $ues->id) }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </button>
                                        <button class="actionn-btn deletee"  title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <button class="actionn-btn affect"  title="affect">
                                            <a href="{{ route('Afect' , $ues->id) }}"><i class="fa-solid fa-share-from-square"></i></a>
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
                                                    <form action="{{route('supresion_mo' , $ues->id)}}" method="POST" >
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
