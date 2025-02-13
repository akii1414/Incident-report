{{-- <x-app-layout>
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
                        <table class="w-full bg-white border border-gray-300 shadow-md rounded-lg">
                            <tbody>
                                <tr class="border-b border-gray-300 bg-gray-100">
                                    <td class="p-3 font-semibold text-gray-700 w-1/2">Full Name:</td>
                                    <td class="p-3">{{ Auth::user()->name }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <td class="p-3 font-semibold text-gray-700">Email:</td>
                                    <td class="p-3">{{ Auth::user()->email }}</td>
                                </tr>
                                <tr class="border-b border-gray-300 bg-gray-100">
                                    <td class="p-3 font-semibold text-gray-700">Subject:</td>
                                    <td class="p-3">{{ $incident_details['subject'] ?? 'None' }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <td class="p-3 font-semibold text-gray-700">Incident Description:</td>
                                    <td class="p-3">
                                        @foreach(is_string($incident_details->images) ? json_decode($incident_details->images, true) : $incident_details->images as $image)
                                            <div class="mb-3">
                                                <img src="{{ Storage::url($image['path']) }}" class="w-48 h-auto rounded-md shadow">
                                                <p class="mt-1 text-gray-600 italic">{{ $image['image_descriptions'] }}</p>
                                            </div>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-300 bg-gray-100">
                                    <td class="p-3 font-semibold text-gray-700">Impact:</td>
                                    <td class="p-3">
                                        <ul class="list-disc list-inside">
                                            @foreach ($incident_details['impact'] as $impact)
                                                <li>{{ $impact }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <td class="p-3 font-semibold text-gray-700">Who Else Was Notified:</td>
                                    <td class="p-3">{{ $incident_details['description'] ?? 'No one specified' }}</td>
                                </tr>
                                <tr class="border-b border-gray-300 bg-gray-100">
                                    <td class="p-3 font-semibold text-gray-700">Steps Taken:</td>
                                    <td class="p-3">
                                        <ul class="list-disc list-inside">
                                            @php
                                                $steps = is_array($incident_details->steps) ? $incident_details->steps : json_decode($incident_details->steps, true);
                                            @endphp
                                            @foreach($steps as $step)
                                                <li>{{ $step }}</li>
                                            @endforeach
                                            @if(!empty($incident_details->other_steps_description))
                                                <li>{{ $incident_details->other_steps_description }}</li>
                                            @endif
                                        </ul>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <td class="p-3 font-semibold text-gray-700">Date & Time Discovered:</td>
                                    <td class="p-3">{{ $incident_details['incident_discovery_time'] }}</td>
                                </tr>
                                <tr class="border-b border-gray-300 bg-gray-100">
                                    <td class="p-3 font-semibold text-gray-700">Incident Resolved:</td>
                                    <td class="p-3">{{ $incident_details['incident_resolved'] }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <td class="p-3 font-semibold text-gray-700">Location of Affected System(s):</td>
                                    <td class="p-3">{{ $incident_details['location'] }}</td>
                                </tr>
                                <tr class="border-b border-gray-300 bg-gray-100">
                                    <td class="p-3 font-semibold text-gray-700">Sites Affected:</td>
                                    <td class="p-3">{{ $incident_details['sites_affected'] }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <td class="p-3 font-semibold text-gray-700">Systems Affected:</td>
                                    <td class="p-3">{{ $incident_details['systems_affected'] }}</td>
                                </tr>
                                <tr class="border-b border-gray-300 bg-gray-100">
                                    <td class="p-3 font-semibold text-gray-700">Users Affected:</td>
                                    <td class="p-3">{{ $incident_details['users_affected'] }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <td class="p-3 font-semibold text-gray-700">Additional Information:</td>
                                    <td class="p-3">{{ $incident_details['additional_info'] ?? 'None' }}</td>
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
</x-app-layout> --}}
