<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('vacataire.dashboard') ? 'active' : '' }}" href="{{ route('vacataire.dashboard') }}">
            <i class="bx bxs-dashboard"></i>
            <span class="menu-text">Tableau de bord</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('vacataire.modules.*') ? 'active' : '' }}" href="{{ route('vacataire.modules.index') }}">
            <i class="fa-solid fa-book-open"></i>
            <span class="menu-text">Mes Modules</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('vacataire.charge-horaire.*') ? 'active' : '' }}" href="{{ route('vacataire.charge-horaire.index') }}">
            <i class="fa-solid fa-clock"></i>
            <span class="menu-text">Charge Horaire</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('vacataire.emploi-temps.*') ? 'active' : '' }}" href="{{ route('vacataire.emploi-temps.index') }}">
            <i class="fa-solid fa-calendar-days"></i>
            <span class="menu-text">Emploi du Temps</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('vacataire.notes.*') ? 'active' : '' }}" href="{{ route('vacataire.notes.index') }}">
            <i class="fa-solid fa-clipboard-list"></i>
            <span class="menu-text">Saisie Notes</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('vacataire.disponibilites.*') ? 'active' : '' }}" href="{{ route('vacataire.disponibilites.index') }}">
            <i class="fa-solid fa-calendar-check"></i>
            <span class="menu-text">Disponibilités</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('vacataire.contrats.*') ? 'active' : '' }}" href="{{ route('vacataire.contrats.index') }}">
            <i class="fa-solid fa-file-contract"></i>
            <span class="menu-text">Contrats</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('vacataire.paiements.*') ? 'active' : '' }}" href="{{ route('vacataire.paiements.index') }}">
            <i class="fa-solid fa-money-bill"></i>
            <span class="menu-text">Paiements</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('vacataire.documents.*') ? 'active' : '' }}" href="{{ route('vacataire.documents.index') }}">
            <i class="fa-solid fa-file-pdf"></i>
            <span class="menu-text">Documents</span>
        </a>
    </li>
</ul>
<hr>
<ul class="nav flex-column mt-auto">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('vacataire.settings') ? 'active' : '' }}" href="{{ route('vacataire.settings') }}">
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
