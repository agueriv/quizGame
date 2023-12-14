@extends('base.backlayout')

@include('modal.deleteQuestionModal')

@section('breadcrumbs')
<ul class="d-flex align-items-center mb-0" >
  <li class="m-1"><a href="{{ url('back') }}">Dashboard</a></li>
  <li class="m-1"><i class="fa-solid fa-angle-right" style="font-size: .7rem;"></i></li>
  <li class="m-1"><a href="{{ url('back/question') }}">Question list</a></li>
  <li class="m-1"><i class="fa-solid fa-angle-right" style="font-size: .7rem;"></i></li>
  <li class="m-1"><a href="#">Edit question</a></li>
</ul>
@endsection

@section('maincontent')

<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Edit question</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('back/question/'. $question->id) }}" method="post">
                            @csrf
                            @method('put')
                            <h6 class="card-title fw-medium mb-4" style="color: #4F73D9;">Question properties</h6>
                            <div class="mb-5">
                                <label for="name" class="form-label">Question name*</label>
                                <input type="text" class="form-control" id="name" name="name" maxlength="150" required value="{{ old('name', $question->name) }}">
                                @error('name')
                                    <p style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                @enderror
                            </div>
                            <h6 class="card-title fw-medium mb-4" style="color: #4F73D9;">Question answers</h6>
                            <div class="row mb-3">
                                <div class="mb-3 col-lg-6">
                                    <label for="firstanswer" class="form-label">Answer 1*</label>
                                    <input type="text" class="form-control mb-2" id="firstanswer" name="firstanswer" maxlength="200"
                                    required value="@if(sizeof($answers) >= 1){{ old('firstanswer', $answers[0]->name) }}@endif">
                                    @error('firstanswer')
                                        <p style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                    @enderror
                                    <span>Is correct? <input style="margin-left: .5rem;" class="form-check-input" type="radio"
                                    name="correctanswer" id="correctanswer1" value="1" 
                                    @if(sizeof($answers) >= 1)
                                    {{ $answers[0]->escorrecta === 1 ? 'checked' : '' }}
                                    @endif
                                    ></span>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="secondanswer" class="form-label">Answer 2*</label>
                                    <input type="text" class="form-control mb-2" id="secondanswer" name="secondanswer" maxlength="200"
                                    required value="@if(sizeof($answers) >= 2){{ old('secondanswer', $answers[1]->name) }}@endif">
                                    @error('secondanswer')
                                        <p style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                    @enderror
                                    <span>Is correct? <input style="margin-left: .5rem;" class="form-check-input" type="radio"
                                    name="correctanswer" id="correctanswer2" value="2" 
                                    @if(sizeof($answers) >= 2)
                                    {{ $answers[1]->escorrecta === 1 ? 'checked' : '' }}
                                    @endif
                                    ></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="thirdanswer" class="form-label">Answer 3*</label>
                                    <input type="text" class="form-control mb-2" id="thirdanswer" name="thirdanswer" maxlength="200"
                                    required value="@if(sizeof($answers) >= 3){{ old('thirdanswer', $answers[2]->name) }}@endif">
                                    @error('thirdanswer')
                                        <p style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                    @enderror
                                    <span>Is correct? <input style="margin-left: .5rem;" class="form-check-input" type="radio"
                                    name="correctanswer" id="correctanswer3" value="3" 
                                    @if(sizeof($answers) >= 3)
                                    {{ $answers[2]->escorrecta === 1 ? 'checked' : '' }}
                                    @endif
                                    ></span>
                                </div>
                                <div class="mb-5 col-lg-6">
                                    <label for="fourthanswer" class="form-label">Answer 4*</label>
                                    <input type="text" class="form-control mb-2" id="fourthanswer" name="fourthanswer" maxlength="200"
                                    required  value="@if(sizeof($answers) >= 4){{ old('fourthanswer', $answers[3]->name) }}@endif">
                                    @error('fourthanswer')
                                        <p style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                    @enderror
                                    <span>Is correct? <input style="margin-left: .5rem;" class="form-check-input" type="radio"
                                    name="correctanswer" id="correctanswer4" value="4" 
                                    @if(sizeof($answers) >= 4)
                                    {{ $answers[3]->escorrecta === 1 ? 'checked' : '' }}
                                    @endif
                                    ></span>
                                </div>
                            </div>
                            @error('correctanswer')
                                <p style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                            @enderror
                            <button type="submit" class="btn btn-primary">Update question</button>
                            <button data-url="{{ url('back/question/' . $question->id) }}" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteQuestionModal">
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
        const deleteMotoModal = document.getElementById('deleteQuestionModal');
        const formDelete = document.getElementById('formDelete');
        
        deleteMotoModal.addEventListener('show.bs.modal', event => {
          let url = event.relatedTarget.dataset.url;
          formDelete.action = url;
        });
    </script>
@endsection

@endsection