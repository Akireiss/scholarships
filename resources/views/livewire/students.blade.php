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
                        <a href="{{ route('admin.actions.add_student') }}" class="btn btn-sm btn-success" >
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
                                <tr>
                                    <td hidden></td> <!-- Student Id -->
                                    <td></td> <!-- Last Name -->
                                    <td></td> <!-- First Name -->
                                    <td></td> <!-- Middle Initial -->
                                    <td hidden></td> <!-- Email Address -->
                                    <td hidden></td> <!-- Sex -->
                                    <td hidden></td> <!-- Status -->
                                    <td hidden></td> <!-- Barangay -->
                                    <td hidden></td> <!-- Municipal -->
                                    <td hidden></td> <!-- Province -->
                                    <td hidden></td> <!-- Campus -->
                                    <td hidden></td> <!-- Course/Program -->
                                    <td></td> <!-- Year Level -->
                                    <td></td> <!-- Semester -->
                                    <td hidden></td> <!-- School year -->
                                    <td hidden></td> <!-- Father's Full name -->
                                    <td hidden></td> <!-- Mother's Full name -->
                                    <td hidden></td> <!-- Contact Number -->
                                    <td hidden></td> <!-- Type of Student -->
                                    <td hidden></td> <!-- Name of School Last Attended -->
                                    <td hidden></td> <!-- Last School Year Attended -->
                                    <td></td> <!-- Recipient -->
                                    <td></td> <!-- Type of Scholarship -->
                                    <td hidden></td> <!-- Remarks -->
                                    <td class="m-5">
                                        <a href="">
                                            <i class="fas fa-plus fa-lg"></i>
                                        </a>
                                        <a href="">
                                            <i class="fas fa-eye" fa-lg></i>
                                        </a>
                                        <a href="">
                                            <i class="fas fa-edit fa-lg"></i>
                                        </a>
                                    </td>
                                </tr>

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
    <script>
        $('#example').DataTable({
  dom: 'Bfrtip',
  buttons: [
    {
      extend: 'excel',
      text: 'Excel',
      className: 'btn btn-sm btn-success'
    },
    {
      extend: 'pdf',
      text: 'PDF',
      className: 'btn btn-sm btn-danger'
    }
  ]
});
    </script>
</div>
