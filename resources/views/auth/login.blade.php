<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AcademiQ - Connexion</title>

    <link rel="icon" href="{{ asset('images/favoicon.png') }}" sizes="512x512" type="image/png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Ton CSS -->
    <link rel="stylesheet" href="{{ asset('assets/auth/stylelog.css') }}">
</head>
<body>
    <div class="auth-container animate__animated animate__fadeIn">
        <!-- Left Panel with Slideshow -->
        <div class="left-panel">
            <div class="language-switcher">
                <div class="btn-group">
                     <button class="btn btn-sm active" data-lang="fr">FR</button>
                    <button class="btn btn-sm" data-lang="en">EN</button>
                </div>
            </div>
            <div class="slideshow-container">
                <!-- Slide 1 -->
                <div class="slide slide-1 active">
                    <div class="slide-content">
                        <h1 class="slide-title">Excellence Académique</h1>
                        <p class="slide-description">
                            Notre plateforme soutient la mission éducative de l'université en fournissant des outils administratifs de pointe.
                        </p>

                        <ul class="feature-list">
                            <li class="feature-item visible">
                                <div class="feature-icon">
                                  <i class="bi bi-shield-shaded"></i>
                                </div>
                                <div class="feature-title">Sécurité Maximale</div>
                                <div class="feature-desc">Protection des données conforme aux normes internationales et réglementations RGPD</div>
                            </li>
                            <li class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-speedometer2"></i>
                                </div>
                                <div class="feature-title">Tableau de Bord Intelligent</div>
                                <div class="feature-desc">Visualisation des données clés pour une prise de décision éclairée</div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="slide slide-2">
                    <div class="slide-content">
                        <h1 class="slide-title">Collaboration Innovante</h1>
                        <p class="slide-description">
                            Connectez les différents départements universitaires pour une gestion harmonieuse des ressources académiques.
                        </p>

                        <ul class="feature-list">
                            <li class="feature-item visible">
                                <div class="feature-icon">
                                  <i class="bi bi-graph-up-arrow"></i>
                                </div>
                                <div class="feature-title">Analytiques Avancées</div>
                                <div class="feature-desc">Suivi des indicateurs de performance et génération de rapports automatisés</div>
                            </li>
                            <li class="feature-item">
                                <div class="feature-icon">
                                  <i class="bi bi-people-fill"></i>
                                </div>
                                <div class="feature-title">Gestion des Utilisateurs</div>
                                <div class="feature-desc">Administration centralisée des comptes et permissions</div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="slide slide-3">
                    <div class="slide-content">
                        <h1 class="slide-title">Support Intégral</h1>
                        <p class="slide-description">
                            Notre équipe dédiée assure le fonctionnement optimal de la plateforme à tout moment.
                        </p>

                        <ul class="feature-list">
                            <li class="feature-item visible">
                                <div class="feature-icon">
                                  <i class="bi bi-headset"></i>
                                </div>
                                <div class="feature-title">Assistance 24/7</div>
                                <div class="feature-desc">Support technique disponible à toute heure pour les utilisateurs autorisés</div>
                            </li>
                            <li class="feature-item">
                                <div class="feature-icon">
                                  <i class="bi bi-mortarboard-fill"></i>
                                </div>
                                <div class="feature-title">Formation Continue</div>
                                <div class="feature-desc">Programmes de formation réguliers pour maîtriser toutes les fonctionnalités</div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="slide-controls">
                    <div class="slide-nav">
                        <div class="slide-dot active" data-slide="0"></div>
                        <div class="slide-dot" data-slide="1"></div>
                        <div class="slide-dot" data-slide="2"></div>
                    </div>
                    <i class="bi bi-caret-left-fill slide-arrow prev-slide"></i>
                    <i class="bi bi-caret-right-fill slide-arrow next-slide"></i>

                </div>
            </div>
        </div>

        <!-- Right Panel with Login Form -->
        <div class="right-panel">
            <div class="login-card animate__animated animate__fadeInRight">
                <div class="login-card-header">
                    <div class="university-logo animate__animated animate__bounceIn">
                        <img src="{{asset('assets/images/logo.svg')}}" alt="" >
                    </div>
                </div>

                <div class="login-card-body">
                    <h2 class="auth-title">Connexion Administrateur</h2>
                    <p class="auth-subtitle">Veuillez entrer vos identifiants pour accéder au système</p>

                    <form action="{{ route('auth') }}" method="POST">
                        @csrf <!-- CSRF Protection - Essential for Laravel forms -->

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" id="email"
                                       value="{{ old('email') }}"
                                       placeholder="Entrez votre Email" required autofocus>
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       name="password" id="password"
                                       placeholder="Entrez votre mot de passe" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword" aria-label="Show password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember">Se souvenir de moi</label>
                            </div>

                            <div class="forgot-pass">
                                <a href="">
                                    <i class="bi bi-key-fill me-1"></i>Mot de passe oublié ?
                                </a>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-auth mb-3 w-100">
                            <i class="bi bi-door-open-fill me-2"></i>Se connecter
                        </button>
                    </form>
                    <div class="footer-text">
                        <p>&copy; 2025 Université ENSAH. Tous droits réservés.<br>Version 4.2.1</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

            <script src="{{ asset('assets/js/auth.js') }}"></script>

</body>
</html>
