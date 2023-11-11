@extends('layouts.includes.admin.index')
@section('content')
<section class="mt-1 p-5">
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body shadow-lg">
                    <form action="{{ url('admin/settings/actions/updateFunds/' .$source_id->source_id ) }}"
                        method="POST">
                        @csrf
                        @method('put')
                        {{-- Display success message --}}
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        {{-- ends here --}}

                        <div class="form-check">
                            <label for="fundSource" class="mb-2 fw-bold">Source Funds</label>
                            <input name="source_name" class="form-control form-control-sm mb-2" id="fundSource"
                                value="{{ $source_id->source_name }}">
                        </div>


                        <div class="form-check">
                            <label for="status" class="mb-2 fw-bold">Status</label>
                            <select name="status" id="status" class="form-select form-select-sm mb-2">
                                <option value="0" {{ $source_id->status == 0 ? 'selected' : '' }}>Active</option>
                                <option value="1" {{ $source_id->status == 1 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>


                        <div class="row mt-3">
                            <div class="col-sm-12 d-flex justify-content-center gap-3 mt-2">
                                <button type="submit" class="btn btn-success btn-sm fw-bold">Update</button>
                                <a type="button" class="btn btn-danger btn-sm fw-bold"
                                    href="{{ route('scholar.view', ['scholar' => $source_id->source_id]) }}">Cancel</a>
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
