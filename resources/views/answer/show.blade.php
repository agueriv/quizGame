@extends('base.backlayout')

@include('modal.deleteAnswerModal')

@section('breadcrumbs')
<ul class="d-flex align-items-center mb-0" >
  <li class="m-1"><a href="{{ url('back') }}">Dashboard</a></li>
  <li class="m-1"><i class="fa-solid fa-angle-right" style="font-size: .7rem;"></i></li>
  <li class="m-1"><a href="{{ url('back/answer') }}">Answer list</a></li>
  <li class="m-1"><i class="fa-solid fa-angle-right" style="font-size: .7rem;"></i></li>
  <li class="m-1"><a href="#">Answer detail</a></li>
</ul>
@endsection

@section('maincontent')

<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-center mb-5 mt-4">
                    <h5 class="card-title fw-semibold mb-4 text-center">ANSWER</h5>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ $answer->name }}
                                @if($answer->escorrecta == 1)
                                    <img style="margin-left: .5rem;"
                                    src="{{ url('assets/images/check.svg') }}" alt="" width="20px">
                                    @else
                                    <img style="margin-left: .5rem;"
                                    src="{{ url('assets/images/incorrect.svg') }}" alt="" width="20px">
                                @endif
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-8">
                        <h5 class="card-title fw-semibold mb-4 text-center">QUESTION ASOCIATED</h5>
                        <div class="card">
                            <div class="card-body justify-content-center">
                                <h5 class="card-title text-center">{{ $answer->question->name }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <a href="{{ url('back/answer/' . $answer->id . '/edit') }}" type="button" class="btn btn-outline-primary m-1">Edit</a>
                <button data-url="{{ url('back/answer/' . $answer->id) }}" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAnswerModal">
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
        const deleteMotoModal = document.getElementById('deleteAnswerModal');
        const formDelete = document.getElementById('formDelete');
        
        deleteMotoModal.addEventListener('show.bs.modal', event => {
          let url = event.relatedTarget.dataset.url;
          formDelete.action = url;
        });
    </script>
@endsection
@endsection