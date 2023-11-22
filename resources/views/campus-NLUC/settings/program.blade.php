@extends('layouts.includes.campus-NLUC.index')

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
                    {{-- Form --}}
                    <div class="col-md-12 ">
                        <div class="container shadow-lg w-75 h-75">
                            <form action="{{ route('nlucsaveCourse') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 p-3">
                                        <label for="campus_select" class="form-label">Campus</label>
                                        <select name="campus_select" id="campus_select"
                                            class="form-select form-select-md" required>
                                            @if(empty($nlucCampuses))
                                            <option selected>No Data</option>
                                            @else
                                            <option selected disabled>Choose campus from below</option>
                                            @foreach ($nlucCampuses as $nlucCampus)
                                            <option value="{{ $nlucCampus->id }}">{{ $nlucCampus->campus_name }}</option>
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
