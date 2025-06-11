<div class="col-md-3 col-lg-2 d-md-block sidebar collapse p-0" id="sidebar">
    <div class="position-sticky pt-3 mx-3">
        <div class="text-center p-4 ">
            <div class="logo-container">
                <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo" class="logo">
                <span class="short-title d-none "></span>
            </div>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('vacataire/dash') ? 'active' : '' }}"
                   href="{{ route('vacataire.dash') }}">
                    <i class="bi bi-speedometer2"></i>
                    <span class="menu-text">Tableau de bord</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('vacataire/ues*') ? 'active' : '' }}"
                   href="{{ route('vacataire.ues') }}">
                    <i class="bi bi-book"></i>
                    <span class="menu-text">Mes Unités d'Enseignement</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('vacataire/notes*') ? 'active' : '' }}"
                   href="{{ route('vacataire.notes') }}">
                    <i class="bi bi-journal-text"></i>
                    <span class="menu-text">Gestion des Notes</span>
                </a>
            </li>

        </ul>
    </div>
</div>
