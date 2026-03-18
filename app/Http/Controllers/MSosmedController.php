<?php

namespace App\Http\Controllers;

use App\Models\MSosmed;
use Illuminate\Http\Request;

class MSosmedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = MSosmed::latest()->paginate(10);
        return view('msosmed.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('msosmed.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'url' => 'nullable|string',
        ]);

        $validated['icon'] = $request->file('icon')->store('images', 'public');
        MSosmed::create($validated);
        return redirect()->route('msosmed.index');
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
        $getId = MSosmed::findOrFail($id);
        return view('msosmed.edit', compact('getId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'url' => 'nullable|string',
        ]);

        $validated['icon'] = $request->file('icon')->store('images', 'public');
        $getId = MSosmed::findOrFail($id);
        $getId->update($validated);
        return redirect()->route('msosmed.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $getId = MSosmed::findOrFail($id);
        $getId->delete();
        return redirect()->route('msosmed.index');
    }
}
