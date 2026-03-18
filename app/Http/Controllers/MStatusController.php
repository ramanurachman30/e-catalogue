<?php

namespace App\Http\Controllers;

use App\Models\MStatus;
use Illuminate\Http\Request;

class MStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = MStatus::latest()->paginate(10);
        return view('mstatus.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mstatus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        MStatus::created($validated);
        return redirect()->route('mstatus.index');
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
        $data = MStatus::findOrFail($id);
        return view('mstatus.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $getId = MStatus::findOrFail($id);
        $getId->update($validated);
        return redirect()->route('mstatus.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $getId = MStatus::findOrFail($id);
        $getId->delete();
        return redirect()->route('mstatus.index');
    }
}
