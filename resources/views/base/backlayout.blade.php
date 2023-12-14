<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Quiz - Admin Area</title>
  <link rel="shortcut icon" type="image/png" href="{{ url('assets/images/logos/favicon.png') }}" />
  <link rel="stylesheet" href="{{ url('assets/css/styles.min.css') }}" />
  <script src="https://kit.fontawesome.com/4ae3aa05b7.js" crossorigin="anonymous"></script>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="{{ url('back') }}" class="text-nowrap logo-img">
            <img src="{{ url('assets/images/logos/logoQuiz.png') }}" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('back') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Questions</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('back/question') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Questions list</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('back/question/create') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-circle-plus"></i>
                </span>
                <span class="hide-menu">Add question</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Answers</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('back/answer') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Answers list</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('back/answer/create') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-circle-plus"></i>
                </span>
                <span class="hide-menu">Create answer</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">History</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('back/history') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-eye"></i>
                </span>
                <span class="hide-menu">View history</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Admins</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('back/admin') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Admins list</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('back/admin/create') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-circle-plus"></i>
                </span>
                <span class="hide-menu">Register new admin</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light" >
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0 align-items-center row" id="navbarNav">
            <div class="d-flex align-items-center align-content-center" style="width: auto !important">
              @yield('breadcrumbs')
            </div>
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end"style="width: auto !important">
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="
                  @if(session('userPhoto'))
                    data:image/jpeg;base64,{{ session('userPhoto', 'none') }}
                    @else
                    {{url('assets/images/profile/no-photo.svg')}}
                  @endif
                  " alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <h6 class="card-title text-center" style="margin-top: .4rem">{{ session('userSesion', 'noname') }}</h6>
                    <a href="{{ url(session('urlUserSesion', 'back/admin')) }}" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">Profile</p>
                    </a>
                    <a href="{{ url('/') }}" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-external-link fs-6"></i>
                      <p class="mb-0 fs-3">Go frontend</p>
                    </a>
                    <form action="{{ url('back/logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</button>
                    </form>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      
      @if(session('message'))
          <div class="container-fluid">
              <div class="alert alert-success" role="alert">
                {{ session('message') }}
              </div>
          </div>
      @endif
      
      <!-- para mostrar el mensaje de error-->
    
      @if($errors->any())
          <div class="container-fluid">
            <div class="alert alert-danger" role="alert">
              {{ $errors->first()}}
            </div>
          </div>
      @endif
      
      @yield('maincontent')
      <div class="py-6 px-6 text-center">
        <p class="mb-0 fs-4">Developed by <a href="https://arielguerrero.es/" target="_blank"
            class="pe-1 text-primary text-decoration-underline">Ariel Guerrero</a></p>
      </div>
    </div>
  </div>
  <script src="{{ url('assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ url('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ url('assets/js/sidebarmenu.js') }}"></script>
  <script src="{{ url('assets/js/app.min.js') }}"></script>
  <script src="{{ url('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
  <script src="{{ url('assets/libs/simplebar/dist/simplebar.js') }}"></script>
  <script src="{{ url('assets/js/dashboard.js') }}"></script>
  
  @yield('scripts')
</body>

</html>