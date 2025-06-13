<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('prof.dash') ? 'active' : '' }}" href="{{ route('prof.dash') }}">
            <i class="bx bxs-dashboard"></i>
            <span class="menu-text">Tableau de bord</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('prof.modules') ? 'active' : '' }}" href="{{ route('prof.modules') }}">
            <i class="fa-solid fa-book-open"></i>
            <span class="menu-text">Mes Modules</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('prof.chargehoraire') || request()->routeIs('charge-horaire.*') ? 'active' : '' }}" href="{{ route('prof.chargehoraire') }}">
            <i class="fa-solid fa-clock"></i>
            <span class="menu-text">Charge Horaire</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('prof.emploi-temps.*') ? 'active' : '' }}" href="{{ route('prof.emploi-temps.index') }}">
            <i class="fa-solid fa-calendar-days"></i>
            <span class="menu-text">Emploi du Temps</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('prof.notes.*') ? 'active' : '' }}" href="{{ route('prof.notes.index') }}">
            <i class="fa-solid fa-clipboard-list"></i>
            <span class="menu-text">Saisie Notes</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('prof.ues.*') ? 'active' : '' }}" href="{{ route('prof.ues.index') }}">
            <i class="fa-solid fa-graduation-cap"></i>
            <span class="menu-text">Mes UEs</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('prof.historique') ? 'active' : '' }}" href="{{ route('prof.historique') }}">
            <i class="fa-solid fa-clock-rotate-left"></i>
            <span class="menu-text">Historique</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('prof.documents.*') ? 'active' : '' }}" href="{{ route('prof.documents.index') }}">
            <i class="fa-solid fa-file-pdf"></i>
            <span class="menu-text">Documents</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('prof.evaluations.*') ? 'active' : '' }}" href="{{ route('prof.evaluations.index') }}">
            <i class="fa-solid fa-star"></i>
            <span class="menu-text">Évaluations</span>
        </a>
    </li>
</ul>
<hr>
<ul class="nav flex-column mt-auto">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('prof.settings') ? 'active' : '' }}" href="{{ route('prof.settings') }}">
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
