@extends('layouts.dash')
@section('main')

<section class="container-fluid px-4 py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h3 class="fw-bold text-primary mb-0">Ajouter un compte</h3>
                    <small class="text-muted">Administration / Comptes</small>
                </div>
                <div class="card-body">
                    <div class="form">
                        <form action="{{ route('store') }}" method="POST">
                            @csrf

                            <h5 class="mb-3"><i class="fa-solid fa-user me-2"></i> Informations Professeur</h5>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="firstName" class="form-label">Prénom</label>
                                    <input type="text" id="firstName" name="firstName" class="form-control" placeholder="Entrer Prénom ..." required>
                                    @error('firstName')
                                        <div class="text-danger small">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="lastName" class="form-label">Nom</label>
                                    <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Entrer Nom ..." required>
                                    @error('lastName')
                                        <div class="text-danger small">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="data_nissance" class="form-label">Date de naissance</label>
                                    <input type="date" id="data_nissance" name="data_nissance" class="form-control" required>
                                    @error('data_nissance')
                                        <div class="text-danger small">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="Numeroteliphone" class="form-label">Numéro téléphone</label>
                                    <input type="text" id="Numeroteliphone" name="Numeroteliphone" class="form-control" placeholder="Entrer numéro téléphone ..." required>
                                    @error('Numeroteliphone')
                                        <div class="text-danger small">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="CIN" class="form-label">CIN</label>
                                    <input type="text" id="CIN" name="CIN" class="form-control" placeholder="Entrer CIN ..." required>
                                    @error('CIN')
                                        <div class="text-danger small">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="role" class="form-label">Rôle</label>
                                    <input type="text" id="role" name="role" class="form-control" placeholder="Entrer le rôle ..." required>
                                    @error('role')
                                        <div class="text-danger small">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="ville" class="form-label">Ville</label>
                                    <input type="text" id="ville" name="ville" class="form-control" placeholder="Entrer ville ..." required>
                                    @error('ville')
                                        <div class="text-danger small">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="emailPersonelle" class="form-label">Email Personnel</label>
                                    <input type="email" id="emailPersonelle" name="emailPersonelle" class="form-control" placeholder="Email Personnel ...">
                                    @error('emailPersonelle')
                                        <div class="text-danger small">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="specialite" class="form-label">Spécialité</label>
                                    <select id="specialite" name="specialite" class="form-select" required>
                                        <option value="">Spécialité</option>
                                        @foreach($specialite as $spe)
                                            <option value="{{$spe->Nom}}">{{ $spe->Nom }}</option>
                                        @endforeach
                                    </select>
                                    @error('specialite')
                                        <div class="text-danger small">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary btn_conf d-flex align-items-center gap-2 px-4 py-2 shadow-sm"
                                        type="submit"
                                        style="
                                            border-radius: 30px;
                                            font-weight: 600;
                                            font-size: 1.1rem;
                                            letter-spacing: 0.5px;
                                            background: linear-gradient(90deg, #2563eb 0%, #3f51b5 100%);
                                            border: none;
                                            transition: background 0.2s, box-shadow 0.2s;
                                        "
                                        onmouseover="this.style.background='linear-gradient(90deg, #3f51b5 0%, #2563eb 100%)'"
                                        onmouseout="this.style.background='linear-gradient(90deg, #2563eb 0%, #3f51b5 100%)'"
                                >
                                    <i class="fa-solid fa-paper-plane"></i>
                                    Soumettre
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
