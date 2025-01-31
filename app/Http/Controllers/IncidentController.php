<?php

namespace App\Http\Controllers;

use App\Models\Incident;
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
            'imageUpload' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'incident_description' => 'nullable|string|max:1000',
            'impact' => 'nullable|array', 
            'steps' => 'nullable|array', 
            'incident_discovery_time' => 'required|date',
            'incident_resolved' => 'nullable|in:Yes,No',
            'location' => 'nullable|string|max:255',
            'sites_affected' => 'nullable|integer|min:0',
            'systems_affected' => 'nullable|integer|min:0',
            'users_affected' => 'nullable|integer|min:0',
            'additional_info' => 'nullable|string|max:1000',
        ]);
        $impacts = [
            "loss_Data" => $request->loss_data == "on" ? true : false,
            "damage_System" => $request->damage == "on" ? true : false,
            "system_Downtime" => $request->downtime == "on" ? true : false,
            "orgSystemAffected" => $request->affected == "on" ? true : false,
            "unknown" => $request->unknown == "on" ? true : false,
        ];
        $step = [
            "System_Disconnected_network" =>$request->disconnected == "on" ? true:false,
            "Call_nms" =>$request->nms == "on" ? true:false,
            "Update_virus_scanned_system" =>$request->virus == "on" ? true:false,
            "log_files_examined" =>$request->log_files == "on" ? true:false,
            "others" =>$request->others == "on" ? true:false,
        ];
            

    
        if ($request->hasFile('imageUpload')) {
            $image = $request->file('imageUpload');
            $imagePath = $image->store('incident_images', 'public'); 
        } else {
            $imagePath = null; 
        }
        

        $new_incident = new Incident;
        
        $new_incident->description = $request->description ?? 'No description provided';
        $new_incident->status = $request->status ?? 'Open';
        $new_incident->subject = $request->subject ?? 'No subject';
        $new_incident->imageUpload = $imagePath; 
        $new_incident->incident_description = $request->incident_description ?? 'No incident description';
        $new_incident->impact = $request->impacts ? json_encode($request->impacts) : json_encode([]); 
        $new_incident->steps = $request->steps ? json_encode($request->steps) : json_encode([]);
        $new_incident->incident_discovery_time = $request->incident_discovery_time ?? now();
        $new_incident->incident_resolved = $request->incident_resolved ?? 'No'; 
        $new_incident->location = $request->location ?? 'Unknown location';
        $new_incident->sites_affected = $request->sites_affected ?? 0;
        $new_incident->systems_affected = $request->systems_affected ?? 0;
        $new_incident->users_affected = $request->users_affected ?? 0;
        $new_incident->additional_info = $request->additional_info ?? null;
        
        if ($new_incident->save()) {
            return redirect()->route('dashboard.index')->with('success', 'Incident created successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to create incident');
        }
    
    }

    public function show($id)
    {
        $incident_details = Incident::findOrFail($id);
        
        $incident_details->impact = json_decode($incident_details->impact, true);
        $incident_details->steps = json_decode($incident_details->steps, true);


        return view('show', ['incident_details' => $incident_details]);
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
            'incident_description' => 'nullable|string|max:1000',
            'status' => 'nullable|string|in:Open,Closed,In Progress',
            'imageUpload' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'impact' => 'nullable|array', 
            'steps' => 'nullable|array', 
            'incident_discovery_time' => 'required|date',
            'incident_resolved' => 'nullable|in:Yes,No',
            'location' => 'nullable|string|max:255',
            'sites_affected' => 'nullable|integer|min:0',
            'systems_affected' => 'nullable|integer|min:0',
            'users_affected' => 'nullable|integer|min:0',
            'additional_info' => 'nullable|string|max:1000',
        ]);

        $impacts = [
            "loss_Data" => $request->loss_data == "on" ? true : false,
            "damage_System" => $request->damage == "on" ? true : false,
            "system_Downtime" => $request->downtime == "on" ? true : false,
            "orgSystemAffected" => $request->affected == "on" ? true : false,
            "unknown" => $request->unknown == "on" ? true : false,
        ];
        $steps = [
            "System_Disconnected_network" =>$request->disconnected == "on" ? true:false,
            "Call_nms" =>$request->nms == "on" ? true:false,
            "Update_virus_scanned_system" =>$request->update_virus == "on" ? true:false,
            "log_files_examined" =>$request->log_files == "on" ? true:false,
            "others" =>$request->others == "on" ? true:false,
        ];

        
        if ($request->hasFile('imageUpload')) {
            if ($incident_details->imageUpload) {
                Storage::disk('public')->delete($incident_details->imageUpload);
            }
    
            $imagePath = $request->file('imageUpload')->store('uploads/incidents', 'public');
            $validated['imageUpload'] = $imagePath; 
        } else {
            $validated['imageUpload'] = $incident_details->imageUpload;
        }
    
        $incident_details->update([
            'subject' => $validated['subject'] ?? $incident_details->subject,
            'description' => $validated['description'] ?? $incident_details->description,
            'incident_description' => $validated['incident_description'] ?? $incident_details->incident_description,
            'status' => $validated['status'] ?? $incident_details->status,
            "impact" => json_encode($impacts),
            "steps" => json_encode($steps),
            'incident_discovery_time' => $validated['incident_discovery_time'],
            'incident_resolved' => $validated['incident_resolved'] ?? $incident_details->incident_resolved,
            'location' => $validated['location'] ?? $incident_details->location,
            'sites_affected' => $validated['sites_affected'] ?? $incident_details->sites_affected,
            'systems_affected' => $validated['systems_affected'] ?? $incident_details->systems_affected,
            'users_affected' => $validated['users_affected'] ?? $incident_details->users_affected,
            'additional_info' => $validated['additional_info'] ?? $incident_details->additional_info,
            'imageUpload' => $validated['imageUpload'],
        ]);
    
        return redirect()->route('dashboard.index')->with('success', 'Incident created successfully');
    }
    
    public function destroy(string $id)
    {
        $incident_details = Incident::findOrFail($id);
        $incident_details->delete();
    
        return redirect()->route('dashboard.index')->with('success', 'Incident created successfully');
    }
    
}
