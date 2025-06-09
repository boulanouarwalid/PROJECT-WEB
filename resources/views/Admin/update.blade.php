@extends('layouts.dash')
@section('main')

<section class="container-fluid px-4 py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h3 class="fw-bold text-primary mb-0">Modification des comptes</h3>
                    <small class="text-muted">Administration / Comptes</small>
                </div>
                <div class="card-body">
                    <div class="form">
                        <form action="{{route('update', $comptss->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <h5 class="mb-3"><i class="fa-solid fa-user me-2"></i> Informations Professeur</h5>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="firstName" class="form-label">Prénom</label>
                                    <input type="text" id="firstName" name="firstName" value="{{$comptss->firstName}}" class="form-control" required>
                                    @error('firstName')
                                        <div class="text-danger small">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="lastName" class="form-label">Nom</label>
                                    <input type="text" id="lastName" name="lastName" value="{{$comptss->lastName}}" class="form-control" required>
                                    @error('lastName')
                                        <div class="text-danger small">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="data_nissance" class="form-label">Date de naissance</label>
                                    <input type="date" id="data_nissance" name="data_nissance" value="{{$comptss->data_nissance}}" class="form-control" required>
                                    @error('data_nissance')
                                        <div class="text-danger small">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="Numeroteliphone" class="form-label">Numéro téléphone</label>
                                    <input type="text" id="Numeroteliphone" name="Numeroteliphone" value="{{$comptss->Numeroteliphone}}" class="form-control" required>
                                    @error('Numeroteliphone')
                                        <div class="text-danger small">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="CIN" class="form-label">CIN</label>
                                    <input type="text" id="CIN" name="CIN" value="{{$comptss->CIN}}" class="form-control" required>
                                    @error('CIN')
                                        <div class="text-danger small">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="role" class="form-label">Rôle</label>
                                    <input type="text" id="role" name="role" value="{{$comptss->role}}" class="form-control" required>
                                    @error('role')
                                        <div class="text-danger small">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="ville" class="form-label">Ville</label>
                                    <input type="text" id="ville" name="ville" value="{{$comptss->ville}}" class="form-control" required>
                                    @error('ville')
                                        <div class="text-danger small">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label">Email Personnel</label>
                                    <input type="email" id="email" name="email" value="{{$comptss->Email}}" class="form-control" required>
                                    @error('email')
                                        <div class="text-danger small">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="specialite" class="form-label">Spécialité</label>
                                    <input type="text" id="specialite" name="specialite" value="{{$comptss->specialite}}" class="form-control" required>
                                    @error('specialite')
                                        <div class="text-danger small">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="departement" class="form-label">Département</label>
                                    <select id="departement" name="deparetement" class="form-select" required>
                                        <option value="">Choisie une departement</option>
                                        @foreach($Departement as $dep)
                                            <option value="{{ $dep->nom }}" {{ $comptss->deparetement == $dep->nom ? 'selected' : '' }}>{{ $dep->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label">Mot de passe</label>
                                    <input type="password" id="password" name="password" value="{{$comptss->password}}" class="form-control" required>
                                    @error('password')
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
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    Modifier
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
