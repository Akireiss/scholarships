@extends('layouts.includes.admin.index')
@section('content')
<section class="p-5">
    <div class="row p-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body shadow-lg">
                    <form>

                        <!-- Campus -->
                        <div class="row">
                            <div class="col-6">
                                <label for="campus" class="form-label">CAMPUS</label>
                                <input type="text" class="form-control form-control-sm" id="campus" name="campus"
                                    value="{{ $student->course }}" disabled>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <p class="fw-bold fs-5">I. STUDENT INFORMATION</p>

                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label" for="lastname">Last name</label>
                                <input type="text" id="lastname" name="lastname" class="form-control form-control-sm"
                                    value="{{ $student->lastname }}" disabled>
                            </div>

                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label" for="firstname">First name</label>
                                <input type="text" id="firstname" name="firstname" class="form-control form-control-sm"
                                    value="{{ $student->firstname }}" disabled>
                            </div>

                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label" for="initial">Middle Initial</label>
                                <input type="text" id="initial" name="initial" class="form-control form-control-sm"
                                    value="{{ $student->initial }}" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <p class="mt-3 fw-bold fs-6">ADDRESS<span class="text-danger">*</span></p>
                            <!-- Province Address -->
                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label">Province</label>
                                <input type="text" id="province" name="province" class="form-control form-control-sm"
                                    value="{{ $student->province }}" disabled>
                            </div>
                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label">Municipal</label>
                                <input type="text" id="municipal" name="municipal" class="form-control form-control-sm"
                                    value="{{ $student->municipal }}" disabled>
                            </div>
                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label">Barangay</label>
                                <input type="text" id="barangay" name="barangay" class="form-control form-control-sm"
                                    value="{{ $student->barangay }}" disabled>
                            </div>
                        </div>

                        {{-- Rest of the form --}}
                        <!-- Add your remaining form fields here, setting them all to 'disabled' -->

                        {{-- <div class="d-flex float-start mt-3 gap-4">
                            <button type="reset" class="btn btn-warning btn-sm fw-bold text-dark mt-2"
                                disabled>Reset</button>
                            <button type="submit" class="btn btn-success btn-sm fw-bold text-dark mt-2"
                                disabled>Save</button>
                            <a type="button" class="btn btn-danger btn-sm fw-bold text-dark mt-2"
                                href="{{ route('admin.dashboard') }}">Cancel</a>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection