@extends('layouts.includes.staff.index')

@section('content')
<section class="px-5">
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-6-md m-3">
            <div class="dt-buttons btn-group float-start">
                <button class="btn btn-primary btn-sm">Export to Excel</button>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-end align-items-end">
                        <a href="{{ route('staff.scholarship.view') }}"
                            class="btn btn-danger text-dark btn-md rounded mb-2">Back</a>
                    </div>
                    <h2>Student Details</h2>
                </div>
                <div class="card-body shadow-md p-3">
                    <div class="table-responsive p-2">
                        <div class="row">
                            <table class="table table-striped data-table" style="width: 100%">
                                <thead>
                                    <th>Student Id</th>
                                    <th>Lastname</th>
                                    <th>Firstname</th>
                                    <th>Middle Initial</th>
                                    <th>School</th>
                                    <th>Scholarship Type</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $student->student_id }}</td>
                                        <td>{{ $student->lastname }}</td>
                                        <td>{{ $student->firstname }}</td>
                                        <td>{{ $student->initial }}</td>
                                        <td>{{ $student->campus }}</td>
                                        <td>{{ $student->scholarshipType }}</td>
                                        <td>
                                            <a href="{{route('admin.scholarship.view_more', $student->id)}}" class="btn btn-sm btn-primary text-dark">View more</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @if ($students->isEmpty())
                                    <p>No students found.</p>
                                    @else
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .btn-primary {
        color: black;
        background-color: #0d6efd;
    }

    .btn-primary:hover {
        color: black;
        background-color: #0b5ed7;
    }
</style>
<script>
    $(document).ready(function() {
    $('.data-table').DataTable({
        // Options
        buttons: [
            {
                extend: 'excel',
                text: 'Export to Excel'
            }
        ]
    });
});
</script>
@endsection
