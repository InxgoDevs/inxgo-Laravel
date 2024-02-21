<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\Portfolio;


class UserController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();

        $user->load('skills'); // Eager load the user's skills
        $userSkills = $user->skills;
        $hourlyRate = $user->hourly_rate;

        return view('user.profile.show', compact('user', 'userSkills', 'hourlyRate'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        $skills = Skill::all(); // Assuming you have a Skill model
        // Convert hourly rate to the user's preferred currency
        $hourlyRate = $user->hourly_rate;

        return view('user.profile.edit', compact('user', 'skills', 'hourlyRate'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Validate the request
        $request->validate([
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'hourly_rate' => 'numeric',
            'self_introduction' => 'nullable|string',
            'portfolio_title.*' => 'nullable|string|max:255',
            'portfolio_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'skills.*' => 'exists:skills,id', // Validate that the selected skills exist
            // Add validation for other fields
        ]);

        // Convert the submitted hourly rate to the base currency before updating the database
        $baseHourlyRate = $request->input('hourly_rate');

        // Update user profile fields
        $user->update([
            'hourly_rate' => $baseHourlyRate,
            'self_introduction' => $request->input('self_introduction'),
            // other fields
        ]);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Upload and store the new profile image
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->update(['profile_image' => $imagePath]);
        }

        // Sync user's skills
        $user->skills()->sync($request->input('skills', []));

        // Handle portfolio uploads
        $this->updatePortfolio($request, $user);

        return redirect()->route('user.profile.show')->with('success', 'Profile updated successfully.');
    }

    private function updatePortfolio(Request $request, $user)
    {
        // Remove existing portfolio items
        Portfolio::where('user_id', $user->id)->delete();

        // Add new portfolio items
        foreach ($request->portfolio_title as $key => $title) {
            $portfolio = new Portfolio(['title' => $title]);

            // Handle portfolio image upload
            if ($request->hasFile('portfolio_image.' . $key)) {
                $imagePath = $request->file('portfolio_image.' . $key)->store('portfolio_images', 'public');
                $portfolio->image = $imagePath;
            }

            $user->portfolio()->save($portfolio);
        }
    }
    public function getUser()
    {
        $user = Auth::user();
        return response()->json(['user' => $user]);
    }
}
