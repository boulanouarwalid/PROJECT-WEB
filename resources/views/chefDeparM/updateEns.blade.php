@extends('layouts.dash_depar')
@section('main')

<section class="contentt py-4">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="header mb-4">
                    <h1>Géstion  d'enseignement  : </h1>
                    <div class="header-actions"></div>
                </div>
                <div class="form-container">
                    <h3 class="form-title"><i class="fa-solid fa-pen-to-square"></i> Modefication d'enseignement : </h3>
                    <form action="{{ route('editens',$dataRequestEns->id)}}"  method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="nom" class="form-label">Id profiseur <span class="text-danger">*</span></label>
                                <input name="idProf" type="text" class="form-control" id="nom" value="{{$dataRequestEns->idProf}}" readonly required>
                            </div>
                            <div class="col-md-4">
                                <label for="prenom" class="form-label">Nom profiseur <span class="text-danger">*</span></label>
                                <input name="Nomprof" type="text" class="form-control" id="prenom" value="{{$dataRequestEns->Nomprof}}" readonly required>
                            </div>
                            <div class="col-md-4">
                                <label  class="form-label">enseignement <span class="text-danger">*</span></label>
                                <input name="NomModule" type="text" class="form-control" value="{{ $dataRequestEns->NomModule}}" placeholder="enseignement  ..." required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label  class="form-label">Niveaux</label>
                                <input name="niveaux" type="text" class="form-control" value="{{$dataRequestEns->niveaux}}" placeholder="Niveaux ... ">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Filière <span class="text-danger">*</span></label>
                                <select name="feliere" class="form-select" id="filiere" required>
                                    <option value="{{$dataRequestEns->feliere}}" selected disabled>Choisir une filière</option>
                                    <option >geni informatique</option>
                                    <option >ingénieur donnés</option>
                                    <option >tdia</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="date-embauche" class="form-label">charge Heurs (heurs) <span class="text-danger">*</span></label>
                                <input name="NombreHeurs" type="text" class="form-control" value="{{$dataRequestEns->NombreHeurs}}" placeholder="Charge des Heurs... required">
                            </div>
                        </div>
                        <div class="btnmodd d-flex align-items-center gap-3">
                            <div class="modbutton">
                                <button type="submit" class="btnn btn-enr">
                                    <i class="fa-solid fa-floppy-disk"></i> Enregistrer
                                </button>
                            </div>
                            <div class="toggle-container">
                                <span class="toggle-label">Enregistrer :</span>
                                <label class="toggle-switch">
                                    <input type="checkbox" required>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
