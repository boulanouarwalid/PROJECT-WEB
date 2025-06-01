<div class="col-md-3 col-lg-2 d-md-block sidebar collapse p-0" id="sidebar">
    <div class="position-sticky pt-3 mx-3">
        <div class="text-center p-4 ">
            <div class="logo-container">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="logo">
                <span class="short-title d-none "></span>
            </div>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('prof/dash') ? 'active' : '' }}" 
                   href="{{ route('prof.dash') }}">
                    <i class="bi bi-speedometer2"></i> 
                    <span class="menu-text">Tableau de bord</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('prof/ues*') ? 'active' : '' }}" 
                   href="{{ route('prof.ues') }}">
                    <i class="bi bi-book"></i>
                    <span class="menu-text">Unités d'Enseignement</span> 
                </a>
            </li>
           <li class="nav-item">
                <a class="nav-link {{ request()->is('prof/charge*') ? 'active' : '' }}" 
                href="{{ route('prof.chargehoraire') }}">  <!-- Changed to charge-horaire -->
                    <i class="bi bi-calculator"></i> 
                    <span class="menu-text">Charge Horaire</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('prof/modules*') ? 'active' : '' }}" 
                   href="{{ route('prof.modules') }}">
                    <i class="bi bi-list-check"></i>
                    <span class="menu-text">Mes Modules</span>  
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('prof/notes*') ? 'active' : '' }}" 
                   href="{{ route('prof.notes') }}">
                    <i class="bi bi-journal-text"></i> 
                    <span class="menu-text">Gestion des Notes</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('prof/historique*') ? 'active' : '' }}" 
                   href="{{ route('prof.historique') }}">
                    <i class="bi bi-clock-history"></i> 
                    <span class="menu-text">Historique</span> 
                </a>
            </li>
        </ul>
    </div>
</div>