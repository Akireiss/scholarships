@extends('layouts.includes.admin.index')
@section('content')
<section class="mt-1 p-5">
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                 {{-- Display success message --}}
                 @if(session('success'))
                 <div class="alert alert-success">
                     {{ session('success') }}
                 </div>
                 @endif
                <div class="card-body shadow-lg">
                    <form action="{{ route('scholarships.update', ['scholar' => $scholar]) }}" method="POST">
                        @csrf
                        @method('put')


                        <div class="form-check">
                            <label for="scholarship_type_id" class="mb-2 fw-bold">Scholarship Type</label>
                            <select name="scholarship_type_id" id="scholarship_type_id" class="form-select mb-2">
                                <option value="0" {{ $scholar->scholarship_type == 0 ? 'selected' : '' }}>Government
                                </option>
                                <option value="1" {{ $scholar->scholarship_type == 1 ? 'selected' : '' }}>Private
                                </option>
                            </select>
                        </div>

                        <div class="form-check">
                            <label for="scholarship_name" class="mb-2 fw-bold">Scholarship Name</label>
                            <input name="scholarship_name" class="form-control form-control-md mb-2"
                                id="scholarship_name" value="{{ $scholar->name }}">
                        </div>

                        <div class="form-check">
                            <label for="status" class="mb-2 fw-bold">Status</label>
                            <select name="status" id="status" class="form-select mb-2">
                                <option value="0" {{ $scholar->status == 0 ? 'selected' : '' }}>Active</option>
                                <option value="1" {{ $scholar->status == 1 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-8 d-flex justify-content-center gap-4">
                                <button type="submit" class="btn btn-success btn-sm  fw-bold">Update</button>
                                <a type="button" class="btn btn-danger btn-sm fw-bold "
                                    href="{{ route('admin.settings.addScholar') }}">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .btn-danger {
        background-color: red;
        color: white
    }

    .btn-success {
        background-color: green;
        color: white
    }
</style>
@endsection
