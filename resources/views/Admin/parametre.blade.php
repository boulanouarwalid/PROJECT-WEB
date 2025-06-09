@extends('layouts.dash')
@section('main')

<section class="container-fluid px-4 py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    {{-- Success messages --}}
                    @if(Session()->has('pass_mod'))
                        <div id="messageDiv" class="alert alert-success d-flex align-items-center gap-2 mb-3" role="alert">
                            <i class="fa-solid fa-circle-check"></i> {{session('pass_mod')}}
                        </div>
                    @endif
                    @if(Session()->has('mod_data'))
                        <div id="messageDiv" class="alert alert-success d-flex align-items-center gap-2 mb-3" role="alert">
                            <i class="fa-solid fa-circle-check"></i> {{session('mod_data')}}
                        </div>
                    @endif

                    {{-- Compte --}}
                    <h3 class="fw-bold mb-3 text-primary"><i class="fa-solid fa-user me-2"></i> Compte</h3>
                    <form action="{{route('mod_param', $dataAdmin->id)}}" method="POST" class="mb-4">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom complet</label>
                            <input name="Nomcomplet" type="text" id="name" class="form-control" value="{{ $dataAdmin->Nomcomplet }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse email</label>
                            <input name="email" type="email" id="email" class="form-control" value="{{ $dataAdmin->email }}">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Téléphone</label>
                            <input name="teliphone" type="tel" id="phone" class="form-control" value="{{ $dataAdmin->teliphone }}">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Enregistrer les modifications</button>
                    </form>

                    {{-- Sécurité --}}
                    <h3 class="fw-bold mb-3 text-primary"><i class="fas fa-shield-alt me-2"></i> Sécurité</h3>
                    <div class="alert alert-warning">
                        <strong>Sécurité du compte :</strong> Votre mot de passe a été défini il y a plus de 90 jours. Pour la sécurité de votre compte, nous vous recommandons de le changer.
                    </div>
                    <form action="{{ route('password_mod', $dataAdmin->id) }}" method="POST" class="mb-4">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="current-password" class="form-label">Mot de passe actuel</label>
                            <input name="password" type="password" id="current-password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="new-password" class="form-label">Nouveau mot de passe</label>
                            <input name="nv_password" type="password" id="new-password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="confirm-password" class="form-label">Confirmer le nouveau mot de passe</label>
                            <input name="conf_password" type="password" id="confirm-password" class="form-control">
                        </div>
                        <button class="btn btn-primary w-100">Changer le mot de passe</button>
                    </form>

                    {{-- Préférences --}}
                    <h3 class="fw-bold mb-3 text-primary"><i class="fa-solid fa-sliders me-2"></i> Préférences</h3>
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="newsletter" checked>
                        <label class="form-check-label" for="newsletter">Recevoir les newsletters</label>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="notifEmail">
                        <label class="form-check-label" for="notifEmail">Notifications par email</label>
                    </div>
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" id="notifPush" checked>
                        <label class="form-check-label" for="notifPush">Notifications push</label>
                    </div>

                    {{-- Zone dangereuse --}}
                    <h3 class="fw-bold mb-3 text-danger"><i class="fa-solid fa-triangle-exclamation me-2"></i> Zone dangereuse</h3>
                    <div class="alert alert-danger d-flex flex-column align-items-start">
                        <div>
                            La suppression de votre compte est permanente. Toutes vos données seront supprimées et ne pourront pas être récupérées.
                        </div>
                        <button class="btn btn-danger mt-3">Supprimer mon compte</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
