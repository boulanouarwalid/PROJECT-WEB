@extends('layouts.dash')
@section('main')

<section class="container-fluid px-4 py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h3 class="fw-bold text-primary mb-0">Modification des comptes</h3>
                    <small class="text-muted">Administration / Comptes</small>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="text-center">
                                <img src="{{ asset('assets/images/profp.jpg')}}" alt="" class="rounded-circle mb-3" width="100">
                                <h4>{{ $comptss->firstName }} {{ $comptss->lastName }}</h4>
                                <span class="badge bg-warning text-dark">{{ $comptss->CIN }}</span>
                                <p>{{ $comptss->Numeroteliphone }}</p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <form action="{{route('update', $comptss->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row g-3 mb-3">
                                    <div class="col-md-4">
                                        <label for="firstName" class="form-label">Prénom</label>
                                        <input type="text" id="firstName" name="firstName" value="{{$comptss->firstName}}" class="form-control" required>
                                        @error('firstName')
                                            <div class="text-danger small">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="lastName" class="form-label">Nom</label>
                                        <input type="text" id="lastName" name="lastName" value="{{ $comptss->lastName }}" class="form-control" required>
                                        @error('lastName')
                                            <div class="text-danger small">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="data_nissance" class="form-label">Date de naissance</label>
                                        <input type="date" id="data_nissance" name="data_nissance" value="{{$comptss->data_nissance}}" class="form-control" required>
                                        @error('data_nissance')
                                            <div class="text-danger small">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row g-3 mb-3">
                                    <div class="col-md-4">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" name="email" value="{{$comptss->Email}}" class="form-control" required>
                                        @error('email')
                                            <div class="text-danger small">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="password" class="form-label">Mot de passe</label>
                                        <input type="password" id="password" name="password" value="{{$comptss->password}}" class="form-control" required>
                                        @error('password')
                                            <div class="text-danger small">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="role" class="form-label">Rôle</label>
                                        <input type="text" id="role" name="role" value="{{$comptss->role}}" class="form-control" required>
                                        @error('role')
                                            <div class="text-danger small">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row g-3 mb-3">
                                    <div class="col-md-4">
                                        <label for="ville" class="form-label">Ville</label>
                                        <input type="text" id="ville" name="ville" value="{{$comptss->ville}}" class="form-control" required>
                                        @error('ville')
                                            <div class="text-danger small">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="departement" class="form-label">Département</label>
                                        <select id="departement" name="deparetement" class="form-select" required>
                                            <option>Choisie une departement</option>
                                            @foreach($Departement as $dep)
                                                <option>{{ $dep->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="specialite" class="form-label">Spécialité</label>
                                        <input type="text" id="specialite" name="specialite" value="{{$comptss->specialite}}" class="form-control" required>
                                        @error('specialite')
                                            <div class="text-danger small">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary" type="submit">Modifier</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
