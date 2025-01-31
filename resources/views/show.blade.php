<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Incident Reports') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <form id="incidentForm" method="" enctype="multipart/form-data">

                        <div class="mb-3">
                            <strong>Full Name:</strong> {{ Auth::user()->name }}
                        </div>
                        
                        <div class="mb-3">
                            <strong>Email:</strong> {{ Auth::user()->email }}
                        </div>                        

                        <div class="mb-3">
                            <strong>Incident Description:</strong> {{ $incident_details['incident_description'] }}
                        </div>

                        {{-- @if ($imagePath)
                            <div class="mb-3">
                                <strong>Uploaded Image:</strong><br>
                                <img src="{{ asset('storage/' . $imagePath) }}" alt="Incident Image" class="img-fluid" width="300">
                            </div>
                        @endif --}}

                        <div class="mb-3">
                            <strong>Impact:</strong>
                            <ul>
                                @foreach ($incident_details['impact'] as $impact)
                                    <li>{{ $impact }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="mb-3">
                            <strong>Who Else Was Notified:</strong> {{ $incident_details['description'] ?? 'No one specified' }}
                        </div>

                        <div class="mb-3">
                            <strong>Steps :</strong>
                            <ul>
                                @foreach ($incident_details['steps'] as $step)
                                    <li>{{ $step }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="mb-3">
                            <strong>Date & Time Discovered:</strong> {{ $incident_details['incident_discovery_time'] }}
                        </div>

                        <div class="mb-3">
                            <strong>Incident Resolved:</strong> {{ $incident_details['incident_resolved'] }}
                        </div>

                        <div class="mb-3">
                            <strong>Location of Affected System(s):</strong> {{ $incident_details['location'] }}
                        </div>

                        <div class="mb-3">
                            <strong>Sites Affected:</strong> {{ $incident_details['sites_affected'] }}
                        </div>

                        <div class="mb-3">
                            <strong>Systems Affected:</strong> {{ $incident_details['systems_affected'] }}
                        </div>

                        <div class="mb-3">
                            <strong>Users Affected:</strong> {{ $incident_details['users_affected'] }}
                        </div>

                        <div class="mb-3">
                            <strong>Additional Information:</strong> {{ $incident_details['additional_info'] ?? 'None' }}
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('dashboard.index') }}" class="btn btn-secondary">Close</a>
                        </div>    
                        </form>                  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
          function downloadPDF() {
            const form = document.getElementById('incidentForm');
            const formData = new FormData(form);
            
            fetch('{{ route("incident.downloadPDF") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: formData
        })

            .then(response => {
                if (response.ok) {
                    return response.blob();
                }
                throw new Error('Failed to generate PDF');
            })
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'incident_report.pdf';
                document.body.appendChild(a);
                a.click();
                a.remove();
            })
            .catch(error => {
                console.error(error);
                alert('Error generating PDF. Please try again.');
            });
        }
    </script>
</x-app-layout>
