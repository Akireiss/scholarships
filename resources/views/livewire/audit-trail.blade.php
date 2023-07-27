<div class="container mt-4">
    <h1 class="mb-4">Audit Trail</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>User Id</tr>
                    <tr>Name</tr>
                    <tr>Event</tr>
                    <tr>Description</tr>
                    <tr>Created at</tr>
                </thead>
                <tbody>
                    @foreach ($auditLogs as $log)
                        <tr>
                            <td>{{ $log->id }}</td>
                            <td>{{ optional($log->user)->name ?? 'Unknown User' }}</td>
                            <td>{{ $log->event }}</td>
                            <td>{{ $log->description }}</td>
                            <td>{{ $log->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</div>
