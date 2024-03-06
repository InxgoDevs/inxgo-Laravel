<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use Kutia\Larafirebase\Facades\Larafirebase;
use Illuminate\Support\Facades\Auth;
use Mail;

class JobController extends Controller 
{
    public function index()
    {    
        $jobs = Job::all();
        $assignedJobs = Job::where('status', 'assigned')->get();
        $inProgressJobs = Job::where('status', 'in_progress')->get();
        $completedJobs = Job::where('status', 'completed')->get();
        $paymentBeingClearedJobs = Job::where('status', 'payment_being_cleared')->get();
        return view('jobs.index', compact('jobs','assignedJobs', 'inProgressJobs', 'completedJobs', 'paymentBeingClearedJobs'));
    }

    public function create()
    {
        return view('jobs.create');
    }
    public function updateToken(Request $request){
        try{
            $request->user()->update(['fcm_token'=>$request->token]);
            return response()->json([
                'success'=>true
            ]);
        }catch(\Exception $e){
            report($e);
            return response()->json([
                'success'=>false
            ],500);
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'price_per_hour' => 'required|numeric',
            'client_name' => 'required|string',
        ]);
        // Get the authenticated user's ID
        $userId = auth()->id();
        Job::create([
            'title' => $request->title,
            'description' => $request->description,
            'price_per_hour' => $request->price_per_hour,
            'client_name' => $request->client_name,
            'user_id' => $userId, // Assign the user_id
        ]);
        $this->setNotification($userId,$request->title,$request->message);
        return redirect()->route('jobs.index')
            ->with('success', 'Job created successfully.');
    }
    public function setNotification($userId,$title,$message)
    { 
        $fcmTokens = User::where('id',$userId)->pluck('fcm_token')->toArray();
        Larafirebase::withTitle($title)
            ->withBody($message)
            ->sendMessage($fcmTokens);
        $data = array('name'=> auth()->user()->name);
        Mail::send(['text'=>'mail'], $data, function($message) use($data) {
            $message->to('zainulrauf@gmail.com', 'Inxgo')->subject
            ('Job Created');
            $message->from('zainulrauf@gmail.com',$data['name']);
        });
    }

    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }

    public function edit(Job $job)
    {
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'price_per_hour' => 'required|numeric',
            'client_name' => 'required|string',
        ]);

        $job->update($request->all());
        return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()->route('jobs.index')
            ->with('success', 'Job deleted successfully.');
    }

    public function sendJobRequest(Request $request)
    {
        // Code to send job request...

        // Create a notification feed for the job module
        $feed = FeedManager::getNotificationFeed('job', $jobId);
        $feed->addActivity([
            'actor' => $userId, // User ID triggering the notification
            'verb' => 'request_sent', // Action verb
            'object' => $jobId, // Job ID
        ]);

        // Other code...
    }
}
