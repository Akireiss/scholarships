<!-- resources/views/admin/student-view.blade.php -->

@extends('layouts.includes.admin.index')

@section('content')
<section class="px-5">
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body shadow-md p-3">
                    <div class="d-flex justify-content-end align-items-end">
                        <a href="{{ route('admin.scholarship.view') }}"
                            class="btn btn-gradient-primary btn-sm rounded mb-2">Back</a>
                    </div>
                    <h2>Student Details</h2>
                    <div class="table-responsive p-2">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Student ID:</th>
                                            <td>{{ $student->student_id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Lastname:</th>
                                            <td>{{ $student->lastname }}</td>
                                        </tr>
                                        <tr>
                                            <th>Firstname:</th>
                                            <td>{{ $student->firstname }}</td>
                                        </tr>
                                        <tr>
                                            <th>Middle Initial:</th>
                                            <td>{{ $student->initial }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email Address:</th>
                                            <td>{{ $student->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Sex:</th>
                                            <td>{{ $student->sex }}</td>
                                        </tr>
                                        <tr>
                                            <th>Civil Status:</th>
                                            <td>{{ $student->status }}</td>
                                        </tr>
                                        <tr>
                                            <th>Barangay:</th>
                                            <td>{{ $student->barangay }}</td>
                                        </tr>
                                        <tr>
                                            <th>Municipal:</th>
                                            <td>{{ $student->municipal }}</td>
                                        </tr>
                                        <tr>
                                            <th>Province:</th>
                                            <td>{{ $student->province }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Campus:</th>
                                            <td>{{ $student->campus }}</td>
                                        </tr>
                                        <tr>
                                            <th>Course:</th>
                                            <td>{{ $student->course }}</td>
                                        </tr>
                                        <tr>
                                            <th>Year Level:</th>
                                            <td>{{ $student->level }}</td>
                                        </tr>
                                        <tr>
                                            <th>Father's Full Name:</th>
                                            <td>{{ $student->father }}</td>
                                        </tr>
                                        <tr>
                                            <th>Mother's Full Name:</th>
                                            <td>{{ $student->mother }}</td>
                                        </tr>
                                        <tr>
                                            <th>Contact Number:</th>
                                            <td>{{ $student->contact }}</td>
                                        </tr>
                                        <tr>
                                            <th>Type of Student:</th>
                                            <td>{{ $student->studentType }}</td>
                                        </tr>
                                        <tr>
                                            <th>Name of School Last Attended:</th>
                                            <td>{{ $student->nameSchool }}</td>
                                        </tr>
                                        <tr>
                                            <th>School Year Last Attended:</th>
                                            <td>{{ $student->lastYear }}</td>
                                        </tr>
                                        <tr>
                                            <th>Recipient:</th>
                                            <td>{{ $student->grant_status }}</td>
                                        </tr>
                                        <tr>
                                            <th>Name of Scholarship/Grant:</th>
                                            <td>{{ $student->grant }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
@endsection