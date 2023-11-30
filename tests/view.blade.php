@extends('layouts.includes.admin.index')
@section('content')
<style>
    .mdi-icon {
        font-size: 15px;
        vertical-align: middle;
    }

    .btn-danger {
        background-color: red;
        color: white
    }

    .btn-success {
        background-color: green;
        color: white
    }
</style>

<section class="p-4">
    <div class="row mt-3 d-flex align-items-center justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="d-flex align-items-end justify-content-end mb-2 gap-2">
                    <!-- Add Button -->
                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal">
                        Add
                        <i class="mdi mdi-library-plus mdi-20"></i>
                    </button>
                    <!-- Cancel Button -->
                    <a class="btn btn-sm btn-danger" href="{{ route('campus-NLUC.settings.addScholar') }}">
                        Cancel
                        <i class="mdi mdi-close-circle mdi-20"></i>
                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modalLabel">Fund Sources</h1>
                                    @if (session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                    @endif
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('scholar.nlucstoreFundSource', ['scholar' => $scholar->id]) }}" method="post">
                                        @csrf
                                        <!-- Your form fields go here -->
                                        <div class="form-check">
                                            <label for="source_name" class="mb-2 fw-bold">Fund Source name</label>
                                            <input class="form-control form-control-sm mb-2" type="text" id="source_name" name="source_name">
                                            @error('source_name') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <!-- End of your form fields -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success btn-sm">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Modal End --}}



                </div>
                <div class="card-body shadow-lg">
                    <div class="table-responsive">
                        <table class="table table-striped data-table" style="width: 100%">
                            <thead>
                                <th>Source Id</th>
                                <th>Source Name</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @if ($scholar->fundSources)
                                @foreach ($scholar->fundSources as $scholarship)
                                <tr>
                                    <td>{{ $scholarship->source_id }}</td>
                                    <td>{{ $scholarship->source_name }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary text-dark" target="_blank"
                                            href="{{ route('campus-NLUC.settings.actions.editFunds', ['source_id' => $scholarship->source_id]) }}">
                                            Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
