@extends('base.backlayout')

@section('breadcrumbs')
<ul class="d-flex align-items-center mb-0" >
  <li class="m-1"><a href="{{ url('back') }}">Dashboard</a></li>
  <li class="m-1"><i class="fa-solid fa-angle-right" style="font-size: .7rem;"></i></li>
  <li class="m-1"><a href="#">Create answer</a></li>
</ul>
@endsection

@section('maincontent')

<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Create a new answer</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('back/answer') }}" method="post">
                            @csrf
                            <h6 class="card-title fw-medium mb-4" style="color: #4F73D9;">Question properties</h6>
                            <div class="mb-5">
                                <label for="idquestion" class="form-label">Question asociated*</label>
                                <select class="form-select" id="idquestion" name="idquestion" aria-label="Question asociated" required value="{{old('idquestion')}}">
                                <option selected>Select one</option>
                                @foreach($questions as $question)
                                    @if(old('idquestion') == $question->id)
                                        <option value="{{$question->id}}" selected>{{$question->name}}</option>
                                    @else
                                        <option value="{{$question->id}}">{{$question->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('idquestion')
                                <p style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                            @enderror
                            </div>
                            <h6 class="card-title fw-medium mb-4" style="color: #4F73D9;">Answer properties</h6>
                            <div class="row mb-3">
                                <div class="mb-3 col-lg-12">
                                    <label for="name" class="form-label">Answer name*</label>
                                    <input type="text" class="form-control mb-2" id="name" name="name" maxlength="200"
                                    required value="{{ old('name') }}">
                                    @error('name')
                                        <p style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                    @enderror
                                    <p>Is correct?</p>
                                    <span>Yes <input style="margin-left: .5rem;" class="form-check-input" type="radio"
                                    name="escorrecta" id="correctanswer1" value="1" required></span>
                                    <span style="margin-left: 1rem">No <input style="margin-left: .5rem;" class="form-check-input" type="radio"
                                    name="escorrecta" id="correctanswer2" value="0" required checked></span>
                                    @error('escorrecta')
                                        <p style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Create answer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection