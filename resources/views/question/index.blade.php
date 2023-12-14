@extends('base.backlayout')

@include('modal.deleteQuestionModal')

@section('breadcrumbs')
<ul class="d-flex align-items-center mb-0" >
  <li class="m-1"><a href="{{ url('back') }}">Dashboard</a></li>
  <li class="m-1"><i class="fa-solid fa-angle-right" style="font-size: .7rem;"></i></li>
  <li class="m-1"><a href="#">Question list</a></li>
</ul>
@endsection

@section('maincontent')

<div class="container-fluid"  style="max-width: 1400px !important">

        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">QUESTIONS LIST</h5>
                <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Id</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Name</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Actions</h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($questions as $question)
                          <tr>
                            <td class="border-bottom-0">
                              <p class="fw-normal mb-1">{{ $question->id }}</p>
                            </td>
                            <td class="border-bottom-0">
                              <p class="mb-0 fw-normal">{{ $question->name }}</p>
                            </td>
                            <td class="border-bottom-0">
                              <div class="d-flex align-items-center gap-2">
                                <a class="btn btn-outline-primary" href="{{ url('back/question/' . $question->id) }}">Detail</a>
                                <a class="btn btn-outline-warning" href="{{ url('back/question/' . $question->id) . '/edit' }}">Edit</a>
                                <button data-url="{{ url('back/question/' . $question->id) }}" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteQuestionModal">
                                    Delete
                                </button>
                              </div>
                            </td>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
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