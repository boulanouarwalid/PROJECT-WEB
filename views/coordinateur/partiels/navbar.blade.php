<nav class="navbar navbar-expand-lg  ">
    <div class="container-fluid">
      <div class="row align-items-center w-100">
        <!-- Left Section (Logo/Menu) -->
        <div class="col-md-4 col-lg-3 d-flex align-items-center">
            <i id="sidebarToggle" class="bi bi-layout-sidebar fs-3 mx-2 text-dark" style="cursor: pointer"></i>             
                <h4 class="px-4 text-dark m-0">AcademiQ</h4>
        </div>
        
        <!-- Search Section (25%) -->
        <div class="col-md- col-lg-4 px-0">
          <form class="d-flex w-100" action="#">
            <div class="input-group">
              <input type="search" class="form-control" placeholder="Rechercher...">
              <button class="btn-search" type="submit">
                <i class="bi bi-search fs-4 text-dark text-center mx-3"></i>
              </button>
            </div>
          </form>
        </div>
        
        
        <div class="col-md-4 col-lg-5 d-flex justify-content-end ">
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
        
      
          <!-- Profile Dropdown -->
          @auth
          <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="{{ asset('images/prldft.jpg')}}" alt="Photo profil" width="32" height="32" class="rounded-circle me-2 mt-1 ">
              <span class="d-none d-lg-inline">My profil</span>
              <i class='bx bxs-down-arrow ms-1'></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
              <li>
                <div class="dropdown-item d-flex align-items-center">
                  <img src="{{ asset('images/prldft.jpg')}}" alt="Photo profil" width="40" height="40" class="rounded-circle me-2">
                  <div>
                    <p class="mb-0 fw-bold">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</p>
                  </div>
                </div>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
                  <div>
                    <i class="bi bi-gear-fill mx-2 "></i>
                    Settings
                  </div>
                  <span class="m-3 ">></span>
                </a>
              </li>
              <li>
                <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
                  <div>
                    <i class="bi bi-pencil-square mx-2 "></i>
                    Edit Profile
                  </div>
                  <span class="m-3 ">></span>
                </a>
              </li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item d-flex justify-content-between align-items-center w-100 bg-transparent border-0">
                        <div>
                            <i class="bi bi-box-arrow-right mx-2"></i>
                            Log Out
                        </div>
                        <span class="m-3">></span>
                    </button>
                </form>
            </li>
            </ul>
          </div>
          @endauth
          
        </div>
      </div>
    </div>
  </nav>
