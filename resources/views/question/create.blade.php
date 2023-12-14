@extends('base.backlayout')

@section('breadcrumbs')
<ul class="d-flex align-items-center mb-0" >
  <li class="m-1"><a href="{{ url('back') }}">Dashboard</a></li>
  <li class="m-1"><i class="fa-solid fa-angle-right" style="font-size: .7rem;"></i></li>
  <li class="m-1"><a href="#">Add question</a></li>
</ul>
@endsection

@section('maincontent')

<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Create a new question</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('back/question') }}" method="post">
                            @csrf
                            <h6 class="card-title fw-medium mb-4" style="color: #4F73D9;">Question properties</h6>
                            <div class="mb-5">
                                <label for="name" class="form-label">Question name*</label>
                                <input type="text" class="form-control" id="name" name="name" maxlength="150" required value="{{ old('name') }}">
                                @error('name')
                                    <p style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                @enderror
                            </div>
                            <h6 class="card-title fw-medium mb-4" style="color: #4F73D9;">Question answers</h6>
                            <div class="row mb-3">
                                <div class="mb-3 col-lg-6">
                                    <label for="firstanswer" class="form-label">Answer 1*</label>
                                    <input type="text" class="form-control mb-2" id="firstanswer" name="firstanswer" maxlength="200"
                                    required value="{{ old('firstanswer') }}">
                                    @error('firstanswer')
                                        <p style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                    @enderror
                                    <span>Is correct? <input style="margin-left: .5rem;" class="form-check-input" type="radio"
                                    name="correctanswer" id="correctanswer1" value="1" checked></span>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="secondanswer" class="form-label">Answer 2*</label>
                                    <input type="text" class="form-control mb-2" id="secondanswer" name="secondanswer" maxlength="200"
                                    required value="{{ old('secondanswer') }}">
                                    @error('secondanswer')
                                        <p style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                    @enderror
                                    <span>Is correct? <input style="margin-left: .5rem;" class="form-check-input" type="radio"
                                    name="correctanswer" id="correctanswer2" value="2"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="thirdanswer" class="form-label">Answer 3*</label>
                                    <input type="text" class="form-control mb-2" id="thirdanswer" name="thirdanswer" maxlength="200"
                                    required value="{{ old('thirdanswer') }}">
                                    @error('thirdanswer')
                                        <p style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                    @enderror
                                    <span>Is correct? <input style="margin-left: .5rem;" class="form-check-input" type="radio"
                                    name="correctanswer" id="correctanswer3" value="3"></span>
                                </div>
                                <div class="mb-5 col-lg-6">
                                    <label for="fourthanswer" class="form-label">Answer 4*</label>
                                    <input type="text" class="form-control mb-2" id="fourthanswer" name="fourthanswer" maxlength="200"
                                    required  value="{{ old('fourthanswer') }}">
                                    @error('fourthanswer')
                                        <p style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                    @enderror
                                    <span>Is correct? <input style="margin-left: .5rem;" class="form-check-input" type="radio"
                                    name="correctanswer" id="correctanswer4" value="4"></span>
                                </div>
                                @error('correctanswer')
                                    <p style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Create question</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection