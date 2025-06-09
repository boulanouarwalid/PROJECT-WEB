@extends('layouts.dash_depar')
@section('main')

<section class="classContent py-4">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="content">
                    <div class="profile-container">
                        <!-- Carte de profil -->
                        <div class="profile-card">
                            <img src="{{ asset('assets/images/profil_img.jpg') }}" alt="Photo de profil" class="profile-img">
                            <h2 class="profile-name">{{$DataUser->lastName}} {{$DataUser->firstName}}</h2>
                            <p class="profile-role">{{$responsabilite->Responsabilite}}</p>
                            <div class="profile-details">
                                <div class="detail-item">
                                    <i class="fas fa-envelope"></i>
                                    <span class="detail-label">Email:</span>
                                    <span class="detail-value">{{$DataUser->Email}}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-phone"></i>
                                    <span class="detail-label">Téléphone:</span>
                                    <span class="detail-value">{{$DataUser->Numeroteliphone}}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Spécialité</span>
                                    <span class="detail-value">{{$DataUser->specialite}}</span>
                                </div>
                            </div>
                            <button class="edit-profile-btn">
                                <i class="fas fa-edit"></i> Modifier le profil
                            </button>
                        </div>
                        <!-- Carte des paramètres -->
                        <div class="settings-card">
                            <h2 class="settings-title">Paramètres du compte</h2>
                            <div class="settings-section">
                                <div>
                                    <h3 class="section-title"><i class="fas fa-lock"></i> Sécurité</h3>
                                    @if(session('messagepassword'))
                                        <h3 style="color:green;">{{session('messagepassword')}}</h3>
                                    @endif
                                </div>
                                <form action="{{ route('updateProfile') }}" method="POST">
                                    @csrf
                                    <div class="form-group password-toggle">
                                        <label for="current-password">Mot de passe actuel</label>
                                        <input name="password" type="password" id="current-password" class="form-control">
                                        <i class="fas fa-eye" id="toggle-current-password"></i>
                                    </div>
                                    <div class="form-group password-toggle">
                                        <label for="new-password">Nouveau mot de passe</label>
                                        <input name="new_password" type="password" id="new-password" class="form-control">
                                        <i class="fas fa-eye" id="toggle-new-password"></i>
                                    </div>
                                    <div class="form-group password-toggle">
                                        <label for="confirm-password">Confirmer le mot de passe</label>
                                        <input name="conf_password" type="password" id="confirm-password" class="form-control">
                                        <i class="fas fa-eye" id="toggle-confirm-password"></i>
                                    </div>
                                    <button class="save-btn" type="submit" >
                                        <i class="fas fa-save"></i> Enregistrer les modifications
                                    </button>
                                </form>
                            </div>
                            <div class="settings-section">
                                <h3 class="section-title"><i class="fas fa-bell"></i> Notifications</h3>
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox"> Recevoir les notifications par email
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox"> Alertes importantes
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox"> Nouvelles fonctionnalités
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    // Fonctionnalité pour afficher/masquer les mots de passe
                    document.querySelectorAll('.password-toggle i').forEach(icon => {
                        icon.addEventListener('click', function() {
                            const input = this.previousElementSibling;
                            if (input.type === 'password') {
                                input.type = 'text';
                                this.classList.remove('fa-eye');
                                this.classList.add('fa-eye-slash');
                            } else {
                                input.type = 'password';
                                this.classList.remove('fa-eye-slash');
                                this.classList.add('fa-eye');
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</section>

@endsection
