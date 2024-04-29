<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 

use App\Models\User;
use App\Models\Service;
use App\Models\Skill;

class AdminController extends Controller
{

    public function dashboard()

    {
    $totalusers = User::count();
    $totalSkills = Skill::count();
    $totalServices = Service::count();

    return view('admin.dashboard', compact('totalSkills', 'totalServices'));

    }

    // Manage Users 


    public function showUsers()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        // Validate the request

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        // Validate the request

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    // Manage Services

    public function showServices()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    public function createService()
    {
        return view('admin.services.create');
    }

    public function storeService(Request $request)
    {
        // Validate and store the service (adjust as needed)
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Add more validation rules if needed
        ]);

        $imagePath = $request->file('image')->store('public/service_image' , 'public');
        $service = Service::create([
            'title' => $request->input('title'),
            'image' => $imagePath,
            // Add more fields as needed
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function editService(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function updateService(Request $request, Service $service)
    {
        // Validate the request
        if(isset($request->image))
        {
            $imagePath = $request->file('image')->store('public/service_image' , 'public');
            $service->update([
            'image' => $imagePath,
            ]);
        }
        if(isset($request->title))
        {
            $service->update([
                'title' => $request->title,
                // Update other service fields as needed
            ]);

        }

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroyService(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }

    // Manage Skills

    public function showSkills()
    {
        $skills = Skill::all();
        return view('admin.skills.index', compact('skills'));
    }

    public function createSkill()
    {
        $services = Service::all();
        return view('admin.skills.create', compact('services'));
    }

    public function storeSkill(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'service_id' => 'required|exists:services,id',
            // Add other skill fields as needed
        ]);
        $imagePath = $request->file('image')->store('public/skill_image' , 'public');

        Skill::create([
            'title' => $request->title,
            'image' => $imagePath,
            'service_id' => $request->service_id,
            // Add other skill fields as needed
        ]);

        return redirect()->route('admin.skills.index')->with('success', 'Skill created successfully.');
    }

    public function editSkill(Skill $skill)
    {
        $services = Service::all();
        return view('admin.skills.edit', compact('skill', 'services'));
    }

    public function updateSkill(Request $request, Skill $skill)
    {
        // Validate the request
        if(isset($request->image))
        {
            $imagePath = $request->file('image')->store('public/skill_image' , 'public');
            $skill->update([
            'image' => $imagePath,
            ]);
        }
        $skill->update([
            'title' => $request->title,
            // 'image' => $request->image,
            'service_id' => $request->service_id,
            // Update other skill fields as needed
        ]);

        return redirect()->route('admin.skills.index')->with('success', 'Skill updated successfully.');
    }

    public function destroySkill(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('admin.skills.index')->with('success', 'Skill deleted successfully.');
    }
}