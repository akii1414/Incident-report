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
                                <form id="incidentForm" method="POST" action="{{ route('dashboard.update',['dashboard' => $incident->id]) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
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
                                        <input type="text" class="form-control mb-3" id="incident_description" name="incident_description" rows="3" placeholder="Enter a description..." value = "{{ $incident->incident_description }}">
                                        <label for="imageUpload" class="form-label">Upload Image</label>
                                        <input class="form-control" type="file" id="imageUpload" name="imageUpload" value="{{ $incident->imageUpload }}">
                                    </div>
                            
                                    <div class="border p-3 mb-4">
                                        <h6 class="mb-3"><strong>III.</strong> Impact / Potential Impact</h6>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="lossOfData" name="loss_data">
                                            <label class="form-check-label" for="lossOfData">Loss of Data</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="damageOfSystem" name="damage">
                                            <label class="form-check-label" for="damageOfSystem">Damage of System</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="systemDowntime" name="downtime">
                                            <label class="form-check-label" for="systemDowntime">System Downtime</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="orgSystemAffected" name="affected" >
                                            <label class="form-check-label" for="orgSystemAffected">Organization's System Affected</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="unknown" name="unknown" >
                                            <label class="form-check-label" for="unknown">Unknown at this time</label>
                                        </div>
                                    </div>
                            
                                    <div class="border p-3 mb-4">
                                        <h6 class="mb-3"><strong>IV.</strong> Who else have been notified? <br> (Please provide name of person/s)</h6>
                                        <div class="mb-3">
                                            <label for="description" class="form-label"></label>
                                            <input type="text" class="form-control" value="{{$incident->description }}" id="description" name="description" rows="3" placeholder="Enter a description...">
                                        </div>
                            
                                    <div class="border p-3 mb-4">
                                        <h6 class="mb-3"><strong>V.</strong> What Steps Have Been Taken?</h6>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="disconnectedFromNetwork" name="disconnected">
                                            <label class="form-check-label" for="disconnectedFromNetwork">System Disconnected from Network</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="callNMS" name="nms" >
                                            <label class="form-check-label" for="callNMS">Call NMS to report the delay</label>
                                        </div>
                            
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="updatedVirusDefinitions" name="update_virus">
                                            <label class="form-check-label" for="updatedVirusDefinitions">Updated virus definitions & scanned system</label>
                                        </div>
                            
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="logFilesExamined" name="log_files">
                                            <label class="form-check-label" for="logFilesExamined">Log files examined (saved and secured)</label>
                                        </div>
                            
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="others" name="others">
                                            <label class="form-check-label" for="others">Others - Please Describe Below</label>
                                            <textarea class="form-control" id="otherStepsDescription" name="otherStepsDescription" rows="3" placeholder="Describe other steps taken..."></textarea>
                                        </div>
                                    </div>
                            
                                    <div class="border p-3 mb-4">
                                        <h6 class="mb-3"><strong>VI.</strong> Incident Details</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="incident_discovery_time" class="form-label">Date & Time Discovered:</label>
                                                <input type="datetime-local" class="form-control" id="incident_discovery_time" name="incident_discovery_time" value="{{ $incident->incident_discovery_time }}" >
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
                                            <input type="text" class="form-control" id="location" name="location" placeholder="Enter physical location" value="{{ $incident->location }}">
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="sites_affected" class="form-label">Number of sites affected by the incident:</label>
                                            <input type="number" class="form-control" id="sites_affected" name="sites_affected" placeholder="Enter number of sites affected" value="{{ $incident->sites_affected }}">
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="systems_affected" class="form-label">Approximate number of systems affected by the incident:</label>
                                            <input type="number" class="form-control" id="systems_affected" name="systems_affected" placeholder="Enter number of systems affected" value="{{ $incident->system_affected }}">
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="users_affected" class="form-label">Approximate number of users affected by the incident:</label>
                                            <input type="number" class="form-control" id="users_affected" name="users_affected" placeholder="Enter number of users affected" value="{{ $incident->users_affected }}">
                                        </div>
                                        <br>
                                        <label for="additional_info" class="form-label">Additional Information:</label>
                                        <input type="text" class="form-control" id="additional_info" name="additional_info" rows="3" placeholder="Enter additional details..." value="{{ $incident->additional_info }}">
                                    </div>

                                </form>
                                <div>
                                    <button type="submit" class="btn btn-secondary" >Close</button>
                                    <button type="submit" class="btn btn-primary" form="incidentForm">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>