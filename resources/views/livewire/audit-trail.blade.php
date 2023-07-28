<div class="container mt-4">
    <h1 class="mb-2 d-flex align-item-center justify-content-center">Audit Trail</h1>
    <div class="table-responsive p-5">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Action</th>
                    <th>Data</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($auditLogs as $log)
                    <tr>
                        <td>{{ optional($log->user)->id ?? 'Unknown User' }}</td>
                        <td>{{ optional($log->user)->name ?? 'Unknown User' }}</td>
                        <td>{{ $log->action }}</td>
                        <td>{{ $log->data }}</td>
                        <td>{{ $log->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
