<div>
    <section class="mt-2 p-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="d-flex align-items-end justify-content-end mb-2 gap-2">
                        <a href="{{ url('/admin/settings/addScholar') }}" class="btn btn-sm btn-warning">
                            Reset <i class="mdi mdi-rotate-left mdi-20"></i>
                        </a>
                        <!-- Add Button -->
                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                            data-bs-target="#modal">
                            Add <i class="mdi mdi-library-plus mdi-20"></i>
                        </button>

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

                        <!-- Modal -->
                        <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true"
                            wire:ignore.self>
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modalLabel">Scholarship Name</h1>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        @if (session()->has('message'))
                                        <div class="alert alert-success">
                                            {{ session('message') }}
                                        </div>
                                        @endif

                                        <form wire:submit.prevent="addScholarship">
                                            @csrf
                                            <!-- Your form fields go here -->
                                            <div class="form-check">
                                                <label for="scholarship_type_id" class="mb-2 fw-bold">Scholarship
                                                    Type</label>
                                                <select wire:model="scholarship_type_id" name="scholarship_type_id"
                                                    id="scholarship_type_id" class="form-select form-select-sm mb-2">
                                                    <option selected>Select Scholarship Type</option>
                                                    <option value="0">Government</option>
                                                    <option value="1">Private</option>
                                                </select>
                                            </div>
                                            <div class="form-check">
                                                <label for="scholarship_name" class="mb-2 fw-bold">Scholarship Name
                                                    <font class="text-danger">*</font>
                                                </label>
                                                <input wire:model="scholarship_name"
                                                    class="form-control form-control-sm mb-2" type="text"
                                                    id="scholarship_name">
                                                @error('scholarship_name') <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <!-- End of your form fields -->
                                        </form>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-end align-items-center">
                                        @if (session()->has('message'))
                                            <div class="text-success">
                                                {{ session('message') }}
                                            </div>
                                        @endif

                                        <div>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-success btn-sm" wire:click="addScholarship">Add</button>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                        {{-- Modal End --}}

                    </div>
                    <div class="card-body shadow-lg">
                        <div id="datatable">
                            <!-- DataTable with export buttons -->
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Scholarship Name</th>
                                        <th>Scholarship Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($scholarships as $scholarship)
                                    <tr>
                                        <td>{{ $scholarship->name }}</td>
                                        <td>{{ $scholarship->getTypeScholarshipAttribute() }}</td>
                                        <td>{{ $scholarship->getStatusScholarshipNameAttribute() }}</td>
                                        <td>
                                            <a href="{{ route('scholar.edit', ['scholar' => $scholarship->id]) }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No records found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
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
{{--
<livewire:scholarship-name-table /> --}}
