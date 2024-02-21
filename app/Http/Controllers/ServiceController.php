<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
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

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        // Validate and update the service (adjust as needed)
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Add more validation rules if needed
        ]);

        if ($request->hasFile('image')) {
            // Update image if a new one is provided
            $imagePath = $request->file('image')->store('public/service_images', 'public';
            $service->update(['image' => $imagePath]);
        }

        $service->update([
            'title' => $request->input('title'),
            // Update more fields as needed
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }
}
