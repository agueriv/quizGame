@extends('base.backlayout')
@include('modal.deleteAdminModal')
@section('breadcrumbs')
<ul class="d-flex align-items-center mb-0" >
  <li class="m-1"><a href="{{ url('back') }}">Dashboard</a></li>
  <li class="m-1"><i class="fa-solid fa-angle-right" style="font-size: .7rem;"></i></li>
  <li class="m-1"><a href="{{ url('back/admin') }}">Admin list</a></li>
  <li class="m-1"><i class="fa-solid fa-angle-right" style="font-size: .7rem;"></i></li>
  <li class="m-1"><a href="#">Edit admin</a></li>
</ul>
@endsection
@section('maincontent')

<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Edit admin '{{ $admin->username }}'</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('back/admin/' . $admin->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="username" class="form-label">Username*</label>
                                <input type="text" class="form-control" id="username" name="username" maxlength="100" required value="{{ old('username', $admin->username) }}">
                                @error('username')
                                    <p style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password*</label>
                                <input type="password" class="form-control" id="password" name="password" maxlength="50" required value="{{ old('password', $admin->password) }}">
                                @error('password')
                                    <p style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Password confirmation*</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" maxlength="50" required value="{{ old('password', $admin->password) }}">
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label">Profile photo</label>
                                <input type="file" class="form-control" id="photo" name="photo" value="{{ old('photo') }}">
                                @error('photo')
                                    <p style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update admin</button>
                            <button data-url="{{ url('back/admin/' . $admin->id) }}" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAdminModal">
                                    Delete admin
                            </button>
                        </form>
                    </div>
                </div>
            </div>
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