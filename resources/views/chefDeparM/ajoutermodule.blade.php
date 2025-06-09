@extends('layouts.dash_depar')
@section('main')

<section class="contentt py-4">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="header">
                    <h1>Géstion des modules  : </h1>
                    <div class="header-actions">
                        <form action="">
                            <div class="search-bar">
                                <button type="submit" ><i style="color:#000;" class="fas fa-search"></i></button>
                                <input type="text" placeholder="Rechercher...">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="form-container">
                    <h3 class="form-title"><i class="fa-solid fa-share"></i> Affectation d'enseignement : </h3>
                    <form action="{{ route('affectation') }}"  method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="nom" class="form-label">Id profiseur <span class="text-danger">*</span></label>
                                <input name="idProf" type="text" class="form-control" id="nom" value="{{$id_profiseur}}" readonly required>
                            </div>
                            <div class="col-md-4">
                                <label for="prenom" class="form-label">Nom profiseur <span class="text-danger">*</span></label>
                                <input name="Nomprof" type="text" class="form-control" id="prenom" value="{{$Nom_profiseur}}" readonly required>
                            </div>
                            <div class="col-md-4">
                                <label for="email" class="form-label">enseignement <span class="text-danger">*</span></label>
                                <input name="NomModule" type="text" class="form-control" id="" placeholder="enseignement  ..." required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="telephone" class="form-label">Niveaux</label>
                                <input name="niveaux" type="text" class="form-control"  id="" placeholder="Niveaux ... ">
                            </div>
                            <div class="col-md-4">
                                <label for="filiere" class="form-label">Filière <span class="text-danger">*</span></label>
                                <select name="feliere" class="form-select" id="filiere" required>
                                    <option value="" selected disabled>Choisir une filière</option>
                                    <option >geni informatique</option>
                                    <option >ingénieur donnés</option>
                                    <option >tdia</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="date-embauche" class="form-label">charge Heurs <span class="text-danger">*</span></label>
                                <input name="NombreHeurs" type="text" class="form-control" id="" placeholder="Charge des Heurs... required">
                            </div>
                        </div>
                        <div class="row mt-4" >
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-p">
                                    <i class="fa-solid fa-floppy-disk"></i> Enregistrer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
