@extends('layouts.includes.staff.index')
@section('content')

<section class="p-4">
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-end justify-content-end">
                        <a class="btn btn-sm btn-danger text-dark" href="{{ route('admin.scholarship.view') }}">Cancel</a>
                    </div>
                </div>
                <div class="card-body shadow-lg">
                    <div class="table-responsive">
                        <table class="table table-striped data-table"
                            style="width: 100%">
                            <thead>
                                <th>Source Id</th>
                                <th>Source Name</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @if ($scholarships->fundSources)
                                    @foreach ($scholarships->fundSources as $scholarship )
                                        <tr>
                                            <td>{{ $scholarship->source_id }}</td>
                                            <td>{{ $scholarship->source_name }}</td>
                                            <td>
                                                <a href="{{ route('staff.scholarship.student-view', ['source_id' => $scholarship->source_id]) }}" class="btn btn-primary btn-sm text-dark">View Student List</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- @endif --}}
            </div>
        </div>
</section>
@endsection
