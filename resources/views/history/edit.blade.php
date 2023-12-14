@extends('base.backlayout')

@include('modal.deleteHistoryModal')

@section('breadcrumbs')
<ul class="d-flex align-items-center mb-0" >
  <li class="m-1"><a href="{{ url('back') }}">Dashboard</a></li>
  <li class="m-1"><i class="fa-solid fa-angle-right" style="font-size: .7rem;"></i></li>
  <li class="m-1"><a href="{{ url('back/history') }}">History</a></li>
  <li class="m-1"><i class="fa-solid fa-angle-right" style="font-size: .7rem;"></i></li>
  <li class="m-1"><a href="#">Edit history entry</a></li>
</ul>
@endsection

@section('maincontent')

<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Edit history entry</h5>
              <div class="card">
                <div class="card-body">
                  <form action="{{ url('back/history/'. $history->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="row mb-4">
                      <div class="row col-md-6">
                        <h4 class="card-title fw-medium mb-2" style="color: #4F73D9;">Question</h4>
                        <h6 class="fw-medium mb-4">{{ $history->question->name }}</h6>
                      </div>
                      <div class="row col-md-6">
                        <h4 class="card-title fw-medium mb-2" style="color: #4F73D9;">Answer</h4>
                        <h6 class="fw-medium mb-4">{{ $history->answer->name }}</h6>
                      </div>
                    </div>
                    <div class="row mb-4 justify-content-between">
                      <div class="mb-3 col-lg-4">
                        <label for="alias" class="form-label card-title fw-medium mb-2" style="color: #4F73D9;">Alias*</label>
                        <input type="text" class="form-control mb-2" id="alias" name="alias" maxlength="100" required value="{{ old('alias', $history->alias) }}">
                        @error('alias')
                            <p style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                        @enderror
                      </div>
                      <div class="mb-5 col-lg-6">
                        <label for="" class="form-label card-title fw-medium mb-2 d-block" style="color: #4F73D9;">Correctly answered?</label>
                        <label for="escorrecta1">Yes</label>
                        <input style="margin-left: .5rem;" class="form-check-input" type="radio" name="escorrecta"
                          id="escorrecta1" value="1" {{ ($history->escorrecta == 1) ? 'checked' : ''}}>
                        <label for="escorrecta2" style="margin-left: 1rem">No</label>
                        <input style="margin-left: .5rem;" class="form-check-input" type="radio" name="escorrecta"
                          id="escorrecta2" value="0" {{ ($history->escorrecta == 0) ? 'checked' : ''}}>
                          @error('escorrecta')
                            <p style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                          @enderror
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update history entry</button>
                    <button data-url="{{ url('back/history/' . $history->id) }}" type="button" class="btn btn-danger"
                      data-bs-toggle="modal" data-bs-target="#deleteHistoryModal">
                      Delete
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
        const deleteMotoModal = document.getElementById('deleteHistoryModal');
        const formDelete = document.getElementById('formDelete');
        
        deleteMotoModal.addEventListener('show.bs.modal', event => {
          let url = event.relatedTarget.dataset.url;
          formDelete.action = url;
        });
    </script>
@endsection
@endsection