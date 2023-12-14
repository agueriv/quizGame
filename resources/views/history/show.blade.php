@extends('base.backlayout')

@include('modal.deleteHistoryModal')

@section('breadcrumbs')
<ul class="d-flex align-items-center mb-0" >
  <li class="m-1"><a href="{{ url('back') }}">Dashboard</a></li>
  <li class="m-1"><i class="fa-solid fa-angle-right" style="font-size: .7rem;"></i></li>
  <li class="m-1"><a href="{{ url('back/history') }}">History</a></li>
  <li class="m-1"><i class="fa-solid fa-angle-right" style="font-size: .7rem;"></i></li>
  <li class="m-1"><a href="#">History entry detail</a></li>
</ul>
@endsection

@section('maincontent')

<div class="container-fluid">
    <div class="container-fluid justify-content-center">
        <div class="card justify-content-center">
            <div class="card-body justify-content-center">
                <div class="row justify-content-center mb-5 mt-3">
                    <div class="col-md-8">
                        <h5 class="card-title fw-semibold mb-4 text-center">ALIAS</h5>
                        <div class="card">
                            <div class="card-body justify-content-center">
                                <h5 class="card-title text-center">{{ $history->alias }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="row justify-content-center mb-4 col-lg-6">
                        <div>
                            <h5 class="card-title fw-semibold mb-4 text-center">QUESTION</h5>
                            <div class="card">
                                <div class="card-body justify-content-center">
                                    <h5 class="card-title text-center">{{ $history->question->name }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-4 col-lg-6">
                        <h5 class="card-title fw-semibold mb-4 text-center">ANSWER</h5>
                        <div>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-center">{{ $history->answer->name }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mb-5">
                    <div class="col-md-5">
                        <h5 class="card-title fw-semibold mb-4 text-center">STATUS</h5>
                        <div class="card">
                            <div class="card-body justify-content-center">
                                <h5 class="card-title text-center">{{ $history->escorrecta === 1 ? 'Correctly answered' : 'Answered incorrectly' }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ url('back/history/' . $history->id . '/edit') }}" type="button" class="btn btn-outline-primary m-1">Edit</a>
                <button data-url="{{ url('back/history/' . $history->id) }}" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteHistoryModal">
                    Delete
                </button>
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