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
                            </div>
                        </div>
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
