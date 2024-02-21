<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\Service; // Make sure to adjust the model namespace

class SkillsController extends Controller
{
    public function index()
    {
        $skills = Skill::all();
        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        $services = Service::all();
        return view('admin.skills.create', compact('services'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'service_id' => 'required|exists:services,id',
            // Add other skill fields as needed
        ]);

        $imagePath = $request->file('image')->store('public/skill_images');
        $imageUrl = str_replace('public/', '', $imagePath);

        Skill::create([
            'title' => $request->title,
            'image' => $imageUrl,
            'service_id' => $request->service_id,
            // Add other skill fields as needed
        ]);

        return redirect()->route('admin.skills.index')->with('success', 'Skill created successfully.');
    }

    public function edit(Skill $skill)
    {
        $services = Service::all();
        return view('admin.skills.edit', compact('skill', 'services'));
    }

    public function update(Request $request, Skill $skill)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'service_id' => 'required|exists:services,id',
            // Update other skill fields as needed
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/skill_images');
            $imageUrl = str_replace('public/', '', $imagePath);
            $skill->update(['image' => $imageUrl]);
        }

        $skill->update([
            'title' => $request->title,
            'service_id' => $request->service_id,
            // Update other skill fields as needed
        ]);

        return redirect()->route('admin.skills.index')->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('admin.skills.index')->with('success', 'Skill deleted successfully.');
    }
}
