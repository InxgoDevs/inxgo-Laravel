<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ClientDashboardApiController extends Controller
{
    /**
     * Get all skills available.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllSkills()
    {
        $allSkills = Skill::all();
        return response()->json($allSkills);
    }

    /**
     * Get active job cards.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getActiveJobCards()
    {
        $activeJobCards = Job::where('status', 'active')->get();
        return response()->json($activeJobCards);
    }

    /**
     * Get the most recent job card.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMostRecentJobCard()
    {
        $mostRecentJobCard = Job::latest()->first();
        return response()->json($mostRecentJobCard);
    }

    /**
     * Get nearby sellers.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNearbySellers()
    {
        $nearbySellers = User::where('role', 'seller')->select('id', 'name', 'profile_image')->get();
        return response()->json($nearbySellers);
    }
}
