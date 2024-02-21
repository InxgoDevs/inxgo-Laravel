<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\Job; // Adjust the model name

class DashboardController extends Controller
{
    public function index()
    {
        // Check if the user is authenticated
        if (auth()->check()) {
            // Determine the user role (seller or client) and redirect accordingly
            $role = auth()->user()->role;

            if ($role === 'seller') {
                return $this->sellerDashboard();
            } elseif ($role === 'client') {
                return $this->clientDashboard();
            }
        }

        // Handle other roles or scenarios here
        return redirect()->route('login'); // Redirect to the login page if the user is not authenticated
    }

    protected function sellerDashboard()
    {
        $userSkills = auth()->user()->skills; // Assuming you have a 'skills' relationship on your User model
        $activeJobs = Job::where('status', 'active')->get();
        $mostRecentJob = Job::where('user_id', auth()->id())->latest()->first(); // Adjust the model name

        return view('sellers.dashboard', compact('userSkills', 'activeJobs', 'mostRecentJob'));
    }

    protected function clientDashboard()
    {
        $allSkills = Skill::all();
        $activeJobs = Job::where('status', 'active')->get();
        $mostRecentJob = Job::latest()->first(); // Adjust the model name

        return view('client.dashboard', compact('allSkills', 'activeJobs', 'mostRecentJob'));
    }
}
