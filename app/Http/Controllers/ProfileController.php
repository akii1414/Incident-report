<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        // 
    }
    

    /**
     * Show the form for editing the specified resource.
     */

    public function edit()
    {
        $user = Auth::user()->load('profile');
        return view('profile.edit', compact('user'));
    }
    
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
    
        $request->validate([
            'position' => 'nullable|string',
            'division' => 'nullable|string',
            'middle_name' => 'nullable|string',
            'mobile_number' => 'required|string|size:11|regex:/^\d{11}$/', 
            'local_number' => 'required|string|size:4|regex:/^\d{4}$/',  
            'birthday' => 'nullable|date',
            'gender' => 'nullable|string|in:Male,Female,Other',
        ]);
        
    
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'position' => $request->position,
                'division' => $request->division,
                'middle_name' => $request->middle_name,
                'mobile_number' => $request->mobile_number,
                'local_number' => $request->local_number,
                'birthday' => $request->birthday,
                'gender' => $request->gender,
            ]
        );
    
        $user->profile_updated = true;
        $user->save();
    
        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();
    
        $profile = Profile::where('user_id', $user->id)->first();
    
        if ($profile) {
            Incident::where('user_id', $profile->user_id)->delete();
    
            $profile->delete();
        }
    
        Auth::logout();
        $user->delete();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/')->with('status', 'Account, profile, and related incidents deleted successfully.');
    }
}
