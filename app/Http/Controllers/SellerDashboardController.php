<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class SellerDashboardController extends Controller
{
   public function index()
{
    $user = Auth::user();
    $user->load('skills');

    if ($user->role == 'seller') {
        $userSkills = $user->skills;
        $activeJobCards = $user->activeJobCards; // Assuming you have defined this relationship in the Seller model
        $mostRecentJobCard = $user->mostRecentJobCard; // Assuming you have defined this relationship in the Seller model

        // Load assigned jobs for the seller
        $assignedJobs = $user->assignedJobs; // Assuming you have defined this relationship in the Seller model

        return view('sellers.dashboard', compact('userSkills', 'activeJobCards', 'mostRecentJobCard', 'assignedJobs'));
    } else {
        return redirect()->route('client.dashboard');
    }
}

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:seller');
    }
}
