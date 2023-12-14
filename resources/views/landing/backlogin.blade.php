<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Quiz | Login</title>
  <link rel="shortcut icon" type="image/png" href="{{ url('assets/images/logos/favicon.png') }}" />
  <link rel="stylesheet" href="{{ url('assets/css/styles.min.css') }}" />
  <script src="https://kit.fontawesome.com/4ae3aa05b7.js" crossorigin="anonymous"></script>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="{{ url('assets/images/logos/logoQuiz.png') }}" width="180" alt="">
                </a>
                <p class="text-center">Welcome to admin area</p>
                @if(session('userDeleted'))
                <h6 class="text-center" style="color: #c62828">{{ session('userDeleted') }}</h6>
                @endif
                <form action="{{ url('back/login') }}" method="post">
                    @csrf
                  <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username" aria-describedby="username">
                  </div>
                  <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                  </div>
                  @if(session('badlogin'))
                    <p style="color: #c62828; font-size: .9rem">{{session('badlogin')}}</p>
                  @endif
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-2 rounded-2">Sign In</button>
                </form>
              </div>
              <div class="row mt-2 mb-4">
                <a class="text-center" href="{{ url('') }}"><i class="fa-solid fa-angle-left" style="margin-right: .4rem"></i>Go frontend</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ url('assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ url('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>