<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Incident Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">

                        <div class="bg-white shadow-lg rounded-lg">
                            <div class="px-4 py-3 bg-gray-100 flex justify-between items-center border-b">
                                <div class="flex items-center space-x-8">
                                    <h3 class="text-lg font-semibold">Incident Reports</h3>
                                    <form action="{{ route('dashboard.index') }}" method="GET" class="flex ml-8">
                                        <input type="text" name="search" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-400" 
                                               placeholder="Search anything..." value="{{ request('search') }}">
                                        <button type="submit" class="ml-4 px-3 py-1 text-white text-sm font-medium rounded-lg shadow bg-black">
                                            Search
                                        </button>
                                    </form>
                                    
                                </div>
                                <button id="create-button" class="px-4 py-2 text-white text-sm font-medium rounded-lg shadow bg-black">
                                    Create
                                </button>                                
                            </div>

                            <div class="overflow-x-auto">
                                <table class="w-full border border-gray-300 shadow-sm text-left">
                                    <thead class="bg-gray-200 text-gray-700">
                                        <tr class="border-b">
                                            <th class="px-6 py-3">ID</th>
                                            <th class="px-6 py-3">Incident ID</th>
                                            <th class="px-6 py-3">Subject</th>
                                            <th class="px-6 py-3">Name</th>
                                            <th class="px-6 py-3">Resolve</th>
                                            <th class="px-6 py-3">Created At</th>
                                            <th class="px-6 py-3">Last Update</th>
                                            <th class="px-6 py-3 text-center" colspan="4">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody class="text-gray-800">
                                        @foreach ($incident_details as $incident)
                                            <tr class="border-b hover:bg-gray-100">
                                                <td class="px-6 py-3">{{ $incident->id }}</td>
                                                <td class="px-6 py-3">{{ $incident->incident_id }}</td>       
                                                <td class="px-6 py-3">{{ $incident->subject }}</td>
                                                <td class="px-6 py-3">{{ $incident->user->full_name ?? 'N/A' }}</td>
                                                <td class="px-6 py-3">{{ $incident->incident_resolved }}</td>      
                                                <td class="px-6 py-3">{{ $incident->created_at }}</td>    
                                                <td class="px-6 py-3">{{ $incident->updated_at }}</td>    
                                                <td class="px-6 py-3">
                                                    @if (Auth::id() === $incident->user_id)
                                                        <a href="{{ route('dashboard.edit', ['dashboard' => $incident->id]) }}" 
                                                           class="px-4 py-2 text-white text-sm rounded-md shadow bg-black">
                                                           Edit
                                                        </a>
                                                    @endif
                                                </td>   
                                                <td class="px-6 py-3">
                                                    <a href="{{ route('incident.downloadPDF', ['id' => $incident->id]) }}" 
                                                        class="px-4 py-2 bg-gray-500 text-white text-sm rounded-md shadow hover:bg-gray-700 transition">
                                                        View
                                                    </a>
                                                </td>
                                                <td class="px-6 py-3">
                                                    @if (Auth::id() === $incident->user_id)
                                                        <form action="{{ route('dashboard.destroy', ['dashboard' => $incident->id]) }}" method="POST" class="delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" 
                                                                    class="px-4 py-2 bg-red-600 text-white text-sm rounded-md shadow hover:bg-red-800 transition delete-btn">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>                
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="profile-modal" class="fixed inset-0 flex justify-center items-center bg-gray-900 bg-opacity-50 hidden">
        <div class="bg-white p-8 rounded-lg shadow-lg w-1/3">
            <button id="close-modal" class="absolute top-2 right-2 text-gray-600 hover:text-gray-800">&times;</button>
            <p class="mb-6">You must update your profile before creating an incident. Click below to go to your profile.</p>
            <div class="flex justify-center">
                <form action="{{ route('profile.edit') }}" method="GET">
                    <button type="submit" class="px-4 py-2 bg-gray-500 text-white text-sm rounded-md shadow hover:bg-gray-700 transition">
                        Update Profile
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var profileUpdated = {{ Auth::user()->profile_updated ? 'true' : 'false' }};

            document.getElementById('create-button').addEventListener('click', function(event) {
                event.preventDefault();

                if (!profileUpdated) {
                    document.getElementById('profile-modal').classList.remove('hidden');
                } else {
                    window.location.href = "{{ route('dashboard.create') }}";
                }
            });

            document.getElementById('close-modal').addEventListener('click', function() {
                document.getElementById('profile-modal').classList.add('hidden');
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); 
            if (confirm('Are you sure you want to delete this incident?')) {
                this.submit();
            }
        });
    });
});

    </script>
</x-app-layout>
