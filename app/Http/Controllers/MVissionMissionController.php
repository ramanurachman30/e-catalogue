<?php

namespace App\Http\Controllers;

use App\Models\MVissionMission;
use Illuminate\Http\Request;

class MVissionMissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = MVissionMission::latest()->get();
        return view('mvissionmission.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mvissionmission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|in:vission,mission',
            'order' => 'nullable|integer',
        ]);

        MVissionMission::create($validated);
        return redirect()->route('mvissionmission.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $getId = MVissionMission::findOrFail($id);
        return view('mvissionmission.edit', compact('getId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|in:vission,mission',
            'order' => 'nullable|integer',
        ]);

        $getId = MVissionMission::findOrFail($id);
        $getId->update($validated);
        return redirect()->route('mvissionmission.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $getId = MVissionMission::findOrFail($id);
        $getId->delete();
        return redirect()->route('mvissionmission.index');
    }
}
