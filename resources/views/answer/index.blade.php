@extends('base.backlayout')

@include('modal.deleteAnswerModal')

@section('breadcrumbs')
<ul class="d-flex align-items-center mb-0" >
  <li class="m-1"><a href="{{ url('back') }}">Dashboard</a></li>
  <li class="m-1"><i class="fa-solid fa-angle-right" style="font-size: .7rem;"></i></li>
  <li class="m-1"><a href="#">Answer list</a></li>
</ul>
@endsection

@section('maincontent')

<div class="container-fluid"  style="max-width: 1400px !important">
        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">ANSWERS LIST</h5>
                <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Id</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Question</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Name</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Is correct?</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Actions</h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($answers as $answer)
                          <tr>
                            <td class="border-bottom-0">
                              <p class="fw-normal mb-1">{{ $answer->id }}</p>
                            </td>
                            <td class="border-bottom-0">
                              <p class="mb-0 fw-normal">{{ $answer->question->name }}</p>
                            </td>
                            <td class="border-bottom-0">
                              <p class="fw-normal mb-1">{{ $answer->name }}</p>
                            </td>
                            <td class="border-bottom-0">
                              <p class="fw-normal mb-1">{{ $answer->escorrecta === 1 ? 'Correct' : 'Incorrect' }}</p>
                            </td>
                            <td class="border-bottom-0">
                              <div class="d-flex align-items-center gap-2">
                                <a class="btn btn-outline-primary" href="{{ url('back/answer/' . $answer->id) }}">Detail</a>
                                <a class="btn btn-outline-warning" href="{{ url('back/answer/' . $answer->id) . '/edit' }}">Edit</a>
                                <button data-url="{{ url('back/answer/' . $answer->id) }}" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAnswerModal">
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
        const deleteMotoModal = document.getElementById('deleteAnswerModal');
        const formDelete = document.getElementById('formDelete');
        
        deleteMotoModal.addEventListener('show.bs.modal', event => {
          let url = event.relatedTarget.dataset.url;
          formDelete.action = url;
        });
    </script>
@endsection

@endsection