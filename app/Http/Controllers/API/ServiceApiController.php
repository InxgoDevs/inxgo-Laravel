<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceApiController extends Controller
{
    /**
     * Display a listing of the services.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $services = Service::all();

        return response()->json(['services' => $services], 200);
    }
}
