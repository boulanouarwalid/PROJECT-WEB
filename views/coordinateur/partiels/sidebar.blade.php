<div class="col-md-3 col-lg-2 d-md-block sidebar collapse p-0" id="sidebar">
    <div class="position-sticky pt-3 mx-3">
        <div class="text-center p-4 ">
            <div class="logo-container">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="logo">
                <span class="short-title d-none "></span>
            </div>
        </div>
        <ul class="nav  flex-column">
            <li class="nav-item">
                
                <a class="nav-link {{ request()->is('coordinateur/dash') ? 'active' : '' }}" 
               href="{{ route('coordinateur.dash') }}">
                    <i class="bi bi-speedometer2"></i> 
                    <span class="menu-text">Tableau de bord</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link   {{ request()->is('coordinateur/ues*') ? 'active' : '' }}" 
               href="{{ route('coordinateur.ues.index') }}">
                    <i class="bi bi-book"></i>
                    <span class="menu-text">Unités d'Enseignement</span> 
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('coordinateur/vacataire/create*') ? 'active' : '' }}"  href="{{ route('coordinateur.cva') }}">
                    <i class="bi bi-person-plus"></i> 
                    <span class="menu-text"> Création Comptes</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->is('coordinateur/historique*') ? 'active' : '' }}" href="{{ route('coordinateur.historique') }}">
                    <i class="bi bi-clock-history"></i> 
                    <span class="menu-text">Consulter l’historique des années passées des ues</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('coordinateur/ie*') ? 'active' : '' }}"  href="{{ route('coordinateur.ie') }}">
                    <i class="bi bi-file-earmark-excel"></i> 
                    <span class="menu-text">Import/Export</span> 
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link  {{ request()->is('coordinateur/et*') ? 'active' : '' }}" 
               href="{{ route('coordinateur.et') }}">
                    <i class="bi bi-calendar-week"></i> 
                    <span class="menu-text">Emplois du Temps</span> 
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('coordinateur/notes/pending*') ? 'active' : '' }}" href="{{ route('coordinateur.notes.pending') }}">
                    <i class="bi bi-clipboard-check"></i>
                    <span class="menu-text">Notes à valider</span>
                </a>
            </li>

        </ul>
    </div>
</div>