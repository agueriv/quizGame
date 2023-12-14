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

<header class="py-5 mt-5">
    <div class="container px-5 pb-5">
        <div class="row gx-5 align-items-start justify-content-center">
            <div class="col-md-6 col-xxl-4 p-4 mb-4">
                <!-- Logo history -->
                    <img class="profile-img" src="{{ url('frontassets/image/historyLogo2.svg') }}" alt="..." />
            </div>
            
            <div class="col-md-12 col-xxl-8">
                <!-- History table -->
                <div class="text-center mb-4">
                    <h2 class="display-6 fw-bolder mb-0"><span class="text-gradient d-inline">ANSWERS HISTORY</span></h2>
                </div>
                
                <div class="card shadow rounded-4 border-0 mb-5">
                    <div class="card-body p-0">
                        <div class="d-flex align-items-center">
                            <div class="p-5">
                                <h4 class="text-center ">Session alias '{{ session('frontAlias') }}'</h4>
                                @if(sizeof($entries) == 0)
                                    <p>This alias has no history</p>
                                    @else
                                    <!-- Tabla -->
                                    <table class="table mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                      <tr>
                                        <th class="border-bottom-0" scope="col">
                                          <h6 class="fw-semibold mb-0">Question</h6>
                                        </th>
                                        <th class="border-bottom-0" scope="col">
                                          <h6 class="fw-semibold mb-0">Answer</h6>
                                        </th>
                                        <th class="border-bottom-0" scope="col">
                                          <h6 class="fw-semibold mb-0">Correctly?</h6>
                                        </th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($entries as $entry)
                                          <tr>
                                            <td class="border-bottom-0" scope="col">
                                              <p class="fw-normal mb-1">{{ $entry->question->name }}</p>
                                            </td>
                                            <td class="border-bottom-0" scope="col">
                                              <p class="mb-0 fw-normal">{{ $entry->answer->name }}</p>
                                            </td>
                                            <td class="border-bottom-0" scope="col">
                                              <p class="fw-normal mb-1">{{ $entry->escorrecta === 1 ? 'Correct' : 'Incorrect' }}</p>
                                            </td>
                                          </tr>
                                      @endforeach
                                    </tbody>
                                  </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

@endsection