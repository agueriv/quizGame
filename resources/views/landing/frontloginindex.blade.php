@extends('base.frontlayout')

@section('menu')
<li class="nav-item"><a class="nav-link" href="{{ url('') }}">Home</a></li>
<li class="nav-item"><a class="nav-link disabled" href="{{ url('alias/history/' . session('frontAlias', 'noname')) }}">History</a></li>
<li class="nav-item"><a class="nav-link disabled" href="{{ url('back') }}">Admin zone</a></li>
<li class="nav-item">
    <form action="{{ url('forgetalias') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-outline-primary mx-3 d-block disabled" style="cursor: pointer !important">Logout</button>
    </form>
</li>
@endsection

@section('content')
<header class="py-5">
    <div class="container px-5 pb-5">
        <div class="row gx-5 align-items-center">
            <div class="col-xxl-6">
                <!-- Header text content-->
                <form id="contactForm" class="col-xxl-8" action="{{ url('frontlogin') }}" method="post">
                    @csrf
                    <!-- Name input-->
                    <h5 class="text-center mb-4 text-gradient">You must enter an alias to play</h5>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="alias" name="alias" type="text" placeholder="Enter your name..." style="cursor: text !important;" />
                        <label for="alias">Enter your alias...</label>
                    </div>
                    <!-- Submit Button-->
                    <div class="d-grid" style="cursor: pointer !important;">
                        <button class="btn btn-primary btn-lg" id="submitButton"
                            type="submit">Submit</button>
                    </div>
                </form>
            </div>
            <div class="col-xxl-6">
                <div class="d-flex justify-content-center mt-5 mt-xxl-0">
                    <div class="profile">
                        <img class="profile-img" src="{{ url('frontassets/image/logoFrontQuiz.svg') }}" alt="..." />
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
@endsection