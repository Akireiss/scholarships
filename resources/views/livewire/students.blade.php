<div>
    <section class="mt-2 p-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="d-flex align-items-end justify-content-end mb-2 gap-2">
                        <a href="{{ url('/admin/student') }}" class="btn btn-sm btn-warning">
                            Reset <i class="mdi mdi-rotate-left mdi-20"></i>
                        </a>
                        <!-- Add Button -->
                        <a href="{{ route('admin.actions.add_student') }}" class="btn btn-sm btn-success">
                            Add <i class="mdi mdi-library-plus mdi-20"></i>
                        </a>

                        <!-- Cancel Button based on user role -->
                        @if(auth()->user()->role == 0)
                        <a class="btn btn-sm btn-danger" href="{{ route('staff.dashboardStaff') }}">
                            Cancel <i class="mdi mdi-close-circle mdi-20"></i>
                        </a>
                        @elseif(auth()->user()->role == 1)
                        <a class="btn btn-sm btn-danger" href="{{ route('admin.dashboard') }}">
                            Cancel <i class="mdi mdi-close-circle mdi-20"></i>
                        </a>
                        @elseif(auth()->user()->role == 2)
                        <a class="btn btn-sm btn-danger" href="{{ route('campus-NLUC.dashboardCamp') }}">
                            Cancel <i class="mdi mdi-close-circle mdi-20"></i>
                        </a>
                        @endif
                    </div>
                    <div class="card-body shadow-lg">
                        <!-- DataTable with export buttons -->
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th hidden>Student Id</th>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Middle Initial</th>
                                    <th hidden>Email Address</th>
                                    <th hidden>Sex</th>
                                    <th hidden>Status</th>
                                    <th hidden>Barangay</th>
                                    <th hidden>Municipal</th>
                                    <th hidden>Province</th>
                                    <th hidden>Campus</th>
                                    <th hidden>Course/Program</th>
                                    <th>Year Level</th>
                                    <th>Semester</th>
                                    <th hidden>School year</th>
                                    <th hidden>Father's Full name</th>
                                    <th hidden>Mother's Full name</th>
                                    <th hidden>Contact Number</th>
                                    <th hidden>Type of Student</th>
                                    <th hidden>Name of School Last Attended</th>
                                    <th hidden>Last School Year Attended</th>
                                    <th>Recepient</th>
                                    <th>Type of Scholarship</th>
                                    <th hidden>Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                <td hidden>{{ $student->student_id }}</td>
                                <td>{{ $student->lastname }}</td>
                                <td>{{ $student->firstname }}</td>
                                <td>{{ $student->initial }}</td>
                                <td hidden>{{ $student->email }}</td> <!-- Email Address -->
                                <td hidden>{{ $student->sex }}</td> <!-- Sex -->
                                <td hidden>{{ $student->status }}</td> <!-- Status -->
                                <td hidden>{{ $student->barangay }}</td> <!-- Barangay -->
                                <td hidden>{{ $student->municipal }}</td> <!-- Municipal -->
                                <td hidden>{{ $student->province }}</td> <!-- Province -->
                                <td hidden>{{ $student->campus }}</td> <!-- Campus -->
                                <td hidden>{{ $student->course }}</td> <!-- Course/Program -->
                                <td>{{ $student->level }}</td> <!-- Year Level -->
                                <td>{{ $student->grantee->semester ?? 'No Data' }}</td> <!-- Semester -->
                                <td hidden>{{ $student->grantee->school_year ?? 'No Data' }}</td>
                                <!-- School year -->
                                <td hidden>{{ $student->father }}</td> <!-- Father's Full name -->
                                <td hidden>{{ $student->mother }}</td> <!-- Mother's Full name -->
                                <td hidden>{{ $student->contact }}</td> <!-- Contact Number -->
                                <td hidden>{{ $student->studentType }}</td> <!-- Type of Student -->
                                <td hidden>{{ $student->nameSchool ?? 'No Data' }}</td>
                                <!-- Name of School Last Attended -->
                                <td hidden>{{ $student->lastYear ?? 'No Data' }}</td>
                                <!-- Last School Year Attended -->
                                <td>{{ $student->grantee->scholarship_name ?? 'No Data' }}</td> <!-- Recipient -->
                                <td>{{ $student->grantee->scholarship_type ?? 'No Data' }}</td>
                                <!-- Type of Scholarship -->
                                <td hidden>{{ $student->student_status }}</td> <!-- Remarks -->
                                <td class="m-2">
                                    <a href="{{ route('admin.scholarship.grantees')}}" title="Add">
                                        <i class="fas fa-plus fa-lg"></i>
                                    </a>
                                    <a href="" title="View" class="m-2">
                                        <i class="fas fa-eye fa-lg"></i>
                                    </a>
                                    <a href="" title="Edit" class="m-2">
                                        <i class="fas fa-edit fa-lg"></i>
                                    </a>
                                </td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        .btn-danger {
            background-color: rgb(192, 39, 39);
            color: white
        }

        .btn-success {
            background-color: green;
            color: white
        }

        .btn-warning {
            background-color: rgb(161, 161, 35);
            color: white
        }

        .btn-primary {
            background-color: rgb(93, 57, 223);
            color: white
        }
    </style>
    <!-- Initialize DataTable with export buttons -->
    <!-- livewire/students.blade.php -->

    <script>
        $('#example').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                text: '<i class="fas fa-file-excel me-1"></i>Excel',
                className: 'btn btn-sm btn-success mb-3 text-dark',
            },
            {
                extend: 'pdf',
                text: '<i class="fas fa-file-pdf me-1"></i>PDF',
                className: 'btn btn-sm btn-danger mb-3 text-dark',
            }
        ]
    });
    </script>

</div>
