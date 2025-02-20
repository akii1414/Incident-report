<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Audit Trail Table') }}
        </h2>
    </x-slot>
    <div class="container">
        <h2 class="mb-4">Audit Logs</h2>
    
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Action</th>
                    <th>Model</th>
                    <th>Model ID</th>
                    <th>Old Values</th>
                    <th>New Values</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                    <tr>
                        <td>{{ $log->user_id }}</td>
                        <td>{{ optional($log->user)->full_name ?? 'Guest' }}</td>
                        <td>{{ ucfirst($log->action) }}</td>
                        <td>{{ class_basename($log->model_type) }}</td>
                        <td>{{ $log->model_id }}</td>
                        <td>
                            <pre>{{ json_encode(json_decode($log->old_values), JSON_PRETTY_PRINT) }}</pre>
                        </td>
                        <td>
                            <pre>{{ json_encode(json_decode($log->new_values), JSON_PRETTY_PRINT) }}</pre>
                        </td>
                        <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        <div class="d-flex justify-content-center">
            {{ $logs->links() }}
        </div>
    </div>
</x-app-layout>