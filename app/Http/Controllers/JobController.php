<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use Kutia\Larafirebase\Facades\Larafirebase;
use Illuminate\Support\Facades\Auth;
use Mail;
use Validator;
use Response;

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
    public function myjob(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'seller_id' => 'required',
        ]);

        if ($validator->fails()) { 
            if(isset($request->api))
            {
                return response()->json($validator->messages());
            } 
            else
            {
                return back()->withErrors($validation)->withInput();
            }  
        }
        $data['aassignedJobs'] = Job::where('seller_id',$request->seller_id)->where('status', 'assigned')->get();
        $data['inProgressJobs'] = Job::where('seller_id',$request->seller_id)->where('status', 'in_progress')->get();
        $data['completedJobs'] = Job::where('seller_id',$request->seller_id)->where('status', 'completed')->get();
        $data['paymentBeingClearedJobs'] = Job::where('seller_id',$request->seller_id)->where('status', 'payment_being_cleared')->get();
         if(isset($request->api))
        {
            return response()->json(['data' => $data]);
        }
        else
        {
            return view('jobs.index')->with(['data' => $data]);
        }
    }
    public function create()
    {
        return view('jobs.create');
    }
    public function updateToken(Request $request){
        try{
            // $request->user()->update(['fcm_token'=>$request->token]);
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'price_per_hour' => 'required|numeric',
            'client_name' => 'required|string',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($validator->fails()) { 
            if(isset($request->api))
            {
                return response()->json($validator->messages());
            } 
            else
            {
                return back()->withErrors($validation)->withInput();
            }  
        }
        // Get the authenticated user's ID
        $userId=null;
        if(isset($request->user_id))
        {
            $userId = $request->user_id;
        }
        Job::create([
            'title' => $request->title,
            'description' => $request->description,
            'price_per_hour' => $request->price_per_hour,
            'client_name' => $request->client_name,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'user_id' => $userId?$userId:auth()->id(), // Assign the user_id
        ]);
        $this->setNotification($userId,$request->title,$request->message);
        if(isset($request->api))
        {
            return response()->json(['success' => 'Job created successfully.']);
        }
        else
        {
            return redirect()->route('jobs.index')
            ->with('success', 'Job created successfully.');
        }
    }
    public function notification()
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'message' => 'required|string',
            // 'address' => 'required',
            // 'latitude' => 'required',
            // 'longitude' => 'required',
        ]);
        $userId=null;
        if(isset($request->user_id))
        {
            $userId=$request->user_id
        }
        if ($validator->fails()) {
            return response()->json($validator->messages()); 
        }
        $this->setNotification($userId,$request->title,$request->message);
        return response()->json(['success' => 'Notification Successfully Sent.!']);
    }
    public function setNotification($userId,$title,$message)
    { 
        if($userId)
        {
            $user=User::where('id',$userId)->get();
        }
        else
        {
            $user=User::where('role','seller')->get();

        }
        foreach($user as $index)
        {
            Larafirebase::withTitle($title)
                ->withBody($message)
                ->sendMessage($index->fcm_token);
            $data = array('name'=> $index->name,'email'=>$index->email,'title'=>$title,'message'=>$message);
            Mail::send(['text'=>'mail'], $data, function($message) use($data) {
                $message->to('zainulrauf@gmail.com', 'Inxgo')->subject
                ('Job Created');
                $message->from('zainulrauf@gmail.com',$data['name']);
            });
        }
    }
    public function assign(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_id' => 'required',
            'seller_id' => 'required',
            'status'=>'required'
        ]);
        if ($validator->fails()) { 
            if(isset($request->api))
            {
                return response()->json($validator->messages());
            } 
            else
            {
                return back()->withErrors($validation)->withInput();
            }  
        }
        Job::where('id',$request->job_id)->update(['seller_id'=>$request->seller_id,'status'=>$request->status]);
        // $this->setNotification($userId,$request->title,$request->message);
        if(isset($request->api))
        {
            return response()->json(['success' => 'Job '.$request->status.' successfully.']);
        }
        else
        {
            return redirect()->route('jobs.index')
            ->with('success', 'Job created successfully.');
        }

    }
    public function status()
    {
         return response()->json(['assigned','in_progress','completed','payment_being_cleared']);
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
