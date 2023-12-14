@extends('base.frontlayout')

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
<header class="py-5">
    <div class="container px-5 pb-5">
        <div class="row gx-5 align-items-center">
            <div class="col-xxl-6">
                <!-- Header text content-->
                <div class="text-center text-xxl-start">
                    <div class="badge bg-gradient-primary-to-secondary text-white mb-4"><div class="text-uppercase">History &middot; Social culture &middot; Random themes</div></div>
                    <div class="fs-3 fw-light text-muted">Welcome to quiz game</div>
                    <h1 class="display-3 fw-bolder mb-5"><span class="text-gradient d-inline">Have fun and get the best score</span></h1>
                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xxl-start mb-3">
                        <a class="btn btn-primary btn-lg px-5 py-3 me-sm-3 fs-6 fw-bolder" href="{{ url('game') }}">Start game</a>
                    </div>
                    @error('message')
                        <p style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                    @enderror
                </div>
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