<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Unified CSS for consistent styling -->
    <link rel="stylesheet" href="{{ asset('assets/css/dash.css') }}">
    <!-- Department-specific CSS -->
    <link rel="stylesheet" href="{{ asset('assets/depcss/Homdep.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/depcss/profdep.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/depcss/moduledep.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/depcss/searchdep.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/depcss/ajouterm.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/depcss/modef.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/depcss/CreateM.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/depcss/AfecM.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/depcss/profil.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/depcss/Raport.css') }}">

    <!-- Icon libraries -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <!-- Charts library -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <title>Chef de Département Dashboard</title>
</head>

<body>
    <!-- Modern Navbar -->
    <nav class="navbar">
        <div class="container-fluid navbar-container">
            <!-- Left Section -->
            <div class="navbar-left d-flex align-items-center gap-2">
                <i id="sidebarToggle" class="bi bi-layout-sidebar sidebar-toggle"></i>
                <a href="#" class="brand-logo ms-1">AcademiQ</a>
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
                                <span class="user-name-dash">{{ Auth::user()->firstName ?? 'Chef' }} {{ Auth::user()->lastName ?? 'Département' }}</span>
                                <span class="user-role-dash">Chef de Département</span>
                            </div>
                        </div>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li>
                            <div class="dropdown-header">
                                <img src="{{ asset('assets/images/profil_img.jpg')}}" alt="Profile" width="48" height="48" class="rounded-circle">
                                <div>
                                    <h6>{{ Auth::user()->firstName ?? 'Chef' }} {{ Auth::user()->lastName ?? 'Département' }}</h6>
                                    <small>{{ Auth::user()->email ?? '' }}</small>
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
                            <a class="dropdown-item" href="{{ route('profilData') }}">
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

    <!-- Dashboard Layout -->
    <div class="dashboard-layout">
        <!-- Modern Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo-container">
                    <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo" class="logo">
                </div>
            </div>

            <nav class="sidebar-nav">
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashdep') ? 'active' : '' }}" href="{{ route('dashdep') }}">
                            <i class="bx bxs-dashboard"></i>
                            <span class="menu-text">Tableau de bord</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('listeprof') ? 'active' : '' }}" href="{{ route('listeprof') }}">
                            <i class="bx bxs-group"></i>
                            <span class="menu-text">Professeur</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('moduledep') ? 'active' : '' }}" href="{{ route('moduledep') }}">
                            <i class="fa-solid fa-book-open-reader"></i>
                            <span class="menu-text">Enseignement</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('Archive') ? 'active' : '' }}" href="{{ route('Archive') }}">
                            <i class="fa-solid fa-chart-pie"></i>
                            <span class="menu-text">Rapport</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('uesliste') }}">
                            <i class="fa-solid fa-chalkboard-user"></i>
                            <span class="menu-text">Listage</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-file"></i>
                            <span class="menu-text">Annonces</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-folder-open"></i>
                            <span class="menu-text">Archive</span>
                        </a>
                    </li>
                </ul>

                <div class="sidebar-footer">
                    <ul class="nav-menu">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('profilData') ? 'active' : '' }}" href="{{ route('profilData') }}">
                                <i class="bx bxs-cog"></i>
                                <span class="menu-text">Paramètres</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link logout" href="{{ route('deconexion') }}">
                                <i class="bx bxs-log-out"></i>
                                <span class="menu-text">Se Déconnecter</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <main class="main-content">
            @yield('main')
        </main>
    </div>

    <!-- JavaScript Libraries -->
    <!-- jQuery first -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Only include SweetAlert2 if you use it in your dashboard features -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

    <script>
        // Sidebar Toggle (same as admin)
        document.getElementById('sidebarToggle')?.addEventListener('click', () => {
            document.querySelector('.sidebar').classList.toggle('collapsed');
        });

        // Theme Toggle (same as admin)
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
            const savedTheme = localStorage.getItem('theme') ||
                (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            if (savedTheme === 'dark') {
                document.body.classList.add('dark');
            } else {
                document.body.classList.remove('dark');
            }
            updateThemeIcons();

            themeSwitch.addEventListener('click', () => {
                document.body.classList.toggle('dark');
                updateThemeIcons();
                localStorage.setItem('theme', document.body.classList.contains('dark') ? 'dark' : 'light');
            });
        }

        // Bootstrap handles dropdowns, so no need for custom dropdown JS unless you have custom logic.
    </script>
    <script src="{{ asset('assets/js/dashdep.js') }}"></script>
</body>
</html>
