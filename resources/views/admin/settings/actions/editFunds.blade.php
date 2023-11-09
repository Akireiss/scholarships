@extends('layouts.includes.admin.index')
@section('content')
<section class="mt-1 p-5">
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body shadow-lg">
                    <form action="" method="POST">
                        {{-- Display success message --}}
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        {{-- ends here --}}
                        @csrf
                        @method('put')


                        <div class="form-check">
                            <label for="scholarship_name_id" class="mb-2 fw-bold">Scholarship Name</label>
                          <input name="fund"  value="" class="form-control form-control-sm mb-2"/>
                            </select>
                        </div>

                        <div class="form-check">
                            <label for="fundSource" class="mb-2 fw-bold">Source Funds</label>
                            <input name="fundSource" class="form-control form-control-sm mb-2"
                             id="fundSource" value="{{ $scho }}">
                        </div>

                        <div class="form-check">
                            <label for="status" class="mb-2 fw-bold">Status</label>
                            <select name="status" id="status" class="form-select form-select-sm mb-2">
                                <option selected>Select from the follwing</option>
                                <option value="0">Active</option>
                                <option value="1">Inactive</option>
                            </select>
                        </div>
                        {{-- {{ $scholar->status == 0 ? 'selected' : '' }}
                        {{ $scholar->status == 1 ? 'selected' : '' }} --}}


                        <div class="row mt-3">
                            <div class="col-sm-12 d-flex justify-content-start">
                                <button type="submit" class="btn btn-success btn-sm text-dark fw-bold">Update</button>
                                {{-- <a type="button" class="btn btn-danger btn-sm fw-bold text-dark"
                                    href="{{ route('scholar.view') }}">Cancel</a> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
