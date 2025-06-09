<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <div class="row align-items-center w-100">
            <!-- Left Section (Logo/Menu) -->
            <div class="col-md-4 col-lg-3 d-flex align-items-center">
                <i id="sidebarToggle" class="bi bi-layout-sidebar fs-3 mx-2 text-dark" style="cursor: pointer"></i>
                <h4 class="px-4 text-dark m-0">AcademiQ</h4>
            </div>
            <!-- Search Section -->
            <div class="col-md-4 col-lg-4 px-0">
                <form class="d-flex w-100" action="#">
                    <div class="input-group">
                        <input type="search" class="form-control" placeholder="Rechercher...">
                        <button class="btn-search" type="submit">
                            <i class="bi bi-search fs-4 text-dark text-center mx-3"></i>
                        </button>
                    </div>
                </form>
            </div>
            <!-- Right Section -->
            <div class="col-md-4 col-lg-5 d-flex justify-content-end align-items-center">
                <!-- Notification -->
                <div class="position-relative rounded-circle d-flex align-items-center justify-content-center me-3">
                    <a href="#" class="text-dark">
                        <i class="bi bi-bell-fill fs-5"></i>
                    </a>
                </div>
                <!-- Theme Switch -->
                <button id="theme-switch" aria-label="Toggle dark mode" class="btn btn-link text-dark me-5">
                    <i class="bi bi-moon-fill fs-5" aria-hidden="true"></i>
                    <i class="bi bi-sun-fill fs-5 d-none" aria-hidden="true"></i>
                </button>
                <!-- User Profile Dropdown -->
                @auth
                <div class="dropdown-dash">
                    <a class="dropdown-toggle-dash" href="#" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-profile-dash">
                            <img src="{{ asset('assets/images/profil_img.jpg')}}" alt="Profile" class="user-avatar-dash">
                            <div class="user-info-dash d-none d-lg-flex">
                                <span class="user-name-dash">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</span>
                                <span class="user-role-dash">{{ Auth::user()->role }}</span>
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
    </div>
</nav>
<style>
/* User Profile Dropdown */
.dropdown-dash {
    position: relative;
}
.user-profile-dash {
    display: flex;
    align-items: center;
    gap: 0.8rem;
    padding: 0.5rem;
    border-radius: 50px;
    transition: all 0.2s ease;
    cursor: pointer;
}
.user-profile-dash:hover {
    background-color: rgba(97, 4, 247, 0.08);
}
.user-avatar-dash {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid rgba(97, 4, 247, 0.1);
}
.user-info-dash {
    display: flex;
    flex-direction: column;
    line-height: 1.3;
}
.user-name-dash {
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--dark, #222);
}
.user-role-dash {
    font-size: 0.75rem;
    color: var(--dark-grey, #888);
}
.dropdown-menu {
    position: absolute;
    right: 0;
    top: 100%;
    margin-top: 0.5rem;
    min-width: 250px;
    background-color: var(--white, #fff);
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    padding: 0.5rem;
    z-index: 1000;
}
.dropdown-header {
    padding: 0.75rem 1rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}
.dropdown-header img {
    width: 48px;
    height: 48px;
    object-fit: cover;
    border-radius: 50%;
}
.dropdown-header h6 {
    margin-bottom: 0.25rem;
    font-size: 0.95rem;
    color: var(--dark, #222);
}
.dropdown-header small {
    color: var(--dark-grey, #888);
    font-size: 0.8rem;
}
.dropdown-item {
    padding: 0.5rem 1rem;
    border-radius: 6px;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    transition: all 0.2s ease;
    color: var(--dark, #222);
    text-decoration: none;
    cursor: pointer;
}
.dropdown-item:hover {
    background-color: rgba(97, 4, 247, 0.08);
    color: var(--blue, #6104F7);
}
.dropdown-icon {
    width: 20px;
    text-align: center;
}
.dropdown-divider {
    margin: 0.5rem 0;
    border: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
}
.dropdown-footer {
    padding: 0.5rem 1rem;
    font-size: 0.75rem;
    color: var(--dark-grey, #888);
    text-align: center;
}
</style>
