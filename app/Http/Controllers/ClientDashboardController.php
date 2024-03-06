<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use Illuminate\Support\Facades\Log;
use App\Events\NewJobRequest;
// Import FCM
use Brozot\LaravelFcm\Facades\Fcm;
use GetStream\StreamLaravel\Facades\FeedManager;
use App\Events\NewJobRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobRequestEmail;



class ClientDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Check if the user is a client
        if ($user->role == 'client') {
            // Get all skills available
            $allSkills = Skill::all();

            // Display active job cards (you may adjust this logic based on your requirements)
            $activeJobCards = Job::where('status', 'active')->get();

            // Get the most recent job card (you may adjust this logic based on your requirements)
            $mostRecentJobCard = Job::latest()->first();
// In your controller where you fetch nearby sellers
$nearbySellers = User::where('role', 'seller')->select('id', 'name', 'profile_image', 'fcm_token')->get();

// In your controller where you return the view
return view('client.dashboard', compact('allSkills', 'activeJobCards', 'mostRecentJobCard', 'nearbySellers'));
        } 
        else {
            // Redirect to the seller dashboard or handle accordingly
            return redirect()->route('seller.dashboard');
        }
    }
public function sendJobRequest(Request $request)
{
    $skillId = $request->input('skill_id');

    // Find sellers who have the requested skill
    $sellers = User::whereHas('skills', function ($query) use ($skillId) {
        $query->where('id', $skillId);
    })->where('role', 'seller')->get();

    foreach ($sellers as $seller) {
        // Send email to each seller
        Mail::to($seller->email)->send(new JobRequestEmail($skillId));
    }

    return response()->json(['message' => 'Job request sent successfully']);
}





}

