<div>
    <section class="mt-2 p-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="d-flex align-items-end justify-content-end mb-2 gap-2">
                        <a href="{{ url('/admin/student') }}" class="btn btn-sm btn-warning">
                            Reset <i class="mdi mdi-rotate-left mdi-20"></i>
                        </a>
                        <!-- Add Button -->
                        <a href="{{ route('admin.actions.add_student') }}" class="btn btn-sm btn-success">
                            Add <i class="mdi mdi-account-multiple-plus mdi-20"></i>
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
                    <div class="card-body shadow-lg m-0">
                        <livewire:student-add-table/>
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
            color: black
        }
        .mdi-account-details{
            font-size: 30px;
            margin: 0;
            padding: 0;
        }
        .mdi-account-details:hover{
            color: rgb(0, 0, 138)0, 0, 0, 0.767);
        }
    </style>
    <script>
        $('#students').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                text: '<i class="fas fa-file-excel me-1"></i>Excel',
                className: 'dt-button btn btn-sm btn-success mb-3 text-dark',
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
