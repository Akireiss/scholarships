@extends('layouts.includes.admin.index')
@section('content')
<section class="p-5">
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-header bg-transparent text-center"> <!-- Set background to transparent -->

                    </div>
                    <form action="{{ route('school-year.save') }}" method="post" id="schoolYearForm">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="year" class="form-label m-2 fw-bold">School Year</label>
                                <input type="text" class="form-control form-control-lg @error('year') is-invalid @enderror"
                                    name="year" id="year" maxlength="9">
                                @error('year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small class="mx-3">Note: <span class="text-danger">e.g., (2020-2021)</span></small>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent text-center"> <!-- Set background to transparent -->
                            <button type="submit" class="btn btn-md btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .btn-primary {
        background-color: rgb(1, 1, 196);
        color: black;
        border-radius: 10px;
    }
</style>




@endsection
