<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class SellerDashboardApiController extends Controller
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

            return response()->json([
                'userSkills' => $userSkills,
                'activeJobCards' => $activeJobCards,
                'mostRecentJobCard' => $mostRecentJobCard,
                'assignedJobs' => $assignedJobs
            ]);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
