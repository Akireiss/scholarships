@extends('layouts.includes.admin.index')

@section('content')
<section class="p-5">
    <div class="row">
        <div class="card">
            <div class="card-header text-center">
                <h3>Campus & Courses/Program</h3>
            </div>
            <div class="row p-1 align-items-center justify-content-center">
                <div class="col-md-6">
                    @if (session('success'))
                    <div class="alert alert-success text-center" id="success">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="row align-items-center justify-content-center">
                    {{-- Form 1 --}}
                    <div class="col-md-6">
                        <div class="container shadow-lg w-100 h-75">
                            <form action="{{ route('saveCampus') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 p-3">
                                        <label for="campus" class="form-label">Campus name (abbreviation)</label>
                                        <input type="text" id="campus" class="form-control form-control-sm"
                                            name="campus" required />
                                    </div>
                                    <div class="col-md-12">
                                        <label for="campus_description" class="form-label">Campus Description</label>
                                        <input type="text" id="campus_description" class="form-control form-control-sm"
                                            name="campus_description" required />
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row align-items-start justify-content-start m-2">
                                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Form 2 --}}
                    <div class="col-md-6 ">
                        <div class="container shadow-lg w-100 h-75">
                            <form action="{{ route('saveCourse') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 p-3">
                                        <label for="campus_select" class="form-label">Campus</label>
                                        <select name="campus_select" id="campus_select"
                                            class="form-select form-select-md" required>
                                            @if(empty($campuses))
                                            <option selected>No Data</option>
                                            @else
                                            <option selected disabled>Choose campus from below</option>
                                            @foreach ($campuses as $campus)
                                            <option value="{{ $campus->id }}">{{ $campus->campus_name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="course_program" class="form-label">Course/Program</label>
                                        <input type="text" id="course_program" name="course_program"
                                            class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row align-items-start justify-content-start m-2">
                                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .btn-primary {
        background-color: blue;
        color: black;
    }
</style>
@endsection