@extends('layouts.includes.admin.index')
@section('content')
<style>
    .mdi-icon {
        font-size: 15px;
        vertical-align: middle;
    }
</style>

<section class="p-4">
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="d-flex align-items-end justify-content-end">
                    <!-- Add Button -->
                    <a class="btn btn-sm btn-success text-dark" href="{{ route('admin.settings.addScholar') }}">
                        Add
                    </a>
                    <!-- Cancel Button -->
                    <a class="btn btn-sm btn-danger text-dark"
                        href="{{ route('admin.settings.addScholar') }}">Cancel</a>
                </div>
                <div class="card-body shadow-lg">
                    <div class="table-responsive">
                        <table class="table table-striped data-table" style="width: 100%">
                            <thead>
                                <th>Source Id</th>
                                <th>Source Name</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @if ($scholar->fundSources)
                                @foreach ($scholar->fundSources as $scholarship)
                                <tr>
                                    <td>{{ $scholarship->source_id }}</td>
                                    <td>{{ $scholarship->source_name }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary text-dark" target="_blank"
                                        href="{{ route('admin.settings.actions.editFunds', ['source_id' => $scholarship->source_id]) }}" >
                                        Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
