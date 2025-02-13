<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Incident Reports') }}
        </h2>
    </x-slot>
    <style>
            .container {
                background: #ffffff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            .mb-3 {
                font-size: 1.1rem;
                font-weight: bold;
                margin-bottom: 15px;
                border-bottom: 2px solid #ccc;
                padding-bottom: 5px;
            }
            .btn-primary {
                background-color: #007bff;
                border-color: #007bff;
            }
            .btn-primary:hover {
                background-color: #0056b3;
            }
            .btn-secondary {
                background-color: #6c757d;
            }
            .form-control {
                border-radius: 8px;
                border: 1px solid #ced4da;
                padding: 10px;
            }
    </style>
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
                                                <div class="col-md-6">
                                                    <label for="position" class="form-label">Position Title</label>
                                                    <input type="text" class="form-control" id="position" name="position" value="{{ Auth::user()->profile->position }}" readonly>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <label for="division" class="form-label">Division/ Section</label>
                                                    <input type="text" class="form-control" id="division" name="division" value="{{ Auth::user()->profile->division}}" readonly>
                                                </div>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <div>
                                                    <label for="additional_info" class="form-label">Subject:</label>
                                                    <input type="text" class="form-control" id="subject" name="subject" rows="3" placeholder="Enter subject" value="{{ $incident->subject }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border p-3 mb-4">
                                            <h6 class="mb-3"><strong>II.</strong> Incident Description</h6>
                                            <label for="incident_description" class="form-label">Brief Description (Include screenshots/images if available):</label>
                                            <div id="image-upload-container">
                                                    <input class="form-control" type="text" name="image_descriptions[]" placeholder="Enter image description..." >
                                                    <label for="images" class="form-label">Upload Images</label>
                                                    <input class="form-control mb-2" type="file" name="images[]" accept="image/*" >
                                            </div>
                                            <button type="button" class="btn btn-sm btn-success mt-2" onclick="addImageField()">Add Another Image</button>
                                        </div>

                                        <div class="border p-3 mb-4">
                                            <h6 class="mb-3"><strong>III.</strong> Impact / Potential Impact</h6>
                                            @php
                                                $impact = json_decode($incident->impact, true) ?? [];
                                            @endphp
                                            @foreach (['Loss of Data', 'Damage of System', 'System Downtime', "Organization's System Affected", 'Unknown at this time'] as $option)
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="impact[]" value="{{ $option }}" {{ in_array($option, $impact) ? 'checked' : '' }}>
                                                    <label class="form-check-label">{{ $option }}</label>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="border p-3 mb-4">
                                            <h6 class="mb-3"><strong>IV.</strong> Who else has been notified? (Please provide name of person/s)</h6>
                                            <input type="text" class="form-control" id="description" name="description" value="{{ $incident->description }}" placeholder="Enter names...">
                                        </div>
                                        <div class="border p-3 mb-4">
                                            <h6 class="mb-3"><strong>V.</strong> What Steps Have Been Taken?</h6>
                                            @php
                                                $steps = json_decode($incident->steps, true);
                                                $steps = is_array($steps) ? $steps : []; 
                                            @endphp
                                            @foreach (['System Disconnected from Network', 'Call NMS to report the delay', 'Updated virus definitions & scanned system', 'Log files examined (saved and secured)'] as $step)
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="steps[]" value="{{ $step }}" {{ in_array($step, $steps) ? 'checked' : '' }}>
                                                    <label class="form-check-label">{{ $step }}</label>
                                                </div>
                                            @endforeach
                                            
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="others" onchange="toggleOtherDescription()" {{ !empty($incident->other_steps_description) ? 'checked' : '' }}>
                                                <label class="form-check-label">Others - Please Describe Below</label>
                                            </div>
                                            
                                            <textarea class="form-control mt-2" id="other_steps_description" name="other_steps_description" rows="3" placeholder="Describe other steps..." {{ empty($incident->other_steps_description) ? 'disabled' : '' }}>
                                                {{ old('other_steps_description', $incident->other_steps_description ?? '') }}
                                            </textarea>  
                                        </div>
                                        <div class="border p-3 mb-4">
                                            <h6 class="mb-3"><strong>VI.</strong> Incident Details</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="incident_discovery_time" class="form-label">Date & Time Discovered:</label>
                                                    <input type="datetime-local" class="form-control" id="incident_discovery_time" name="incident_discovery_time" value="{{ $incident->incident_discovery_time }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Has the incident been resolved?</label>
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" name="incident_resolved" value="Yes" {{ $incident->incident_resolved == 'Yes' ? 'checked' : '' }}>
                                                        <label class="form-check-label">Yes</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" name="incident_resolved" value="No" {{ $incident->incident_resolved == 'No' ? 'checked' : '' }}>
                                                        <label class="form-check-label">No</label>
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
                                        <div class="col text-end">
                                            <button type="submit" class="btn btn-secondary">Close</button>
                                            <button type="submit" class="btn btn-primary" form="incidentForm">Save</button>
                                        </div>  
                                </form>                           
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function addImageField() {
            let container = document.getElementById('image-upload-container');
            let div = document.createElement('div');
            div.classList.add( 'mb-2');
            div.innerHTML = `
                <input class="form-control" type="text" name="image_descriptions[]" placeholder="Enter image description...">
                Upload Images
                <input class="form-control mb-2" type="file" name="images[]" accept="image/*">
            `;
            container.appendChild(div);

        }
        function toggleOtherDescription() {
            let otherDescriptionField = document.getElementById('other_steps_description');
            let othersCheckbox = document.getElementById('others');
            
            if (othersCheckbox.checked) {
                otherDescriptionField.disabled = false;
            } else {
                otherDescriptionField.disabled = true;
                otherDescriptionField.value = ""; 
            }
        }
    </script>
</x-app-layout>