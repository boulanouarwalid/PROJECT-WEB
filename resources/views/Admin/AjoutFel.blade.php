@extends('layouts.dash')
@section('main')

<section class="container-fluid px-4 py-4">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">
            <div class="card border-0 shadow-sm">
                <div class="card-body py-4 px-4">
                    <h2 class="fw-bold text-primary mb-4">
                        <i class="fa-solid fa-layer-group me-2"></i>
                        Ajouter une Filière
                    </h2>
                    <form action="{{ route('storeFeliere') }}" method="post" class="form-containerre">
                        @csrf
                        <div class="form-roww">
                            <div class="formme-group">
                                <label for="nom">Nom de la filière</label>
                                <input type="text" id="nom" name="nom" class="form-control" placeholder="Entrer le nom du feliere ..." required>
                            </div>
                            <div class="formme-group">
                                <label for="departement">Département</label>
                                <select id="departement" name="departement" class="form-select" required>
                                    <option value="">Sélectionner un département</option>
                                    @foreach($Departement as $dep)
                                        <option value="{{$dep->nom}}">{{$dep->nom}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="formme-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="form-control" placeholder="Entrer une description du feliere ..." required></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btnne-submit d-flex align-items-center gap-2 shadow-sm">
                                <i class="fa-solid fa-share-from-square"></i> Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
