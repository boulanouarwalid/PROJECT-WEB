<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/dash.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Hom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/compts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/create.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/update.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Anonces.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/search.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/param.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/respo.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/module.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/affecd.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/searchp.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/depar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/showEns.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/AjoutFel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/affectcord.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/specialite.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/uesafiche.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap-grid.min.css" integrity="sha512-Aa+z1qgIG+Hv4H2W3EMl3btnnwTQh1Y1JjA3yW21RewAhxjanvaUoSkVZF3PsjapW1IfsGrEO3FU693ReouVTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <title>Sunudeal Dashbord</title>
</head>

<body>
   <!-- Navbar -->
    <nav class="navbar">
        <div class="container-fluid navbar-container">
            <!-- Left Section -->
            <div class="navbar-left">
                <i id="sidebarToggle" class="bi bi-layout-sidebar sidebar-toggle"></i>
                <a href="#" class="brand-logo">AcademiQ</a>
            </div>
            
            <!-- Search Section -->
            <div class="search-container-dash">
                <form class="search-form" action="#">
                    <input class="search-input-dash" type="text" placeholder="Rechercher cours, étudiants...">
                    <button class="search-btn-dash" type="submit">
                        <i class="bx bx-search"></i>
                    </button>
                </form>
            </div>
            
            <!-- Right Section -->
            <div class="navbar-right-dash">
                <!-- Notification -->
                <button class="nav-icon-dash notification-btn-dash">
                    <i class="bi bi-bell"></i>
                    <span class="notification-badge-dash">3</span>
                </button>
                
                <!-- Email -->
                <button class="nav-icon-dash email-btn-dash">
                    <i class="bi bi-envelope"></i>
                </button>
                
                <!-- Theme Switch -->
                <button id="theme-switch" class="nav-icon-dash theme-toggle-dash" aria-label="Toggle dark mode">
                    <i class="bi bi-moon-fill theme-toggle-icon" id="moon-icon"></i>
                    <i class="bi bi-sun-fill theme-toggle-icon d-none" id="sun-icon"></i>
                </button>
                
                @auth
                <!-- User Profile Dropdown -->
                <div class="dropdown-dash">
                    <a class="dropdown-toggle-dash" href="#" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-profile-dash">
                            <img src="{{ asset('assets/images/profil_img.jpg')}}" alt="Profile" class="user-avatar-dash">
                            <div class="user-info-dash d-none d-lg-flex">
                                <span class="user-name-dash">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</span>
                                <span class="user-role-dash">Administrator</span>
                            </div>
                        </div>
                    </a>
                    
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li>
                            <div class="dropdown-header">
                                <img src="{{ asset('assets/images/profil_img.jpg')}}" alt="Profile" width="48" height="48" class="rounded-circle">
                                <div>
                                    <h6>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</h6>
                                    <small>{{ Auth::user()->email }}</small>
                                </div>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-person dropdown-icon"></i>
                                <span>Mon Profil</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('param') }}">
                                <i class="bi bi-gear dropdown-icon"></i>
                                <span>Paramètres</span>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('deconexion') }}">
                                <i class="bi bi-box-arrow-right dropdown-icon"></i>
                                <span>Déconnexion</span>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-footer">
                                Version 1.0.0
                            </div>
                        </li>
                    </ul>
                </div>
                @endauth
            </div>
        </div>
    </nav>
     <div class="container-fluid">
        <div class="row">
            <div class="dashboard-layout">
                <aside class="sidebar" id="sidebar">
                    <div class="position-sticky pt-3 mx-1">
                        <div class="text-center p-4">
                            <div class="logo-container">
                                <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo" class="logo">
                                <span class="short-title d-none"></span>
                            </div>
                        </div>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}" href="{{ route('index') }}">
                                    <i class="bx bxs-dashboard"></i>
                                    <span class="menu-text">Tableau de bord</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('listUser') ? 'active' : '' }}" href="{{ route('listUser') }}">
                                    <i class="fa-solid fa-chalkboard-user"></i>
                                    <span class="menu-text">Enseignant</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('respon') ? 'active' : '' }}" href="{{ route('respon') }}">
                                    <i class="fa-solid fa-user-tie"></i>
                                    <span class="menu-text">Département</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('felierindex') ? 'active' : '' }}" href="{{ route('felierindex') }}">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                    <span class="menu-text">Filière</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('departemenent') ? 'active' : '' }}" href="{{ route('departemenent') }}">
                                    <i class="fa-solid fa-users"></i>
                                    <span class="menu-text">Administration</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('anonces') ? 'active' : '' }}" href="{{ route('anonces') }}">
                                    <i class="fa-solid fa-file"></i>
                                    <span class="menu-text">Annonces</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('specialite') ? 'active' : '' }}" href="{{ route('specialite') }}">
                                    <i class="fa-solid fa-chalkboard"></i>
                                    <span class="menu-text">Spécialité</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('uesListe') ? 'active' : '' }}" href="{{ route('uesListe') }}">
                                    <i class="fa-solid fa-book-open"></i>
                                    <span class="menu-text">Enseignement</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('param') ? 'active' : '' }}" href="{{ route('param') }}">
                                    <i class="bx bxs-cog"></i>
                                    <span class="menu-text">Paramètres</span>
                                </a>
                            </li>
                        </ul>
                        <hr>
                        <ul class="nav flex-column mt-auto">
                            <li class="nav-item">
                                <a class="nav-link logout" href="{{ route('deconexion') }}">
                                    <i class="bx bxs-log-out"></i>
                                    <span class="menu-text">Se Déconnecter</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </aside>
                <main class="main-content col-md-9 col-lg-9">
                    @yield('main')
                </main>
            </div>
        </div>
    </div>
 

   
        <!-- jQuery first -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Then Bootstrap Bundle (only include once!) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Sidebar Toggle
        document.getElementById('sidebarToggle')?.addEventListener('click', () => {
            document.querySelector('.sidebar').classList.toggle('collapsed');
        });

         // Theme Toggle
        const themeSwitch = document.getElementById('theme-switch');
        const moonIcon = document.getElementById('moon-icon');
        const sunIcon = document.getElementById('sun-icon');

        function updateThemeIcons() {
            if (document.body.classList.contains('dark')) {
                moonIcon.classList.add('d-none');
                sunIcon.classList.remove('d-none');
            } else {
                moonIcon.classList.remove('d-none');
                sunIcon.classList.add('d-none');
            }
        }

        if (themeSwitch) {
            // Check for saved theme preference or use system preference
            const savedTheme = localStorage.getItem('theme') ||
                (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');

            // Apply the saved theme
            if (savedTheme === 'dark') {
                document.body.classList.add('dark');
            } else {
                document.body.classList.remove('dark');
            }
            updateThemeIcons();

            themeSwitch.addEventListener('click', () => {
                document.body.classList.toggle('dark');
                updateThemeIcons();
                // Save preference to localStorage
                const isDark = document.body.classList.contains('dark');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
            });
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown-dash')) {
                const dropdowns = document.querySelectorAll('.dropdown-menu');
                dropdowns.forEach(function(dropdown) {
                    dropdown.classList.remove('show');
                });
            }
        });
    </script>
    <script src="{{ asset('assets/js/dash.js') }}"></script>

</body>
</html>