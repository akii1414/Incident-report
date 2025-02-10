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
                            <table class="table table-sm table-bordered border-collapse ">
                                <tbody>
                                    <tr class="border bg-blue-200">
                                        <td class="p-2 font-bold w-1/2">Full Name:</td>
                                        <td class="p-2 w-1/2">{{ Auth::user()->name }}</td>
                                    </tr>
                                    <tr class="border">
                                        <td class="p-2 font-bold">Email:</td>
                                        <td class="p-2">{{ Auth::user()->email }}</td>
                                    </tr>

                                    <tr class="border bg-blue-200">
                                        <td class="p-2 font-bold">Incident Description:</td>
                                        <td class="p-2">
                                            @foreach(is_string($incident_details->images) ? json_decode($incident_details->images, true) : $incident_details->images as $image)
                                                <div class="mb-2">
                                                    <img src="{{ Storage::url($image['path']) }}" width="200" style="display: block; margin-bottom: 5px;">
                                                    <p>{{ $image['image_descriptions'] }}</p>
                                                </div>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr class="border">
                                        <td class="p-2 font-bold">Impact:</td>
                                        <td class="p-2">
                                            <ul>
                                                @foreach ($incident_details['impact'] as $impact)
                                                    <li>{{ $impact }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr class="border bg-blue-200">
                                        <td class="p-2 font-bold">Who Else Was Notified:</td>
                                        <td class="p-2">{{ $incident_details['description'] ?? 'No one specified' }}</td>
                                    </tr>
                                    <tr class="border">
                                        <td class="p-2 font-bold">Steps Taken:</td>
                                        <td>
                                            <ul>
                                                @php
                                                    $steps = is_array($incident_details->steps) ? $incident_details->steps : json_decode($incident_details->steps, true);
                                                @endphp
                                                @foreach($steps as $step)
                                                    <li>{{ $step }}</li>
                                                @endforeach
                                                
                                                @if(!empty($incident_details->other_steps_description))
                                                    <li> {{ $incident_details->other_steps_description }}</li>
                                                @endif
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr class="border bg-blue-200">
                                        <td class="p-2 font-bold">Date & Time Discovered:</td>
                                        <td class="p-2">{{ $incident_details['incident_discovery_time'] }}</td>
                                    </tr>
                                    <tr class="border">
                                        <td class="p-2 font-bold">Incident Resolved:</td>
                                        <td class="p-2">{{ $incident_details['incident_resolved'] }}</td>
                                    </tr>
                                    <tr class="border bg-blue-200">
                                        <td class="p-2 font-bold">Location of Affected System(s):</td>
                                        <td class="p-2">{{ $incident_details['location'] }}</td>
                                    </tr>
                                    <tr class="border">
                                        <td class="p-2 font-bold">Sites Affected:</td>
                                        <td class="p-2">{{ $incident_details['sites_affected'] }}</td>
                                    </tr>
                                    <tr class="border bg-blue-200">
                                        <td class="p-2 font-bold">Systems Affected:</td>
                                        <td class="p-2">{{ $incident_details['systems_affected'] }}</td>
                                    </tr>
                                    <tr class="border">
                                        <td class="p-2 font-bold">Users Affected:</td>
                                        <td class="p-2">{{ $incident_details['users_affected'] }}</td>
                                    </tr>
                                    <tr class="border bg-blue-200">
                                        <td class="p-2 font-bold">Additional Information:</td>
                                        <td class="p-2">{{ $incident_details['additional_info'] ?? 'None' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="{{ route('dashboard.index') }}" class="btn btn-secondary">Close</a>
                                <a href="{{ route('incident.downloadPDF', ['id' => $incident_details['id']]) }}" class="btn btn-primary">Download PDF</a>
                            </div>                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
