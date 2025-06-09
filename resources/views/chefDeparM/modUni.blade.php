@extends('layouts.dash_depar')
@section('main')

<section class="contentCreate py-4">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <form class="creation-form" action="{{ route('editunite', $Unite_data->id) }}" method="POST">
                    @csrf
                    <div class="btnaction">
                        <h1 class="form-title"><i class="fa-solid fa-pen-to-square"></i> Modéfication Unité</h1>
                        <label class="toggle-switch">
                            <input type="checkbox" class="toggle-input" require>
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="form-row">
                        <div class="input-group">
                            <label>Nom de la matière</label>
                            <input type="text" name="nom" value="{{$Unite_data->nom}}"  required>
                        </div>
                        <div class="input-group">
                            <label>Heures Cours</label>
                            <input type="number" name="heures_cm" min="0" value="{{$Unite_data->heures_cm}}"  required>
                        </div>
                        <div class="input-group">
                            <label>Heures TD</label>
                            <input type="number" name="heures_td" min="0" value="{{$Unite_data->heures_td}}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-group">
                            <label>Heures TP</label>
                            <input type="number" name="heures_tp" min="0" value="{{$Unite_data->heures_tp}}" required>
                        </div>
                        <div class="input-group">
                            <label>Semestre</label>
                            <select name="semestre" required>
                                <option value="">Choisir...</option>
                                <option value="S1">S1</option>
                                <option  value="S2">S2</option>
                                <option  value="S3">S3</option>
                                <option  value="S4">S4</option>
                                <option  value="S6">S6</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Année universitaire</label>
                            <input type="text" name="annee_universitaire" value="{{$Unite_data->annee_universitaire}}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-group">
                            <label>Groupe TP</label>
                            <input type="text" name="groupes_td" value="{{$Unite_data->groupes_td}}" required>
                        </div>
                        <div class="input-group">
                            <label>Groupe TD</label>
                            <input type="text" name="groupes_tp" value="{{$Unite_data->groupes_tp}}"  required>
                        </div>
                        <div class="input-group">
                            <label>Filière</label>
                            <select name="filiere_id" required>
                                <option value="">Choisir...</option>
                                @foreach($felier as $fil)
                                    <option value="{{$fil->id}}">{{$fil->nom}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="submit-btn">
                        <i class="fa-solid fa-floppy-disk"></i> Enregistrer
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
