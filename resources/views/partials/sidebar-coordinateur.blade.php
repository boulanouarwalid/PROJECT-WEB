<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('coordinateur.dashboard') ? 'active' : '' }}" href="{{ route('coordinateur.dashboard') }}">
            <i class="bx bxs-dashboard"></i>
            <span class="menu-text">Tableau de bord</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('coordinateur.ues.*') ? 'active' : '' }}" href="{{ route('coordinateur.ues.index') }}">
            <i class="fa-solid fa-book-open"></i>
            <span class="menu-text">Gestion UEs</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('coordinateur.affectations.*') ? 'active' : '' }}" href="{{ route('coordinateur.affectations.index') }}">
            <i class="fa-solid fa-user-tie"></i>
            <span class="menu-text">Affectations</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('coordinateur.emploi-temps.*') ? 'active' : '' }}" href="{{ route('coordinateur.emploi-temps.index') }}">
            <i class="fa-solid fa-calendar-days"></i>
            <span class="menu-text">Emploi du Temps</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('coordinateur.vacataires.*') ? 'active' : '' }}" href="{{ route('coordinateur.vacataires.index') }}">
            <i class="fa-solid fa-chalkboard-user"></i>
            <span class="menu-text">Vacataires</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('coordinateur.historique.*') ? 'active' : '' }}" href="{{ route('coordinateur.historique.index') }}">
            <i class="fa-solid fa-clock-rotate-left"></i>
            <span class="menu-text">Historique</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('coordinateur.import-export.*') ? 'active' : '' }}" href="{{ route('coordinateur.import-export.index') }}">
            <i class="fa-solid fa-file-import"></i>
            <span class="menu-text">Import/Export</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('coordinateur.notes.*') ? 'active' : '' }}" href="{{ route('coordinateur.notes.index') }}">
            <i class="fa-solid fa-clipboard-check"></i>
            <span class="menu-text">Validation Notes</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('coordinateur.rapports.*') ? 'active' : '' }}" href="{{ route('coordinateur.rapports.index') }}">
            <i class="fa-solid fa-chart-line"></i>
            <span class="menu-text">Rapports</span>
        </a>
    </li>
</ul>
<hr>
<ul class="nav flex-column mt-auto">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('coordinateur.settings') ? 'active' : '' }}" href="{{ route('coordinateur.settings') }}">
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
