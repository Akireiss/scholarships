@extends('layouts.includes.admin.index')
@section('content')
<section class="p-2 px-5">
    <div class="row p-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="row mt-2">
                    <div class="col-sm-12 d-flex justify-content-end p-2">
                        <a type="button" class="btn btn-danger btn-sm fw-bold text-dark"
                        href="{{ route('admin.scholarship.view') }}">Cancel</a>
                    </div>
                <div class="card-body shadow-lg">
                    <form>

                        <!-- Campus -->
                        <div class="row">
                            <div class="col-md-4">
                                <label for="campus" class="form-label">Semester</label>
                                <input class="form-control form-control-sm" value="{{ $student->semester }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="campus" class="form-label">CAMPUS</label>
                                <input class="form-control form-control-sm" value="{{ $student->campus }}" disabled>
                            </div>
                        </div>
                        <div class="row mt-2 mb-2">
                            <div class="col-md-4 position-relative mt-3">
                                <label class="form-label">Type of Student</label>
                                <input class="form-control form-control-sm" value="{{ $student->studentType }}"
                                    disabled>
                            </div>
                            <div class="col-md-4 position-relative mt-3">
                                <label class="form-label">Name of School Last Attended</label>
                                <input class="form-control form-control-sm"
                                    value="{{ $student->nameSchool ?? 'No info' }}" disabled>
                            </div>
                            <div class="col-md-4 position-relative mt-3">
                                <label class="form-label">School Year Last Attended</label>
                                <input class="form-control form-control-sm"
                                    value="{{ $student->lastYear ?? 'No info' }}" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <p class="fw-bold fs-5">I. STUDENT INFORMATION</p>

                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label" for="lastname">Last name</label>
                                <input class="form-control form-control-sm" value="{{ $student->lastname }}" disabled>
                            </div>

                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label" for="firstname">First name</label>
                                <input class="form-control form-control-sm" value="{{ $student->firstname }}" disabled>
                            </div>

                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label" for="initial">Middle Initial</label>
                                <input class="form-control form-control-sm" value="{{ $student->initial }}" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <p class="mt-3 fw-bold fs-6">ADDRESS<span class="text-danger">*</span></p>
                            <!-- Province Address -->
                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label">Province</label>
                                <input class="form-control form-control-sm" value="{{ $student->province }}" disabled>
                            </div>
                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label">Municipal</label>
                                <input class="form-control form-control-sm" value="{{ $student->municipal }}" disabled>
                            </div>
                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label">Barangay</label>
                                <input class="form-control form-control-sm" value="{{ $student->barangay }}" disabled>
                            </div>
                        </div>
                        {{-- sex here --}}
                        <div class="row">
                            <div class="col-md-4 position-relative mt-3">
                                <label for="sex" class="form-label">Sex</label>
                                <input class="form-control form-control-sm" value="{{ $student->sex }}" disabled>
                            </div>
                            <div class="col-md-4 position-relative mt-3">
                                <label for="status" class="form-label">Civil Status</label>
                                <input class="form-control form-control-sm" value="{{ $student->status }}" disabled>
                            </div>
                            <div class="col-md-4 position-relative mt-3">
                                <label for="contact" class="form-label">Contact Number</label>
                                <input class="form-control form-control-sm" value="{{ $student->contact }}" disabled>
                            </div>
                        </div>
                        {{-- sex end --}}

                        <div class="row">
                            <!-- Email -->
                            <div class="col-md-3 position-relative mt-3">
                                <label class="form-label" for="email">Email Address</label>
                                <input class="form-control form-control-sm" value="{{ $student->email }}" disabled />
                            </div>

                            <!-- Student ID -->
                            <div class="col-md-3 position-relative mt-3">
                                <label class="form-label" for="student_id">Student ID</label>
                                <input class="form-control form-control-sm" value="{{ $student->student_id }}"
                                    disabled />
                            </div>
                            <!-- Course -->
                            <div class="col-md-4 position-relative mt-3">
                                <label class="form-label">Course</label>
                                <input class="form-control form-control-sm" value="{{ $student->course }}" disabled>
                            </div>

                            <!-- Level -->
                            <div class="col-md-2 position-relative mt-3">
                                <label class="form-label">Year level</label>
                                <input class=" form-control form-control-sm" value="{{ $student->level }}" disabled>
                            </div>
                        </div>
                        <div class="row mt-2 mb-2">
                            <div class="col-md-6 position-relative mt-3">
                                <label class="form-label">Father's Fullname</label>
                                <input class="form-control form-control-sm" value="{{ $student->father }}" disabled>
                            </div>
                            <div class="col-md-6 position-relative mt-3">
                                <label class="form-label">Mother's Fullname</label>
                                <input class="form-control form-control-sm" value="{{ $student->mother }}" disabled>
                            </div>
                        </div>

                        <div class="row mt-2 mb-2">
                            {{-- <div class="col-md-4 position-relative mt-3">
                                <label class="form-label">Recipient</label>
                                <input class="form-control form-control-sm" value="{{ $student->grant_status }}"
                                    disabled>
                            </div> --}}
                            <div class="col-md-4 position-relative mt-3">
                                <label class="form-label">Recipient</label>
                                <input class="form-control form-control-sm" value="{{ $student->grant ?? 'No info' }}"
                                    disabled>
                            </div>
                            <div class="col-md-4 position-relative mt-3">
                                <label class="form-label">Scholarship Type</label>
                                <input class="form-control form-control-sm" value="{{ $student->getTypeScholarshipAttribute()  }}"
                                    disabled>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
