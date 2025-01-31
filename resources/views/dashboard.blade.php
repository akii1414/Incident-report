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
                        <div class="card">
                            <div class="card-header">
                                <button type="button" class="btn btn-success btn-sm float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Add New
                                </button>                            
                            </div>
                            @if (Session::has('success'))
                                <span class="alert alert-success p-2">{{ Session::get('success') }}</span>
                            @endif
                            @if (Session::has('fail'))
                                <span class="alert alert-danger p-2">{{ Session::get('fail') }}</span>
                            @endif
                            <div class="card-body">
                                <table class="table table-sm table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Incident ID</th>
                                            <th>Subject</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Last Update</th>
                                            <th colspan="2">Action</th>
                                        </tr>
                                    </thead>
                                  {{-- <tbody>
                                        @if ($incident_details)
                                                <tr>
                                                    <td>{{$incident_details->subject }}</td>
                                                    <td>{{ $incident_details->description }}</td>
                                                    <td>{{ $incident_details->status }}</td>
                                                    <td>{{ $incident_details->created_at }}</td>
                                                    <td>{{ $incident_details->updated_at }}</td>
                                                    <td><a href="{{ route('dashboard.edit', ['dashboard' => $incident_details->id]) }}" class="btn btn-primary btn-sm">Edit</a></td>
                                                    <td>
                                                        <form action="{{ route('dashboard.destroy', ['dashboard' => $incident_details->id]) }}" method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <tr>
                                                <td colspan="7">No User Found!</td>
                                            </tr>
                                        @endif
                                    </tbody> --}}
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Incident Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="incidentForm" method="POST" action="{{ route('dashboard.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="border p-3 mb-4">
                            <h6 class="mb-3"><strong>I.</strong> Incident Information</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="fullName" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="fullName" name="fullName" value="{{ Auth::user()->name }}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="border p-3 mb-4">
                            <h6 class="mb-3"><strong>II.</strong> Incident Description</h6>
                            <label for="incident_description" class="form-label">Brief Description (Include screenshots/images if available):</label>
                            <textarea class="form-control mb-3" id="incident_description" name="incident_description" rows="3" placeholder="Enter a description..."></textarea>
                            <label for="imageUpload" class="form-label">Upload Image</label>
                            <input class="form-control" type="file" id="imageUpload" name="imageUpload">
                        </div>

                        <div class="border p-3 mb-4">
                            <h6 class="mb-3"><strong>III.</strong> Impact / Potential Impact</h6>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="lossOfData" name="impact[]" value="Loss of Data">
                                <label class="form-check-label" for="lossOfData">Loss of Data</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="damageOfSystem" name="impact[]" value="Damage of System">
                                <label class="form-check-label" for="damageOfSystem">Damage of System</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="systemDowntime" name="impact[]" value="System Downtime">
                                <label class="form-check-label" for="systemDowntime">System Downtime</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="orgSystemAffected" name="impact[]" value="Organization's System Affected">
                                <label class="form-check-label" for="orgSystemAffected">Organization's System Affected</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="unknown" name="impact[]" value="Unknown at this time">
                                <label class="form-check-label" for="unknown">Unknown at this time</label>
                            </div>
                        </div>

                        <div class="border p-3 mb-4">
                            <h6 class="mb-3"><strong>IV.</strong> Who else have been notified? <br> (Please provide name of person/s)</h6>
                            <div class="mb-3">
                                <label for="description" class="form-label"></label>
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter a description..."></textarea>
                            </div>

                        <div class="border p-3 mb-4">
                            <h6 class="mb-3"><strong>V.</strong> What Steps Have Been Taken?</h6>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="disconnectedFromNetwork" name="steps[]" value="System Disconnected from Network">
                                <label class="form-check-label" for="disconnectedFromNetwork">System Disconnected from Network</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="callNMS" name="steps[]" value="Call NMS to report the delay">
                                <label class="form-check-label" for="callNMS">Call NMS to report the delay</label>
                            </div>
    
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="updatedVirusDefinitions" name="steps[]" value="Updated virus definitions & scanned system">
                                <label class="form-check-label" for="updatedVirusDefinitions">Updated virus definitions & scanned system</label>
                            </div>
    
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="logFilesExamined" name="steps[]" value="Log files examined (saved and secured)">
                                <label class="form-check-label" for="logFilesExamined">Log files examined (saved and secured)</label>
                            </div>
    
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="others" name="steps[]" value="Others">
                                <label class="form-check-label" for="others">Others - Please Describe Below</label>
                                <textarea class="form-control" id="otherStepsDescription" name="otherStepsDescription" rows="3" placeholder="Describe other steps taken..."></textarea>
                            </div>
                        </div>

                        <div class="border p-3 mb-4">
                            <h6 class="mb-3"><strong>VI.</strong> Incident Details</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="incident_discovery_time" class="form-label">Date & Time Discovered:</label>
                                    <input type="datetime-local" class="form-control" id="incident_discovery_time" name="incident_discovery_time" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="incident_resolved" class="form-label">Has the incident been resolved?</label>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="incident_resolved_yes" name="incident_resolved" value="Yes">
                                        <label class="form-check-label" for="incident_resolved_yes">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="incident_resolved_no" name="incident_resolved" value="No">
                                        <label class="form-check-label" for="incident_resolved_no">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="location" class="form-label">Physical location of affected system(s):</label>
                                <input type="text" class="form-control" id="location" name="location" placeholder="Enter physical location">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="sites_affected" class="form-label">Number of sites affected by the incident:</label>
                                <input type="number" class="form-control" id="sites_affected" name="sites_affected" placeholder="Enter number of sites affected">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="systems_affected" class="form-label">Approximate number of systems affected by the incident:</label>
                                <input type="number" class="form-control" id="systems_affected" name="systems_affected" placeholder="Enter number of systems affected">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="users_affected" class="form-label">Approximate number of users affected by the incident:</label>
                                <input type="number" class="form-control" id="users_affected" name="users_affected" placeholder="Enter number of users affected">
                            </div>
                            <br>
                            <label for="additional_info" class="form-label">Additional Information:</label>
                            <textarea class="form-control" id="additional_info" name="additional_info" rows="3" placeholder="Enter additional details..."></textarea>
                        </div>

                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="incidentForm">Save</button>
                    <button type="button" class="btn btn-primary" id="downloadPdfButton" onclick="downloadPDF()">Download PDF</button>
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
