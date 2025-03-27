<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AcademiQ - Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="pages/includes/stylelogin.css?v=1.1">
    
</head>
<body>
    <div class="main-container d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center align-items-center m-3">
                <!-- Benefits Carousel -->
                <div class="col-lg-7 d-none d-lg-block pe-5 ">
                    <div class="benefits-card p-4 h-100 ">
                        <div id="benefitsCarousel" class="carousel slide h-100" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#benefitsCarousel" data-bs-slide-to="0" class="active"></button>
                                <button type="button" data-bs-target="#benefitsCarousel" data-bs-slide-to="1"></button>
                                <button type="button" data-bs-target="#benefitsCarousel" data-bs-slide-to="2"></button>
                                <button type="button" data-bs-target="#benefitsCarousel" data-bs-slide-to="3"></button>
                            </div>
                            <div class="carousel-inner h-100 rounded">
                                <div class="carousel-item active benefit-slide">
                                    <div class="d-flex flex-column justify-content-center h-100">
                                        <i class="bi bi-speedometer2 benefit-icon"></i>
                                        <h3>Gestion Simplifiée</h3>
                                        <p class="lead">Optimisez la gestion des unités d'enseignement et des affectations avec notre interface intuitive.</p>
                                        <ul class="mt-3">
                                            <li>Automatisation des processus</li>
                                            <li>Suivi en temps réel</li>
                                            <li>Rapports personnalisés</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="carousel-item benefit-slide">
                                    <div class="d-flex flex-column justify-content-center h-100">
                                        <i class="bi bi-people-fill benefit-icon"></i>
                                        <h3>Collaboration Facilitée</h3>
                                        <p class="lead">Améliorez la coordination entre les coordinateurs et les vacataires.</p>
                                        <ul class="mt-3">
                                            <li>Communication centralisée</li>
                                            <li>Notifications automatiques</li>
                                            <li>Accès multi-utilisateurs</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="carousel-item benefit-slide">
                                    <div class="d-flex flex-column justify-content-center h-100">
                                        <i class="bi bi-bar-chart-line benefit-icon"></i>
                                        <h3>Analyse des Données</h3>
                                        <p class="lead">Prenez des décisions éclairées avec nos outils d'analyse avancés.</p>
                                        <ul class="mt-3">
                                            <li>Tableaux de bord personnalisables</li>
                                            <li>Visualisation des données</li>
                                            <li>Export des rapports</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="carousel-item benefit-slide">
                                    <div class="d-flex flex-column justify-content-center h-100">
                                        <i class="bi bi-shield-lock benefit-icon"></i>
                                        <h3>Sécurité Renforcée</h3>
                                        <p class="lead">Vos données sont protégées avec les meilleures standards de sécurité.</p>
                                        <ul class="mt-3">
                                            <li>Chiffrement des données</li>
                                            <li>Sauvegardes automatiques</li>
                                            <li>Contrôle d'accès granulaire</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#benefitsCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#benefitsCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Login Form -->
                <div class="col-lg-4">
                    <div class="login-card card p-4">
                        <div class="card-body">
                            <!-- Logo -->
                            <div class="logo-container">
                                <h2 class="text-primary m-0 fw-bold">AQ</h2>
                            </div>
                            
                            <h2 class="text-center mb-4">Connexion à AcademiQ</h2>
                            
                            <!-- Login Form -->
                            <form id="loginForm">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Adresse Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" class="form-control" id="email" placeholder="votre@email.com" required>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mot de passe</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input type="password" class="form-control" id="password" placeholder="••••••••" required>
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="rememberMe">
                                        <label class="form-check-label" for="rememberMe">Se souvenir de moi</label>
                                    </div>
                                    <a href="#" class="text-decoration-none">Mot de passe oublié ?</a>
                                </div>
                                
                                <button type="submit" class="btn btn-login text-white w-100 mb-3">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
                                </button>
                                
                                <div class="text-center">
                                    <p class="mb-0">Nouveau sur AcademiQ ? <a href="#" class="create-account-link">Créer un compte</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="pages/includes/scriptlg.js"></script>
</body>
</html> 