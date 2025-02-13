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
        $user = Auth::user();
        $profile = $user->profile;
    
        return view('profile.edit', compact('user', 'profile'));
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
            'first_name' => 'nullable|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'mobile_phone' => 'nullable|string|max:20',
            'local_phone' => 'nullable|string|max:20',
            'birthday' => 'nullable|date',
            'gender' => 'nullable|string|in:Male,Female,Other',
        ]);
    
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'position' => $request->position,
                'division' => $request->division,
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'mobile_number' => $request->mobile_number,
                'local_number' => $request->local_number,
                'birthday' => $request->birthday,
                'gender' => $request->gender,
            ]
        );
    
        $user->profile_updated = true;
        $user->save();
    
        return redirect()->route('dashboard.index')->with('success', 'Profile updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
