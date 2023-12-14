@extends('base.backlayout')
@include('modal.deleteAdminModal')
@section('breadcrumbs')
<ul class="d-flex align-items-center mb-0" >
  <li class="m-1"><a href="{{ url('back') }}">Dashboard</a></li>
  <li class="m-1"><i class="fa-solid fa-angle-right" style="font-size: .7rem;"></i></li>
  <li class="m-1"><a href="{{ url('back/admin') }}">Admin list</a></li>
  <li class="m-1"><i class="fa-solid fa-angle-right" style="font-size: .7rem;"></i></li>
  <li class="m-1"><a href="#">Admin detail</a></li>
</ul>
@endsection
@section('maincontent')
<div class="container-fluid align-items-center">
    <h3 class="fw-semibold mb-5">ADMIN PROFILE</h3>
    <div class="row align-items-center">
          <div class="col-lg-4 d-flex align-items-strech">
            <div class="card overflow-hidden rounded-2">
              <div class="position-relative">
                @if($admin->photo != null)
                        <img src="data:image/jpeg;base64,{{ $admin->photo }}" class="card-img-top rounded-5"
                        alt="..." style="aspect-ratio: 1 / 1">
                    @else
                         <img src="{{ url('assets/images/profile/no-photo.svg') }}" class="card-img-top rounded-5"
                        alt="..." style="aspect-ratio: 1 / 1">
                @endif
              </div>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="col-lg-12">
              <!-- Yearly Breakup -->
              <div class="card overflow-hidden">
                <div class="card-body p-4">
                  <h4 class="mb-3 fw-semibold">USERNAME</h4>
                  <div class="row align-items-start">
                    <p class="fw-semibold mb-4">{{ $admin->username }}</p>
                  </div>
                  <h4 class="mb-3 fw-semibold">PASSWORD</h4>
                  <div class="row align-items-start">
                      <?php
                        $arr = str_split($admin->password);
                        $pass = '';
                        foreach($arr as $carac) {
                            $pass .= '*';
                        }
                      ?>
                    <p class="fw-semibold mb-4">{{ $pass }}</p>
                  </div>
                </div>
              </div>
            </div>
            <a href="{{ url('back/admin/' . $admin->id . '/edit') }}" class="btn btn-outline-warning">Edit profile</a>
            <button data-url="{{ url('back/admin/' . $admin->id) }}" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAdminModal">
                    Delete admin
            </button>
          </div>
        </div>
</div>

<form id="formDelete" name="formDelete" action="{{ url('') }}" method="post">
    @csrf
    @method('delete')
</form>

@section('scripts')
    <script>
        const deleteMotoModal = document.getElementById('deleteAdminModal');
        const formDelete = document.getElementById('formDelete');
        
        deleteMotoModal.addEventListener('show.bs.modal', event => {
          let url = event.relatedTarget.dataset.url;
          formDelete.action = url;
        });
    </script>
@endsection
@endsection