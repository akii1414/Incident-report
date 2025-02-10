<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IncidentController extends Controller
{
    public function index()
    {
        $incident_details = Incident::all();
        return view('index', compact('incident_details'));
    }
    
    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'nullable|string|max:1000',
            'status' => 'nullable|string|in:Open,Closed,In Progress',
            'subject' => 'nullable|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_descriptions.*' => 'nullable|string|max:255',
            'impact' => 'nullable|array',
            'steps' => 'nullable|array',
            'other_steps_description' => 'nullable|string|max:1000',
            'incident_discovery_time' => 'required|date',
            'incident_resolved' => 'nullable|in:Yes,No',
            'location' => 'nullable|string|max:255',
            'sites_affected' => 'nullable|integer|min:0',
            'systems_affected' => 'nullable|integer|min:0',
            'users_affected' => 'nullable|integer|min:0',
            'additional_info' => 'nullable|string|max:1000',
        ]);

        $steps = $request->steps ?? [];
        $other_steps = $request->other_steps_description ?? null;
        if ($other_steps) {
            $steps[] = "Others";
        }
        
        $new_incident = Incident::create([
            'description' => $request->description ?? 'No description provided',
            'subject' => $request->subject ?? 'No subject',
            'status' => $request->status ?? 'Open',
            'impact' => json_encode($request->impact ?? []),
            'steps' => json_encode($steps),
            'incident_discovery_time' => $request->incident_discovery_time,
            'incident_resolved' => $request->incident_resolved ?? 'No',
            'location' => $request->location ?? 'Unknown location',
            'sites_affected' => $request->sites_affected ?? 0,
            'systems_affected' => $request->systems_affected ?? 0,
            'users_affected' => $request->users_affected ?? 0,
            'additional_info' => $request->additional_info ?? null,
            'other_steps_description' => $other_steps,
        ]);
    
        if ($request->hasFile('images')) {
            $imageData = [];
            $imageDescriptions = $request->image_descriptions ?? [];
    
            foreach ($request->file('images') as $index => $image) {
                $imagePath = $image->store('public');
                $imageDescription = $imageDescriptions[$index] ?? 'No description';
    
                $imageData[] = [
                    'path' => $imagePath,
                    'image_descriptions' => $imageDescription,
                ];
            }
            $new_incident->update([
                'images' => json_encode($imageData),
            ]);
        }
        return redirect()->route('dashboard.index')->with('success', 'Incident created successfully');
    }
    
    public function show($id)
    {
        $incident_details = Incident::findOrFail($id);
        $incident_details->impact = json_decode($incident_details->impact, true);
        $incident_details->steps = json_decode($incident_details->steps, true);
        $incident_details->images = json_decode($incident_details->images, true);  

        return view('show', compact('incident_details'));
    }
    
    public function edit(string $id)
    {
        $incident = Incident::findOrFail($id);
        return view('edit', compact('incident'));
    }

    public function update(Request $request, string $id)
    {
        $incident_details = Incident::findOrFail($id);
        $validated = $request->validate([
            'subject' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'status' => 'nullable|string|in:Open,Closed,In Progress',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_descriptions.*' => 'nullable|string|max:255',
            'impact' => 'nullable|array',
            'steps' => 'nullable|array',
            'other_steps_description' => 'nullable|string|max:1000',
            'incident_resolved' => 'nullable|in:Yes,No',
            'location' => 'nullable|string|max:255',
            'sites_affected' => 'nullable|integer|min:0',
            'systems_affected' => 'nullable|integer|min:0',
            'users_affected' => 'nullable|integer|min:0',
            'additional_info' => 'nullable|string|max:1000',
            'incident_discovery_time' => 'nullable|date',
        ]);
    
        $steps = $request->steps ?? [];
        $other_steps = $request->other_steps_description ?? null; 
        if ($other_steps) {
            $steps[] = "Others";
        }
        if ($request->hasFile('images')) {
            $imageData = [];
            $imageDescriptions = $request->image_descriptions ?? [];
    
            foreach ($request->file('images') as $index => $image) {
                $imagePath = $image->store('public');
                $imageData[] = [
                    'path' => $imagePath,
                    'image_descriptions' => $imageDescriptions[$index] ?? 'No description',
                ];
            }
    
            $incident_details->update([
                'images' => json_encode($imageData),
            ]);
        }
    
        $incident_details->update([
            'subject' => $validated['subject'] ?? $incident_details->subject,
            'description' => $validated['description'] ?? $incident_details->description,
            'status' => $validated['status'] ?? $incident_details->status,
            'impact' => json_encode($validated['impact'] ?? json_decode($incident_details->impact, true)),
            'steps' => json_encode($steps),
            'incident_discovery_time' => $validated['incident_discovery_time'] ?? $incident_details->incident_discovery_time,
            'incident_resolved' => $validated['incident_resolved'] ?? $incident_details->incident_resolved,
            'location' => $validated['location'] ?? $incident_details->location,
            'sites_affected' => $validated['sites_affected'] ?? $incident_details->sites_affected,
            'systems_affected' => $validated['systems_affected'] ?? $incident_details->systems_affected,
            'users_affected' => $validated['users_affected'] ?? $incident_details->users_affected,
            'additional_info' => $validated['additional_info'] ?? $incident_details->additional_info,
            'other_steps_description' => $other_steps,

        ]);
        return redirect()->route('dashboard.index')->with('success', 'Incident updated successfully');
    }
    

    public function destroy($id)
    {
        $incident_details = Incident::findOrFail($id);

        if ($incident_details->images) {
            foreach (json_decode($incident_details->images) as $image) {
                Storage::disk('public')->delete($image->path);
            }
        }        
        $incident_details->delete();
        return redirect()->route('dashboard.index')->with('success', 'Incident deleted successfully');
    }

    public function downloadPDF($id)
    {
        $incident_details = Incident::findOrFail($id);
        $incident_details->impact = json_decode($incident_details->impact, true);
        $incident_details->steps = json_decode($incident_details->steps, true);
        $pdf = PDF::loadView('pdf.incident_report', ['data' => $incident_details]);
        return $pdf->stream();
        // return $pdf->download('Incident_Report_' . $incident_details->id . '.pdf');
    }
}
