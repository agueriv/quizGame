@extends('base.backlayout')

@include('modal.deleteAdminModal')

@section('breadcrumbs')
<ul class="d-flex align-items-center mb-0" >
  <li class="m-1"><a href="{{ url('back') }}">Dashboard</a></li>
  <li class="m-1"><i class="fa-solid fa-angle-right" style="font-size: .7rem;"></i></li>
  <li class="m-1"><a href="#">Admin list</a></li>
</ul>
@endsection

@section('maincontent')
<div class="container-fluid">
    <div class="container-fluid">
        <h3 class="fw-semibold mb-5">ADMINS REGISTERED</h3>
        <div class="row">
            @foreach($admins as $admin)
                <div class="col-sm-6 col-xl-3">
                    <div class="card overflow-hidden rounded-2">
                        <div class="position-relative">
                            <a href="{{ url('back/admin/' . $admin->id ) }}">
                                @if($admin->photo != null)
                                    <img src="data:image/jpeg;base64,{{ $admin->photo }}" class="card-img-top rounded-0"
                                alt="..." style="aspect-ratio: 1 / 1">
                                    @else
                                     <img src="{{ url('assets/images/profile/no-photo.svg') }}" class="card-img-top rounded-0"
                                    alt="..." style="aspect-ratio: 1 / 1">
                                @endif
                            </a>
                        </div>
                        <div class="card-body pt-3 p-4">
                            <h6 class="fw-semibold fs-4 text-center mb-3 text-capitalize">{{ $admin->username }}</h6>
                            <a href="{{ url('back/admin/' . $admin->id ) }}" class="btn btn-outline-primary">View</a>
                            <a href="{{ url('back/admin/' . $admin->id . '/edit') }}" class="btn btn-outline-warning">Edit</a>
                            <button data-url="{{ url('back/admin/' . $admin->id) }}" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAdminModal">
                                    Delete
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
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