@extends('base.frontlayout')

@section('quizcss')
<link href="{{ url('frontassets/css/quiz.css') }}" rel="stylesheet" />
@endsection

@section('menu')
<li class="nav-item"><a class="nav-link" href="{{ url('') }}">Home</a></li>
<li class="nav-item"><a class="nav-link" href="{{ url('alias/history/' . session('frontAlias', 'noname')) }}">History</a></li>
<li class="nav-item"><a class="nav-link" href="{{ url('back') }}">Admin zone</a></li>
<li class="nav-item">
    <form action="{{ url('forgetalias') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-outline-primary mx-3 d-block" style="cursor: pointer !important">Logout</button>
    </form>
</li>
@endsection

@section('content')

<header class="py-5 mt-5">
    <div class="container px-5 pb-5">
        <div class="row gx-5 align-items-center justify-content-center">
            <div class="d-none d-xxl-block col-xxl-2">
              <img src="{{ url('frontassets/image/shapeLeft.svg') }}" />
            </div>
            <div class="col-xs-12 col-sm-12 col-lg-12 col-md-10 col-xxl-8">
              <div class="text-center mb-4">
                    <h2 class="display-6 fw-bolder mb-2"><span class="text-gradient d-inline">QUIZ PARTY</span></h2>
                    <p class="small text-muted fw-bolder">Answer all 5 questions correctly and get the highest score</p>
                </div>
                <div class="card shadow rounded-4 border-0 mb-5">
                    <div class="card-body p-5">
                        @if($finish)
                        <h5 class="mb-4">Congratulations! You got {{ $points }} hits</h5>
                        <a class="btn btn-primary btn-lg px-3 py-2 me-sm-3 fs-6 fw-bolder" href="{{ url('game') }}">Play again</a>
                        <a class="btn btn-secondary btn-lg px-3 py-2 me-sm-3 fs-6 fw-bolder" href="{{ url('/') }}">Go home</a>
                        @else
                        <div class="d-flex align-items-center mb-4">
                          <h5>{{ ($number + 1) }} - {{ $questions[$number]->name }}</h5>
                        </div>
                        <div class="d-flex align-items-start flex-column">
                          <!-- respuestas -->
                          <div class="modal-body" style="width: 100% !important">
                              <div class="col-xs-3 5"></div>
                              <form action="{{ url('game') }}" method="post">
                                @csrf
                                <input type="hidden" name="points" value="{{ $points }}">
                                <input type="hidden" name="number" value="{{ $number }}">
                                <input type="hidden" name="questions" value="{{ $questions }}">
                                <input type="hidden" name="idquestion" value="{{ $questions[$number]->id }}">
                                <input type="hidden" name="alias" value="{{ session('frontAlias') }}">
                                <?php
                                  $answers = $questions[$number]->answers 
                                ?>
                                <div class="quiz" id="quiz" data-toggle="buttons">
                                    <div class="container row">
                                      <input type="radio" id="radio1" name="q_answer" value="{{ $answers[0]->id }}" required>
                                      <label for="radio1" class="text-left  element-animation1 btn btn-lg btn-outline-primary btn-block mb-2">
                                        {{ $answers[0]->name }}
                                      </label>
                                    </div>
                                    <div class="container row">
                                      <input type="radio" id="radio2" name="q_answer" value="{{ $answers[1]->id }}" required>
                                      <label for="radio2" class="element-animation1 btn btn-lg btn-outline-primary btn-block mb-2">
                                        {{ $answers[1]->name }}
                                      </label>
                                    </div>
                                    <div class="container row">
                                      <input type="radio" id="radio3" name="q_answer" value="{{ $answers[2]->id }}" required>
                                      <label for="radio3" class="element-animation1 btn btn-lg btn-outline-primary btn-block mb-2">
                                        {{ $answers[2]->name }}
                                      </label>
                                    </div>
                                    <div class="container row">
                                      <input type="radio" id="radio4" name="q_answer" value="{{ $answers[3]->id }}" required>
                                      <label for="radio4" class="element-animation1 btn btn-lg btn-outline-primary btn-block mb-2">
                                        {{ $answers[3]->name }}
                                      </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Next</button>
                                </div>
                              </form>
                          </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="d-none d-xxl-block col-xxl-2">
              <img src="{{ url('frontassets/image/shapeRight.svg') }}" />
            </div>
        </div>
    </div>
</header>

@endsection