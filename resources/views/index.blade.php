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
                                <a class="btn btn-success btn-sm float-end" href="{{ route('dashboard.create') }}">Create</a>                            
                            </div>
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
                                            <th colspan="3">Action</th>
                                        </tr>
                                        <tbody>
                                            @foreach ($incident_details as $incident )
                                                <tr>
                                                    <td> {{ $incident->id }} </td>    
                                                    <td> {{ $incident->subject }} </td>    
                                                    <td> {{ $incident->status }} </td>    
                                                    <td> {{ $incident->description }} </td>    
                                                    <td> {{ $incident->created_at }} </td>    
                                                    <td> {{ $incident->updated_at }} </td>    
                                                    <td>
                                                        <a href="{{ route('dashboard.edit' , ['dashboard' => $incident->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                                                    </td>    
                                                    <td> <a href="{{ route('dashboard.show',['dashboard' => $incident->id]) }}" class="btn btn-sm btn-primary" >View</a></td>
                                                    <td>
                                                        <form action="{{ route('dashboard.destroy', ['dashboard' => $incident->id]) }}" method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>                
                                            @endforeach
                                        </tbody>
                                    </thead>
                                </table>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>