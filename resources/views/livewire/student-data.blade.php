<div>
    <section class="p-4 ">
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="card">
                    @if ($students && $sourceName)
                    <div class="card-header">
                        <h2>{{ $sourceName }}</h2>
                        <input type="search" class="form-control form-control-md rounded float-end"
                            placeholder="search...">
                    </div>
                    <div class="card-body shadow-lg">
                        <div class="table-responsive">
                            <table wire:model='students' id="students" class="table table-striped data-table"
                                style="width: 100%">
                                <thead>
                                    <th>Student Id</th>
                                    <th>Lastname</th>
                                    <th>Firstname</th>
                                    <th>Middle Initial</th>
                                    <th>Email</th>
                                    <th>Sex</th>
                                    <th>Civil Status</th>
                                    <th>Barangay</th>
                                    <th>City/Municipal</th>
                                    <th>Province</th>
                                    <th>School</th>
                                    <th>Course</th>
                                    <th>Year level</th>
                                    <th>Father's full name</th>
                                    <th>Mother's full name</th>
                                    <th>Contact number</th>
                                    <th>Student Type</th>
                                    <th>Name of School Last attended</th>
                                    <th>School Year Last attended</th>
                                    <th>Recipient</th>
                                    <th>Name of Scholarship/Grant</th>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                    <tr>
                                        <th>{{ $student->student_id }}</th>
                                        <th>{{ $student->lastname }}</th>
                                        <th>{{ $student->firstname }}</th>
                                        <th>{{ $student->initial }}</th>
                                        <th>{{ $student->email }}</th>
                                        <th>{{ $student->sex }}</th>
                                        <th>{{ $student->status }}</th>
                                        <th>{{ $student->barangay }}</th>
                                        <th>{{ $student->municipal }}</th>
                                        <th>{{ $student->province }}</th>
                                        <th>{{ $student->campus }}</th>
                                        <th>{{ $student->course }}</th>
                                        <th>{{ $student->level }}</th>
                                        <th>{{ $student->father }}</th>
                                        <th>{{ $student->mother }}</th>
                                        <th>{{ $student->contact }}</th>
                                        <th>{{ $student->studentType }}</th>
                                        <th>{{ $student->nameSchool }}</th>
                                        <th>{{ $student->lastYear }}</th>
                                        <th>{{ $student->grant_status }}</th>
                                        <th>{{ $student->grant }}</th>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
    </section>
    <script>
        $(document).ready(function () {
          $(".data-table").each(function (_, table) {
            $(table).DataTable();
          });
        });

        $(document).ready(function() {
          $('#students').DataTable( {
            dom: 'Bfrtip',
            buttons: [
              'csv', 'excel'
            ]
          } );
        } );
    </script>
</div>
