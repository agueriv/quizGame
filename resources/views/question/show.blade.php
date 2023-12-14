@extends('base.backlayout')

@include('modal.deleteQuestionModal')

@section('breadcrumbs')
<ul class="d-flex align-items-center mb-0" >
  <li class="m-1"><a href="{{ url('back') }}">Dashboard</a></li>
  <li class="m-1"><i class="fa-solid fa-angle-right" style="font-size: .7rem;"></i></li>
  <li class="m-1"><a href="{{ url('back/question') }}">Question list</a></li>
  <li class="m-1"><i class="fa-solid fa-angle-right" style="font-size: .7rem;"></i></li>
  <li class="m-1"><a href="#">Question detail</a></li>
</ul>
@endsection

@section('maincontent')

<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-8">
                        <h5 class="card-title fw-semibold mb-4 text-center">QUESTION BODY</h5>
                        <div class="card">
                            <div class="card-body justify-content-center">
                                <h5 class="card-title text-center">{{ $question->name }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row justify-content-center mb-5">
                    <h5 class="card-title fw-semibold mb-4 text-center">QUESTION ANSWERS</h5>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <span class="d-flex align-items-center">Answer 1
                                @if(sizeof($answers) >= 1 && $answers[0]->escorrecta == 1)
                                    <img style="margin-left: .5rem;"
                                    src="{{ url('assets/images/check.svg') }}" alt="" width="20px">
                                @endif
                                </span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">@if(sizeof($answers) >= 1){{ $answers[0]->name }}@endif</h5>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <span class="d-flex align-items-center">Answer 2
                                @if(sizeof($answers) >= 2 && $answers[1]->escorrecta == 1)
                                    <img style="margin-left: .5rem;"
                                    src="{{ url('assets/images/check.svg') }}" alt="" width="20px">
                                @endif
                                </span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">@if(sizeof($answers) >= 2){{ $answers[1]->name }}@endif</h5>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <span class="d-flex align-items-center">Answer 4
                                @if(sizeof($answers) >= 3 && $answers[2]->escorrecta == 1)
                                    <img style="margin-left: .5rem;"
                                    src="{{ url('assets/images/check.svg') }}" alt="" width="20px">
                                @endif
                                </span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">@if(sizeof($answers) >= 3){{ $answers[2]->name }}@endif</h5>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <span class="d-flex align-items-center">Answer 4
                                @if(sizeof($answers) >= 4 && $answers[3]->escorrecta == 1)
                                    <img style="margin-left: .5rem;"
                                    src="{{ url('assets/images/check.svg') }}" alt="" width="20px">
                                @endif
                                </span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">@if(sizeof($answers) >= 4){{ $answers[3]->name }}@endif</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ url('back/question/' . $question->id . '/edit') }}" type="button" class="btn btn-outline-primary m-1">Edit</a>
                <button data-url="{{ url('back/question/' . $question->id) }}" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteQuestionModal">
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
        const deleteMotoModal = document.getElementById('deleteQuestionModal');
        const formDelete = document.getElementById('formDelete');
        
        deleteMotoModal.addEventListener('show.bs.modal', event => {
          let url = event.relatedTarget.dataset.url;
          formDelete.action = url;
        });
    </script>
@endsection

@endsection